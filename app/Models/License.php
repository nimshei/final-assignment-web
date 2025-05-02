<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class License extends Model
{
    use HasFactory;

    protected $table = 'licenses';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'license_number',
        'issue_date',
        'expiry_date',
        'id_type',
        'id_number',
        'date_of_birth',
        'age',
        'sex',
        'permanent_address',
        'phone_number',
        'divisional_secretariat_code',
        'blood_group',
        'organ_donor_status',
        'height',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}