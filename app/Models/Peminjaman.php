<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman_buku';

    protected $guarded = [];

    public static function detail_pinjam()
    {

        $details = Peminjaman::join('books', 'books.id', '=', 'peminjaman_buku.id_buku')
            ->get(['books.*', 'peminjaman_buku.*', 'peminjaman_buku.id as p_id', 'books.id as b_id']);

        return $details;

    }

}