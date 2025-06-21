<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AccusedProfile extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $fillable = [
        'case_id',
        'name',
        'photo_path',
        'date_of_birth',
        'signature_path',
        'addresses',
        'business_name',
        'business_type',
        'business_addresses',
        'mobile_numbers',
        'email_addresses',
        'aadhar_number',
        'pan_number',
        'gstin',
        'social_media_profiles',
        'fathers_name',
        'mothers_name',
        'family_members',
        'devices',
        'bank_accounts',
        'ip_addresses',
        'locations',
        'bio',
        'additional_info',

        'police_station',
        'state',
        'city',
        'fir_no',
        'compliant_person',
        'fraud_amount',
        'lien_amount',
        'case_date',
        'accused_role',
        'created_by',
        'status',
        'disputed_amount',
        'layer',
        'cdr_analysis',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'case_date' => 'date',
        'addresses' => 'array',
        'business_addresses' => 'array',
        'mobile_numbers' => 'array',
        'email_addresses' => 'array',
        'social_media_profiles' => 'array',
        'family_members' => 'array',
        'devices' => 'array',
        'bank_accounts' => 'array',
        'ip_addresses' => 'array',
        'locations' => 'array',
        'cdr_analysis' => 'array',
    ];

    public function case(): BelongsTo
    {
        return $this->belongsTo(CyberCase::class);
    }

    public function familyMembers(): HasMany
    {
        return $this->hasMany(FamilyMember::class);
    }

    // Helper methods for structured data
    public function addAddress(string $address, ?string $type = null, ?string $source = null): void
    {
        $addresses = $this->addresses ?? [];
        $addresses[] = [
            'address' => $address,
            'type' => $type,
            'source' => $source,
            'added_at' => now()->toDateTimeString(),
        ];
        $this->addresses = $addresses;
        $this->save();
    }

    public function addMobileNumber(string $number, ?string $label = null, ?string $source = null): void
    {
        $numbers = $this->mobile_numbers ?? [];
        $numbers[] = [
            'number' => $number,
            'label' => $label,
            'source' => $source,
            'added_at' => now()->toDateTimeString(),
        ];
        $this->mobile_numbers = $numbers;
        $this->save();
    }

    public function addDevice(array $deviceInfo): void
    {
        $devices = $this->devices ?? [];
        $devices[] = array_merge($deviceInfo, ['added_at' => now()->toDateTimeString()]);
        $this->devices = $devices;
        $this->save();
    }

    public function addBankAccount(array $accountInfo): void
    {
        $accounts = $this->bank_accounts ?? [];
        $accounts[] = array_merge($accountInfo, ['added_at' => now()->toDateTimeString()]);
        $this->bank_accounts = $accounts;
        $this->save();
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
