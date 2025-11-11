<?php

namespace App\Imports;

use App\Models\Aarji;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\Log;

class AarjiImport implements ToModel, WithHeadingRow, WithChunkReading
{
    public function model(array $row)
    {
        try {
            // DEBUG: Log row data
            Log::debug('Importing Aarji row:', $row);

            // Handle date fields with extra debugging
            $complaint_date = null;
            $closed_at_police_station = null;
            $closed_at_nccrp = null;

            if (!empty($row['complaint_date'])) {
                if (\Carbon\Carbon::hasFormat($row['complaint_date'], 'd-m-Y')) {
                    $complaint_date = \Carbon\Carbon::createFromFormat('d-m-Y', $row['complaint_date'])->format('Y-m-d');
                } elseif (\Carbon\Carbon::hasFormat($row['complaint_date'], 'd/m/Y')) {
                    $complaint_date = \Carbon\Carbon::createFromFormat('d/m/Y', $row['complaint_date'])->format('Y-m-d');
                } else {
                    Log::warning('Unable to parse complaint_date: ' . $row['complaint_date']);
                }
            }

            if (!empty($row['closed_at_police_station'])) {
                if (\Carbon\Carbon::hasFormat($row['closed_at_police_station'], 'd-m-Y')) {
                    $closed_at_police_station = \Carbon\Carbon::createFromFormat('d-m-Y', $row['closed_at_police_station'])->format('Y-m-d');
                } elseif (\Carbon\Carbon::hasFormat($row['closed_at_police_station'], 'd/m/Y')) {
                    $closed_at_police_station = \Carbon\Carbon::createFromFormat('d/m/Y', $row['closed_at_police_station'])->format('Y-m-d');
                } else {
                    Log::warning('Unable to parse closed_at_police_station: ' . $row['closed_at_police_station']);
                }
            }

            if (!empty($row['closed_at_nccrp'])) {
                if (\Carbon\Carbon::hasFormat($row['closed_at_nccrp'], 'd-m-Y')) {
                    $closed_at_nccrp = \Carbon\Carbon::createFromFormat('d-m-Y', $row['closed_at_nccrp'])->format('Y-m-d');
                } elseif (\Carbon\Carbon::hasFormat($row['closed_at_nccrp'], 'd/m/Y')) {
                    $closed_at_nccrp = \Carbon\Carbon::createFromFormat('d/m/Y', $row['closed_at_nccrp'])->format('Y-m-d');
                } else {
                    Log::warning('Unable to parse closed_at_nccrp: ' . $row['closed_at_nccrp']);
                }
            }

            $aarji = new Aarji([
                'ack_no' => $row['ack_no'] ?? null,
                'complaint_date' => $complaint_date,
                'police_station' => $row['police_station'] ?? null,
                'applicant_name' => $row['applicant_name'] ?? null,
                'mobile_number' => $row['mobile_number'] ?? null,
                'address' => $row['address'] ?? null,
                'fraud_type' => $row['fraud_type'] ?? null,
                'fraud_amount' => $row['fraud_amount'] ?? null,
                'investigator' => $row['investigator'] ?? null,
                'application_status' => $row['application_status'] ?? 'Pending',
                'closed_at_police_station' => $closed_at_police_station,
                'closed_at_nccrp' => $closed_at_nccrp,
                'fir_number' => $row['fir_number'] ?? null,
                'fir_date' => $row['fir_date'] ?? null,
                'remarks' => $row['remarks'] ?? null,
            ]);

            return $aarji;

        } catch (\Throwable $e) {
            // DEBUG: Log exceptions
            Log::error('Import Aarji Failed', [
                'row' => $row,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return null;
        }
    }

    public function chunkSize(): int
    {
        return 2000;
    }
}
