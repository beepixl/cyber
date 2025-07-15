<?php

namespace App\Filament\Resources\CrimeRecordCardResource\Pages;

use App\Filament\Resources\CrimeRecordCardResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCrimeRecordCard extends EditRecord
{
    protected static string $resource = CrimeRecordCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
