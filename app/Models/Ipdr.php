<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ipdr extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nodal_officer',
        'date',
        'outward_no',
        'police_station',
        'fir_or_case_no',
        'sho',
        'contact_sho',
        'officer',
        'entries',
    ];

    protected $casts = [
        'date' => 'date',
        'entries' => 'array', // Cast JSON to array
    ];
}
