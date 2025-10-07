<?php

namespace App\Filament\Resources\ApplicationRecordResource\Pages;

use App\Filament\Resources\ApplicationRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditApplicationRecord extends EditRecord
{
    protected static string $resource = ApplicationRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
