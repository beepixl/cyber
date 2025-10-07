<?php

namespace App\Filament\Resources\MuleAccountResource\Pages;

use App\Filament\Resources\MuleAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMuleAccount extends EditRecord
{
    protected static string $resource = MuleAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

        protected function mutateFormDataBeforeSave(array $data): array
        {
            // If outward_no is being set and outward_no was previously null for this IFSC code,
            // update all records with the same IFSC code and outward_no == null to have the same outward_no and nodal_officer.
            if (!empty($data['outward_no']) && !empty($data['ifsc_code'])) {
                $model = $this->getRecord();
                // Only run if the current record's outward_no was previously null
                if (is_null($model->outward_no)) {
                  \App\Models\MuleAccount::whereRaw('LEFT(ifsc_code, 4) = ?', [substr($data['ifsc_code'], 0, 4)])
    ->whereNull('outward_no')
    ->update([
        'outward_no'    => $data['outward_no'],
        'nodal_officer' => $data['nodal_officer'] ?? null,
        'bank_branch'   => $data['bank_branch'] ?? null,
    ]);

                }
            }
            return $data;
        }
}
