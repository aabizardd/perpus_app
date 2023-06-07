<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InhabitantReport extends Model
{
    use HasFactory;

    protected $table = 'inhabitant_report';
    protected $fillable = [
        'case',
        'id_inhabitant',
        'status',
    ];

    public static function get_laporan()
    {

        $details = InhabitantReport::join('inhabitants', 'inhabitants.id', '=', 'inhabitant_report.id_inhabitant')
            ->join('users', 'inhabitants.id_user', '=', 'users.id')
            ->get(['inhabitant_report.case', 'inhabitant_report.id', 'users.name', 'inhabitant_report.status']);

        return $details;

    }

}
