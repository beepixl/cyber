<?php

namespace App\Filament\Resources\IpdrResource\Pages;

use App\Filament\Resources\IpdrResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIpdrs extends ListRecords
{
    protected static string $resource = IpdrResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
