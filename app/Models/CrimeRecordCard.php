<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrimeRecordCard extends Model
{
    protected $fillable = [
        'police_station_name',
        'record_date',
        'name',
        'alias',
        'age',
        'fp_classification',
        'place_of_birth',
        'height',
        'complexion',
        'build',
        'hair',
        'eyes',
        'identification_marks',
        'languages_known',
        'religion_caste',
        'education',
        'address',
        'date_of_photograph',
        'police_officers',
        'movements_info',
        'convictions_summary',
        'relatives_friends',
        'father_name',
        'spouse_name',
        'associates_in_crime',
        'receivers',
        'mo_classification',
        'general_particulars',
        'fir_numbers',
        'dress_description',
        'style_description',
        'habits_vices',
        'sphere_of_activity',
        'antecedents',
        'cp_reference',
        'ho_memo_no',
        'red_no_of_p_stn',
        'dist_mob_no',
        'cid_no',
        'frequents_of_stays_at',
        'mo',
        'occupation',
    ];

    protected $casts = [
        'convictions_summary' => 'array',
    ];
}
