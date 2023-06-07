<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRentRequest;
use App\Models\ParkingArea;
use App\Models\Rent;
use Illuminate\Http\Request;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kode_lahan)
    {

        $detail_lahan = ParkingArea::find($kode_lahan);

        $data = [
            'title' => 'Form Penyewaan - Aplikasi Pemesanan Parkir Perumahan Buah Batu',
            'detail_lahan' => $detail_lahan,
        ];

        // dd(ParkingArea::where('id_zone', $id)->get());

        return view('pages.form_penyewaan', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $data = [
            'id_land' => $request->id_land,
            'id_inhabitant' => $request->id_inhabitant,
            'book_option' => $request->book_option,
            'payment_total' => $request->payment_total,
        ];

        // dd($data);

        Rent::create($data);

        $parking_area = ParkingArea::find($data['id_land']);

        $data_update = [
            'status' => 1,
        ];

        $parking_area->update($data_update);

        return redirect()->route('sewa_parkir')->with(['success' => 'Berhasil melakukan pemesanan lahan!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function show(Rent $rent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function edit(Rent $rent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRentRequest  $request
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRentRequest $request, Rent $rent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rent $rent)
    {
        //
    }
}
