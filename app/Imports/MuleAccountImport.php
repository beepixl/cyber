<?php
namespace App\Imports;

use App\Models\MuleAccount;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class MuleAccountImport implements ToModel, WithHeadingRow, WithChunkReading
{
    public function model(array $row)
    {

        // Only allow import if district is 'navsari' (case-insensitive)
        if (!isset($row['district']) || strtolower($row['district']) !== 'navsari') {
            return null;
        }

        // Check if a record with the same account_no and acknowledgement_no already exists
        $exists = MuleAccount::where('account_no', $row['account_no'] ?? null)
            ->where('acknowledgement_no', $row['acknowledgement_no'] ?? null)
            ->exists();

        if ($exists) {
            return null;
        }
        return new MuleAccount([
            'acknowledgement_no'  => $row['acknowledgement_no'] ?? null,
            'account_no'          => $row['account_no'] ?? null,
            'ifsc_code'           => $row['ifsc_code'] ?? null,
            'address'             => $row['address'] ?? null,
            'district'            => $row['district'] ?? null,
            'state'               => $row['state'] ?? null,
            'pin_code'            => $row['pin_code'] ?? null,
            'transaction_amount'  => $row['transaction_amount'] ?? null,
            'disputed_amount'     => $row['disputed_amount'] ?? null,
            'bank_fis'            => $row['bank_fis'] ?? null,
            'layers'              => $row['layers'] ?? null,
        ]);
    }

    public function chunkSize(): int
    {
        return 2000;
    }
}
