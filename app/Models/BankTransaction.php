<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'info_type',
        'outward_no',
        'nodal_officer',
        'acknowledgement_no',
        'account_id',
        'to_account_id',
        'transaction_id',
        'transaction_id_2',
        'transaction_type',
        'transaction_date',
        'put_on_hold_date',
        'withdrawal_date',
        'date_of_action',
        'withdrawal_amount',
        'transaction_amount',
        'put_on_hold_amount',
        'disputed_amount',
        'atm_id',
        'atm_location',
        'bank_name',
        'layer',
        'ifsc_code',
        'reference_no',
        'remarks',
        'action_taken_by_bank',
    ];

    protected $casts = [
        // 'transaction_date' => 'datetime',
        // 'put_on_hold_date' => 'datetime',
        // 'withdrawal_date' => 'datetime',
        // 'date_of_action' => 'datetime',
        'withdrawal_amount' => 'decimal:2',
        'transaction_amount' => 'decimal:2',
        'put_on_hold_amount' => 'decimal:2',
        'disputed_amount' => 'decimal:2',
    ];

    // Optional: Define relationship to a Case model
    public function case()
    {
        return $this->belongsTo(CyberCase::class, 'acknowledgement_no', 'acknowledgement_no')->with('policeStation');
    }

    // Relationship: BankTransaction belongs to PoliceStation via police_station_id

}
