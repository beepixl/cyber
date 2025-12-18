<?php

namespace App\Filament\Resources\RefundResource\Pages;

use App\Filament\Resources\RefundResource;
use Filament\Resources\Pages\EditRecord;

class EditRefund extends EditRecord
{
    protected static string $resource = RefundResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Convert email_reminders array to repeater format
        if (isset($data['email_reminders']) && is_array($data['email_reminders'])) {
            $data['email_reminders'] = array_map(function ($date) {
                return ['date' => $date];
            }, $data['email_reminders']);
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Convert repeater format to simple array of dates
        if (isset($data['email_reminders']) && is_array($data['email_reminders'])) {
            $dates = array_filter(array_column($data['email_reminders'], 'date'));
            $data['email_reminders'] = $dates;
            $data['reminder_count'] = count($dates);
            $data['last_reminder_date'] = !empty($dates) ? max($dates) : null;
        }

        return $data;
    }
}

