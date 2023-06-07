<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $fillable = [
        'license_number',
        'brand',
        'color',
        'id_land',
        'id_inhabitant',
    ];

    public static function get_car()
    {
        $details = Car::join('inhabitants', 'inhabitants.id', '=', 'cars.id_inhabitant')
            ->join('users', 'inhabitants.id_user', '=', 'users.id')
            ->get(['cars.*', 'users.name', 'inhabitants.address', 'inhabitants.phone_number']);

        return $details;
    }

    public static function get_car_where($land_code)
    {
        $details = Car::join('inhabitants', 'inhabitants.id', '=', 'cars.id_inhabitant')
            ->join('users', 'inhabitants.id_user', '=', 'users.id')
            ->where('cars.id_land', $land_code)
            ->get(['cars.*', 'users.name', 'inhabitants.address', 'inhabitants.phone_number', 'inhabitants.id as warga_id']);

        return $details;
    }
}
