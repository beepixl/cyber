<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aarji extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'no',
        'ack_no',
        'complaint_date',
        'police_station',
        'applicant_name',
        'mobile_number',
        'address',
        'fraud_type',
        'fraud_amount',
        'investigator',
        'application_status',
        'closed_at_police_station',
        'closed_at_nccrp',
        'fir_number',
        'fir_date',
        'remarks',
    ];
}
