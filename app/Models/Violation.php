<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    protected $table = 'violations';

    protected $fillable = [
        'violation_code',
        'violation_name',
        'description',
        'fine_amount',
        'penalty',
        'status',
    ];
}
