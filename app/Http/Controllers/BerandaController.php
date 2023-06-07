<?php

namespace App\Http\Controllers;

class BerandaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $data = [
            'title' => 'Beranda - Aplikasi Pemesanan Parkir Perumahan Buah Batu',
        ];

        // dd(get_user_auth()->role);

        if (get_user_auth()->role == 1) {

            return redirect()->to('kelola_buku');
        }

        return view('pages.dashboard', $data);

    }
}
