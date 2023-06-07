<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [
            'title' => 'Kelola Peminjaman Buku - ' . get_title(),
        ];

        // dd(ParkingArea::where('id_zone', $id)->get());

        $pinjaman = Peminjaman::detail_pinjam();

        $data['pinjaman'] = $pinjaman;
        $data['books'] = Book::all();

        // dd($data['mobil']);

        return view('pages.admin.kelola_peminjaman_buku', $data);
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

        $data = [
            'nama_peminjam' => $request->nama_peminjam,
            'nomor_peminjam' => $request->nomor_peminjam,
            'asal_instansi' => $request->asal_instansi,
            'id_buku' => $request->id_buku,
            'jumlah' => $request->jumlah,
        ];

        $buku = Book::find($data['id_buku']);

        if ($buku->stok < $data['jumlah']) {
            return redirect()->back()->with(['danger' => 'Maaf Jumlah Peminjaman Buku Melebihi Stok Buku Kami!']);
        }

        Peminjaman::create($data);

        return redirect()->back()->with(['success' => 'Data Peminjaman Buku Berhasil Ditambahkan!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //

        $peminjaman = Peminjaman::find($request->id);

        $data = [
            'nama_peminjam' => $request->nama_peminjam,
            'nomor_peminjam' => $request->nomor_peminjam,
            'asal_instansi' => $request->asal_instansi,
            'id_buku' => $request->id_buku,
            'jumlah' => $request->jumlah,
            'status' => $request->status,
            'created_at' => $request->created_at,

        ];

        $buku = Book::find($data['id_buku']);

        if ($buku->stok < $data['jumlah']) {
            return redirect()->back()->with(['danger' => 'Maaf Jumlah Peminjaman Buku Melebihi Stok Buku Kami!']);
        }

        if ($data['status'] == 0) {

            $data['tanggal_pengembalian'] = null;
        } else {
            $data['tanggal_pengembalian'] = $request->tanggal_pengembalian;
        }

        $peminjaman->update($data);

        return redirect()->back()->with('success', 'Data Peminjaman Buku Berhasil Diubah!');
    }

    public function pengembalian($id)
    {
        $peminjaman = Peminjaman::find($id);

        $data = [
            'status' => 1,
            'tanggal_pengembalian' => now(),
        ];

        $peminjaman->update($data);

        return redirect()->back()->with('success', 'Data Peminjaman Buku Berhasil Dihapus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Peminjaman::find($id);

        $data->delete();

        return redirect()->back()->with('success', 'Data Peminjaman Buku Berhasil Dihapus');
    }
}
