<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevenueLicense extends Model
{
    use HasFactory;

    protected $table = 'revenue_licenses';

    protected $fillable = [
        'vehicle_id',
        'issue_date',
        'expiry_date',
        'fee_paid',
    ];

    /**
     * Get the vehicle that owns the revenue license.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
