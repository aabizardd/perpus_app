<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    protected $table = 'rents';

    protected $fillable = [
        'id_land',
        'id_inhabitant',
        'book_option',
        'payment_total',
        'status',
    ];

    public static function my_land($id_inhabitant)
    {

        $details = Rent::join('parking_area', 'rents.id_land', '=', 'parking_area.land_code')
            ->where('rents.id_inhabitant', $id_inhabitant)
            ->where('rents.status', 1)
            ->get(['parking_area.*']);

        return $details;

    }
}