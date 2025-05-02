<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    protected $table = 'officers';

    protected $fillable = ['user_id', 'name', 'badge_number', 'rank', 'station'];
}
