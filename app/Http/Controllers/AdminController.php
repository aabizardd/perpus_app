<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [
            'title' => 'Kelola Admin - ' . get_title(),
        ];

        // dd(ParkingArea::where('id_zone', $id)->get());

        $admin = get_user_auth()->id;

        $data['admin'] = User::where('role', 1)->where('id', '!=', $admin)->get();

        // dd($data['mobil']);

        return view('pages.admin.kelola_admin', $data);

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

        $username = $request->username;

        /// cek apakah username sudah ada?

        $data_admin = User::where('username', $username);
        $data_email = User::where('email', $request->email);

        if ($data_admin->count() > 0) {

            return redirect()->back()->with(['danger' => 'Username Sudah Digunakan, Coba Dengan Username Yang Lain!']);

        }

        if ($data_email->count() > 0) {

            return redirect()->back()->with(['danger' => 'Email Sudah Digunakan, Coba Dengan Email Yang Lain!']);

        }

        $data = [
            'username' => $username,
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ];

        User::create($data);

        return redirect()->back()->with(['success' => 'Data Admin Berhasil Ditambahkan!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $username = $request->username;
        $old_username = $request->old_username;

        if ($username != $old_username) {

            $data_admin = User::where('username', $username);

            if ($data_admin->count() > 0) {

                return redirect()->back()->with(['danger' => 'Username Sudah Digunakan, Coba Dengan Username Yang Lain!']);

            }

        }

        $email = $request->email;
        $old_email = $request->old_email;

        if ($email != $old_email) {

            $data_email = User::where('email', $email);

            if ($data_email->count() > 0) {

                return redirect()->back()->with(['danger' => 'Email Sudah Digunakan, Coba Dengan Email Yang Lain!']);

            }

        }

        $pw = "";

        if ($request->new_password == "") {
            // dd('kosong');

            $pw = $request->old_password;
        } else {
            $pw = Hash::make($request->password);
        }

        $car = User::find($request->id);

        $data = [
            'username' => $username,
            'email' => $email,
            'name' => $request->name,
            'password' => $pw,
        ];

        $car->update($data);

        return redirect()->back()->with(['success' => 'Data Admin Berhasil Diubah!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $data = User::find($id);

        // dd($data);

        $data->delete();

        return redirect()->back()->with('success', 'Data Admin Berhasil dihapus');

    }
}