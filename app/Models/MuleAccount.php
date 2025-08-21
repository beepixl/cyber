<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MuleAccount extends Model
{
    protected $fillable = [
        'bank_branch',
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
    ];
}
