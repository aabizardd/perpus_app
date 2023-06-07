<?php

namespace App\Http\Controllers;

use App\Models\Inhabitant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
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
            'title' => 'Beranda - Aplikasi Pemesanan Parkir Perumahan Buah Batu',
        ];

        return view('pages.profile', $data);

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
    public function update(Request $request)
    {
        // dd('ok');
        $user = User::findOrFail($request->id_user);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'max:255', Rule::unique('users')->ignore($user->id)],
            'avatar' => ['nullable', 'image', 'mimes:jpg,png,jpeg,webp,gif,svg,bmp', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
        ];

        // if($file)

        // dd($fileName);

        if ($request->hasFile('avatar')) {

            $file = $request->file('avatar');
            $fileName = $file->getClientOriginalName();

            // dd($fileName);

            if (file_exists(public_path('assets/images/avatar/' . $user->avatar))) {
                if ($user->avatar != 'default.png') {
                    unlink(public_path('assets/images/avatar/' . $user->avatar));
                }

            }

            $imageName = time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('assets/images/avatar'), $imageName);
            $data['avatar'] = $imageName;
        }

        $user->update($data);

        return redirect()->back()->with(['success' => 'Data Pengguna Berhasil Diupdate!']);
    }

    public function edit_pw(Request $request)
    {

        $user = User::findOrFail($request->id_user);

        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            // 'password_confirmation' => ['required', 'string', 'min:6'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'password' => Hash::make($request->password_confirmation),
        ];

        $user->update($data);

        return redirect()->back()->with(['success' => 'Password Anda Berhasil Diupdate!']);

    }

    public function edit_inhabitant(Request $request)
    {

        $user = Inhabitant::where('id_user', $request->id_user)->first();

        $validator = Validator::make($request->all(), [
            'address' => ['required', 'string', 'max:30'],
            'phone_number' => ['required', 'max:15'],
            // 'password_confirmation' => ['required', 'string', 'min:6'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'address' => $request->address,
            'phone_number' => $request->phone_number,
        ];

        $user->update($data);

        return redirect()->back()->with(['success' => 'Data Warga Anda Berhasil Diupdate!']);

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
