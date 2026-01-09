<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MuleAccount extends Model
{
    protected $fillable = [
        'bank_branch',
        'bank_branch_address',
        'outward_no',
        'nodal_officer',
        'acknowledgement_no',
        'account_no',
        'ifsc_code',
        'address',
        'district',
        'state',
        'pin_code',
        'transaction_amount',
        'disputed_amount',
        'bank_fis',
        'layers',
        'reply_letter_sent_to_bank_dt',
        'reply_letter_received_from_bank_dt',
        'acc_holder_address',
        'acc_holder_police_station',
        'holder_nivedan_taken_dt',
        'remarks',
        'action_taken',
        'action_taken_date',
    ];
}
