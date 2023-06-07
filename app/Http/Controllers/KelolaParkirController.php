<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\ParkingArea;
use App\Models\ParkZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class KelolaParkirController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Kelola Lahan Parkiran - Aplikasi Pemesanan Parkir Perumahan Buah Batu',
            'park_zone' => ParkZone::all(),
        ];

        if (Auth::user()->role == 1 || Auth::user()->role == 3) {

            return view('pages.kelola_parkir', $data);
        } else {
            return view('pages.pilih_zona', $data);
        }
    }

    public function delete_zone($id)
    {
        $data = ParkZone::find($id);

        $data->delete();

        return redirect()->back()->with('success', 'Data Zona Parkir Berhasil dihapus');
    }

    public function update_zona(Request $request)
    {
        // dd('ok');
        $zone = ParkZone::findOrFail($request->id);

        $data = [
            'zone' => $request->zone,

        ];

        $zone->update($data);

        return redirect()->back()->with(['success' => 'Data Zona Berhasil Diupdate!']);
    }

    public function list_lahan($id)
    {
        $data = [
            'title' => 'Kelola Lahan Parkiran - Aplikasi Pemesanan Parkir Perumahan Buah Batu',
            'parking_area' => ParkingArea::where('id_zone', $id)->get(),
        ];

        // dd(ParkingArea::where('id_zone', $id)->get());

        if (Auth::user()->role == 1 || Auth::user()->role == 3) {

            return view('pages.list_lahan', $data);
        } else {
            return view('pages.list_lahan_w', $data);
        }

    }

    public function delete_parking($land_code)
    {
        $data = ParkingArea::where('land_code', $land_code);

        // dd($data);

        $data->delete();

        return redirect()->back()->with('success', 'Data Lahan Parkir Berhasil dihapus');
    }

    public function tambah_data_lahan($id_zone)
    {

        $data = [
            'title' => 'Tambah Lahan Parkiran - Aplikasi Pemesanan Parkir Perumahan Buah Batu',
        ];

        return view('pages.tambah_data_lahan', $data);
    }

    public function create_lahan(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'land_code' => ['required', 'string', 'max:255', 'unique:parking_area'],
            'price' => ['required'],
            'address' => ['required', 'string'],
            'capacity' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'land_code' => $request->land_code,
            'price' => $request->price,
            'address' => $request->address,
            'capacity' => $request->capacity,
            'information' => $request->information,
            'id_zone' => $request->id_zone,
        ];

        ParkingArea::create($data);

        return redirect()->back()->with(['success' => 'Data Parkiran Berhasil ditambahkan!']);

    }

    public function update_data_lahan($id_land)
    {

        $zone = ParkingArea::where('land_code', $id_land)->first();

        $data = [
            'title' => 'Edit Lahan Parkiran - Aplikasi Pemesanan Parkir Perumahan Buah Batu',
            'zone' => $zone,
        ];

        return view('pages.edit_data_lahan', $data);
    }

    public function update_lahan(Request $request)
    {

        $id_land = $request->id_land_old;

        $zone = ParkingArea::where('land_code', $id_land)->get();

        // dd();

        $validator = Validator::make($request->all(), [
            'land_code' => ['required', 'string', 'max:255', Rule::unique('parking_area')->ignore($zone[0]->land_code, 'land_code')],
            'price' => ['required'],
            'address' => ['required', 'string'],
            'capacity' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'land_code' => $request->land_code,
            'price' => $request->price,
            'address' => $request->address,
            'capacity' => $request->capacity,
            'information' => $request->information,
            'id_zone' => $request->id_zone,
        ];

        $affected = ParkingArea::where('land_code', $id_land)->update($data);

        return redirect()->back()->with(['success' => 'Data Parkiran Berhasil diubah!']);

    }

    public function getDataCar($id_land)
    {
        // Mengambil data dari model atau sumber data lainnya
        $data = Car::where('id_land', $id_land)->get(); // Ganti dengan model yang sesuai atau sumber data Anda

        // Mengirimkan data sebagai respons JSON
        return response()->json($data);
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
