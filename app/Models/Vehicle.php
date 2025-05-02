<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehicles';

    protected $fillable = [
        'plate_number',
        'make',
        'model',
        'color',
        'owner_nic',
        'owner_name',
        'owner_contact',
        'chassis_number',
        'engine_number',
        'vehicle_type',
        'year_of_manufacture',
    ];

    /**
     * Get the revenue licenses associated with the vehicle.
     */
    public function revenueLicenses()
    {
        return $this->hasOne(RevenueLicense::class, 'vehicle_id');
    }
}