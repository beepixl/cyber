<?php

namespace App\Filament\Resources\CrimeRecordCardResource\Pages;

use App\Filament\Resources\CrimeRecordCardResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCrimeRecordCards extends ListRecords
{
    protected static string $resource = CrimeRecordCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
