<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offence extends Model
{
    protected $fillable = [
        'license_id',
        'officer_id',
        'vehicle_id',
        'violation_id',
        'date_time',
        'location',
        'description',
        'fine_amount',
        'court_date',
        'deadline',
        'status',
    ];

    // Relationships
    public function license()
    {
        return $this->belongsTo(License::class);
    }

    public function officer()
    {
        return $this->belongsTo(Officer::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function violation()
    {
        return $this->belongsTo(Violation::class);
    }
}
