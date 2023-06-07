<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $car = Car::get_car();

        $data = [
            'title' => 'Kelola Mobil - Aplikasi Pemesanan Parkir Perumahan Buah Batu',
            'car' => $car,
        ];

        // dd(ParkingArea::where('id_zone', $id)->get());

        if (get_user_auth()->role == 1) {
            return view('pages.list_mobil', $data);
        } else {

            $inhabitant = get_inhabitant(get_user_auth()->id)->id;

            $data['mobil'] = Car::where('id_inhabitant', $inhabitant)->get();

            // dd($data['mobil']);

            return view('pages.list_mobil_warga', $data);
        }

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

        $data = [
            'license_number' => $request->license_number,
            'brand' => $request->brand,
            'color' => $request->color,
            'id_inhabitant' => get_inhabitant(get_user_auth()->id)->id,
        ];

        Car::create($data);

        return redirect()->back()->with(['success' => 'Data Mobil Berhasil Disimpan!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //

        $car = Car::find($request->id);

        $data = [
            'license_number' => $request->license_number,
            'brand' => $request->brand,
            'color' => $request->color,
        ];

        $car->update($data);

        return redirect()->back()->with(['success' => 'Data Mobil Berhasil Diubah!']);

    }

    public function update_land_car($id)
    {
        $car = Car::find($id);

        $data = [
            'id_land' => null,
        ];

        $car->update($data);

        return redirect()->back()->with(['success_car' => 'Data Mobil Berhasil Dihapus dari area parkir!']);
    }

    public function add_car_to_land(Request $request)
    {

        $car = Car::find($request->id_car);

        $data = [
            'id_land' => $request->id_land,
        ];

        $car->update($data);

        return redirect()->back()->with(['success_car' => 'Data Mobil Berhasil ditambahkan ke area parkir!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //

        $data = Car::find($id);

        // dd($data);

        $data->delete();

        return redirect()->back()->with('success', 'Data Mpbil Berhasil dihapus');

    }
}