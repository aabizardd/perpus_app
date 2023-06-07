<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkZone extends Model
{
    use HasFactory;

    protected $table = 'park_zone';

    protected $fillable = [
        'zone',
        'land_amount',
    ];
}
