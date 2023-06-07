<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\ParkingArea;
use Illuminate\Http\Request;

class LandCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $data = [
            'title' => 'Cari Lahan Parkiran - Aplikasi Pemesanan Parkir Perumahan Buah Batu',

        ];

        return view('pages.cari_lahan', $data);

    }

    public function cari_lahan(Request $request)
    {

        $land_code = $request->land_code;

        $data = ParkingArea::cari_lahan($land_code);

        // dd($data->land_code);

        if (!isset($data->license_number) && !isset($data->land_code)) {
            return redirect()->back()->with(['error' => 'Kode Lahan atau Plat Mobil Tidak Tersedia!']);
        } elseif (!isset($data->license_number) && isset($data->land_code)) {
            return redirect()->route('cek_lahan.detail_lahan', $land_code);
        } else {
            return redirect()->route('cek_lahan.detail_lahan', $land_code);
        }

    }

    public function detail_lahan($land_code)
    {

        $detail_lahan = ParkingArea::cari_lahan($land_code);

        $pemilik = Car::get_car_where($detail_lahan->land_code);

        // dd($pemilik);
        // if ($pemilik->count() < 1) {
        //     dd('adasda');
        // }

        $data = [
            'title' => 'Detail Lahan Parkiran - Aplikasi Pemesanan Parkir Perumahan Buah Batu',
            'detail_lahan' => $detail_lahan,
            'pemilik' => $pemilik,
        ];

        return view('pages.detail_lahan', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
