<?php

namespace App\Filament\Resources\RefundResource\Pages;

use App\Filament\Resources\RefundResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRefund extends CreateRecord
{
    protected static string $resource = RefundResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
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

