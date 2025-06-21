<?php

namespace App\Filament\Resources\AccusedProfileResource\Pages;

use App\Filament\Resources\AccusedProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAccusedProfile extends EditRecord
{
    protected static string $resource = AccusedProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
