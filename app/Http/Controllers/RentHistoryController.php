<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rent;
use Illuminate\Http\Request;

class RentHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [
            'title' => 'Histori Pemesanan Lahan - Aplikasi Pemesanan Parkir Perumahan Buah Batu',

        ];

        if (get_user_auth()->role == 2) {

            $id_inhabitant = get_inhabitant(get_user_auth()->id)->id;
            $data_histori = Rent::where('id_inhabitant', $id_inhabitant)->get();
            $my_land = Rent::my_land($id_inhabitant);
            $my_car = Car::where('id_inhabitant', $id_inhabitant)->get();

            $data['data_histori'] = $data_histori;
            $data['my_land'] = $my_land;
            $data['my_car'] = $my_car;

        } elseif (get_user_auth()->role == 1) {

            $data['data_histori'] = Rent::all();
        }

        // dd(ParkingArea::where('id_zone', $id)->get());

        return view('pages.histori_pemesanan_lahan', $data);

    }

    public function terima_pesanan($id)
    {

        $rent = Rent::find($id);

        $data = [
            'status' => 1,
        ];

        $rent->update($data);

        return redirect()->back()->with(['success' => 'Pemesanan berhasil diterima!']);

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