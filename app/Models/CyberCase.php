<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CyberCase extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cases';

    protected $fillable = [
        'acknowledgement_no',

        'nccrp_no',
        'category',
        'sub_category',
        'lean_amount',
        'fraud_amount',
        'complainant_address',

        'application_date',
        'complainant_name',
        'complainant_mobile',
        'complainant_email',
        'complainant_pincode',
        'police_station',
        'status',
        'users',
    ];

    protected $casts = [
        'application_date' => 'datetime',

    ];

    public function accusedProfiles(): HasMany
    {
        return $this->hasMany(AccusedProfile::class, 'case_id');
    }

    public function bankTransactions(): HasMany
    {
        return $this->hasMany(BankTransaction::class, 'acknowledgement_no', 'acknowledgement_no');
    }

    public function fehrists(): HasMany
    {
        return $this->hasMany(Fehrist::class, 'case_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users')
            ->withTimestamps();
    }

    public function policeStation()
    {
        // 'police_station' in CyberCase is the police station name, not the id.
        // So we need to match 'name' in PoliceStation, not 'id'.
        return $this->belongsTo(\App\Models\PoliceStation::class, 'police_station', 'name');
    }
}
