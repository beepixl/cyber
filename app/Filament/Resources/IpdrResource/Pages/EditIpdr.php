<?php

namespace App\Filament\Resources\IpdrResource\Pages;

use App\Filament\Resources\IpdrResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIpdr extends EditRecord
{
    protected static string $resource = IpdrResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
