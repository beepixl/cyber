<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Refund extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'acknowledgement_no',
        'applicant_name',
        'suspect_bank_account_name',
        'amount',
        'suspect_account_number',
        'email_date',
        'email_reminders',
        'reminder_count',
        'last_reminder_date',
        'remarks',
        'source_file',
        'status',
        'amount_refunded',
    ];

    protected function casts(): array
    {
        return [
            'email_date' => 'date',
            'email_reminders' => 'array',
            'last_reminder_date' => 'date',
            'amount' => 'decimal:2',
            'amount_refunded' => 'decimal:2',
        ];
    }

    /**
     * Add a reminder date to the reminders array
     */
    public function addReminder($date): void
    {
        $reminders = $this->email_reminders ?? [];
        $reminders[] = $date;
        $this->email_reminders = $reminders;
        $this->reminder_count = count($reminders);
        $this->last_reminder_date = $date;
        $this->save();
    }

    /**
     * Get all reminder dates as array
     */
    public function getReminderDatesAttribute(): array
    {
        return $this->email_reminders ?? [];
    }
}

