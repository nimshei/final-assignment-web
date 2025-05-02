<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccidentVehicle extends Model
{
    protected $table = 'accident_vehicle';

    protected $fillable = [
        'accident_id',
        'vehicle_id',
    ];

    public function accident()
    {
        return $this->belongsTo(Accident::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
