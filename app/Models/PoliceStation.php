<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoliceStation extends Model
{
    protected $fillable = [
        'name',
        'pi_name',
        'pi_sign',
        'seal',
        'address',
        'email',
        'phone_no'
    ];
}
