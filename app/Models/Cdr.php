<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Cdr extends Model
{
    protected $fillable = [
        'nodal_officer',
        'date',
        'outward_no',
        'police_station',
        'mobile_or_imei_no',
        'period_from',
        'period_to',
        'fir_or_case_no',
        'sho',
        'contact_sho',
        'officer'                         
    ];
}


