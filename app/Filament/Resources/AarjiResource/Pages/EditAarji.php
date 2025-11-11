<?php

namespace App\Filament\Resources\AarjiResource\Pages;

use App\Filament\Resources\AarjiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAarji extends EditRecord
{
    protected static string $resource = AarjiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
