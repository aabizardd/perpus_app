<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingArea extends Model
{
    use HasFactory;

    protected $table = 'parking_area';
    protected $primaryKey = 'land_code';
    protected $keyType = 'string';
    // protected $primaryKey = 'land_code';

    protected $fillable = [
        'land_code',
        'address',
        'price',
        'capacity',
        'status',
        'information',
        'id_zone',
    ];

    public static function cari_lahan($inp)
    {

        $details = ParkingArea::leftJoin('cars', 'parking_area.land_code', '=', 'cars.id_land')
            ->where('parking_area.land_code', $inp)
            ->orWhere('cars.license_number', $inp)
            ->first();

        return $details;

    }
}
