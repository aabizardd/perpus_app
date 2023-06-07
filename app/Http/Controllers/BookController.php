<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [
            'title' => 'Kelola Buku - ' . get_title(),
        ];

        // dd(ParkingArea::where('id_zone', $id)->get());

        $book = Book::all();

        $data['book'] = $book;

        // dd($data['mobil']);

        return view('pages.admin.kelola_buku', $data);
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
            'nama_buku' => $request->nama_buku,
            'stok' => $request->stok,
        ];

        // dd($fileName);

        $imageName = time() . '.' . $request->gambar_buku->extension();

        // dd($imageName);
        $request->gambar_buku->move(public_path('assets/images/book_cover'), $imageName);
        $data['gambar_buku'] = $imageName;

        Book::create($data);

        return redirect()->back()->with(['success' => 'Data Buku Berhasil Ditambahkan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $book = Book::findOrFail($request->id);

        $data = [
            'nama_buku' => $request->nama_buku,
            'stok' => $request->stok,
        ];

        if ($request->hasFile('gambar_buku')) {

            $file = $request->file('gambar_buku');
            $fileName = $file->getClientOriginalName();

            // dd($fileName);

            if (file_exists(public_path('assets/images/book_cover/' . $book->gambar_buku))) {
                if ($book->gambar_buku != 'cover.jpg') {
                    unlink(public_path('assets/images/book_cover/' . $book->gambar_buku));
                }

            }

            $imageName = time() . '.' . $request->gambar_buku->extension();
            $request->gambar_buku->move(public_path('assets/images/book_cover'), $imageName);
            $data['gambar_buku'] = $imageName;
        }

        $book->update($data);

        return redirect()->back()->with(['success' => 'Data Buku Berhasil Diupdate!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //

        $data = Book::find($id);

        if (file_exists(public_path('assets/images/book_cover/' . $data->gambar_buku))) {
            if ($data->gambar_buku != 'cover.jpg') {
                unlink(public_path('assets/images/book_cover/' . $data->gambar_buku));
            }
        }

        // dd($data);

        $data->delete();

        return redirect()->back()->with('success', 'Data Buku Berhasil dihapus');
    }
}
