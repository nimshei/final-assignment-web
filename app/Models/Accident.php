<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accident extends Model
{
    // Specify the table name
    protected $table = 'accidents';

    // Specify the fillable fields
    protected $fillable = [
        'officer_id',
        'accident_date_time',
        'location',
        'description',
        'severity',
        'injuries',
        'fatalities',
        'property_damage',
        'status',
        'notes',
    ];

    // Define relationships
    public function officer()
    {
        return $this->belongsTo(Officer::class);
    }

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'accident_vehicle', 'accident_id', 'vehicle_id');
    }
}
