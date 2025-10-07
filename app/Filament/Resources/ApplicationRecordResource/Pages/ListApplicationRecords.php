<?php

namespace App\Filament\Resources\ApplicationRecordResource\Pages;

use App\Filament\Resources\ApplicationRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApplicationRecords extends ListRecords
{
    protected static string $resource = ApplicationRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
