<?php

namespace App\Imports;

use App\Models\Refund;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class RefundImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    protected $lastAcknowledgementNo = null;
    protected $lastApplicantName = null;
    protected $sourceFile = null;

    public function __construct($sourceFile = null)
    {
        $this->sourceFile = $sourceFile;
    }

    public function model(array $row)
    {
       
        Log::info('Importing Refund', ['row' => $row]);
        Log::info('Row keys', ['keys' => array_keys($row)]);
       
        
        try {
            // Get acknowledgement_no from row, or use last one if empty
            $ackNo = null;
            $ackNoKeys = ['acknowledgement_no', 'acknowledgement no', 'ack_no', 'ack no', 'acknowledgement number'];
            
            foreach ($ackNoKeys as $key) {
                if (!empty($row[$key])) {
                    $ackNo = trim($row[$key]);
                    $this->lastAcknowledgementNo = $ackNo; // Update last seen
                    break;
                }
            }
            
            // If no acknowledgement_no in this row, use the last one
            if (empty($ackNo) && !empty($this->lastAcknowledgementNo)) {
                $ackNo = $this->lastAcknowledgementNo;
            }

            // Get applicant name from row, or use last one if empty
            $applicantName = null;
            $applicantNameKeys = ['applicant_name', 'applicant name', 'applicant'];
            
            foreach ($applicantNameKeys as $key) {
                if (!empty($row[$key])) {
                    $applicantName = trim($row[$key]);
                    $this->lastApplicantName = $applicantName; // Update last seen
                    break;
                }
            }
            
            // If no applicant_name in this row, use the last one
            if (empty($applicantName) && !empty($this->lastApplicantName)) {
                $applicantName = $this->lastApplicantName;
            }
            
            // If still no applicant name, skip this row
            if (empty($applicantName)) {
                return null; // Skip rows without applicant name
            }

            // Get suspect bank account name
            $suspectBankAccount = $row['saspect_bank_account_name'] 
                ?? $row['Saspect Bank account name'] 
                ?? $row['suspect bank account name'] 
                ?? $row['suspect bank account'] 
                ?? null;

       
                

            // Get amount and clean it
            $amount = $row['amount'] ?? null;
            if (!empty($amount)) {
                $amount = str_replace(',', '', $amount);
                $amount = preg_replace('/[^0-9.]/', '', $amount);
            }

            // Get suspect account number
            $suspectAccountNumber = $row['suspect_account_number'] 
                ?? $row['suspect account number'] 
                ?? $row['suspect account no'] 
                ?? null;

            // Parse email date
            $emailDate = $this->parseDate($row['email_date'] ?? $row['email date'] ?? null);

            // Parse reminder dates
            $reminders = [];
            $reminderKeys = [
                'email_reminder_1', 'email reminder 1', 'email reminder -1', 'email reminder-1',
                'email_reminder_2', 'email reminder 2', 'email reminder - 2', 'email reminder-2',
                'email_reminder_3', 'email reminder 3',
            ];

            foreach ($reminderKeys as $key) {
                if (isset($row[$key]) && !empty($row[$key])) {
                    $reminderDate = $this->parseDate($row[$key]);
                    if ($reminderDate) {
                        $reminders[] = $reminderDate;
                    }
                }
            }

            // Parse refund date
            $refundDate = $this->parseDate($row['refund_date'] ?? $row['refund date'] ?? null);
            if ($refundDate) {
                $reminders[] = $refundDate; // Add refund date to reminders
            }

            // Get remarks
            $remarks = $row['remarks'] ?? null;

            // Check for duplicate
            $duplicate = Refund::where('acknowledgement_no', $ackNo)
                ->where('applicant_name', $applicantName)
                ->where('suspect_account_number', $suspectAccountNumber)
                ->exists();

            if ($duplicate) {
                Log::info('Skipping duplicate Refund entry', [
                    'acknowledgement_no' => $ackNo,
                    'applicant_name' => $applicantName,
                ]);
                return null;
            }

            // If suspect bank account and amount are both empty, skip the row
            if (empty($suspectBankAccount) && empty($amount)) {
                Log::info('Skipping Refund row due to empty suspect bank account and amount', [
                    'acknowledgement_no' => $ackNo,
                    'applicant_name' => $applicantName,
                ]);
                return null;
            }

            $refund = new Refund([
                'acknowledgement_no' => $ackNo,
                'applicant_name' => $applicantName,
                'suspect_bank_account_name' => $suspectBankAccount,
                'amount' => $amount ? (float) $amount : null,
                'suspect_account_number' => $suspectAccountNumber,
                'email_date' => $emailDate,
                'email_reminders' => !empty($reminders) ? $reminders : null,
                'reminder_count' => count($reminders),
                'last_reminder_date' => !empty($reminders) ? max($reminders) : null,
                'remarks' => $remarks,
                'source_file' => $this->sourceFile,
            ]);

            return $refund;

        } catch (\Throwable $e) {
            Log::error('Import Refund Failed', [
                'row' => $row,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return null;
        }
    }

    protected function parseDate($dateValue)
    {
        if (empty($dateValue)) {
            return null;
        }

        // Try different date formats
        $formats = ['d-m-Y', 'd/m/Y', 'Y-m-d', 'Y/m/d', 'm-d-Y', 'm/d/Y', 'd-m-y', 'd/m/y'];
        
        foreach ($formats as $format) {
            try {
                if (Carbon::hasFormat($dateValue, $format)) {
                    return Carbon::createFromFormat($format, $dateValue)->format('Y-m-d');
                }
            } catch (\Exception $e) {
                continue;
            }
        }

        // Try Excel date serial number
        if (is_numeric($dateValue)) {
            try {
                return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($dateValue))->format('Y-m-d');
            } catch (\Exception $e) {
                // Ignore
            }
        }

        // Try standard date parsing
        try {
            return Carbon::parse($dateValue)->format('Y-m-d');
        } catch (\Exception $e) {
            Log::warning('Unable to parse date: ' . $dateValue);
            return null;
        }
    }

    public function chunkSize(): int
    {
        return 500;
    }

    public function batchSize(): int
    {
        return 500;
    }
}

