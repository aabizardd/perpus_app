<?php

use App\Models\Car;
use App\Models\Inhabitant;
use App\Models\UserMenu;
use Illuminate\Support\Facades\Auth;

function get_title()
{

    return "Aplikasi Peminjaman Buku Perpustakaan";
}

function get_role($role)
{

    $name = "";

    if ($role == 1) {
        $name = "Admin";
    } else if ($role == 2) {
        $name = "Warga";

    } else {
        $name = "Petugas";
    }

    return $name;

}

function getUserMenu($role)
{
    $menu = UserMenu::where('role', $role)->get();

    // Lakukan operasi lain dengan model $user

    return $menu;
}

function getInhabitantData($id_user)
{
    $data = Inhabitant::where('id_user', $id_user)->first();

    // Lakukan operasi lain dengan model $user

    return $data;
}

function getColorPark($zone)
{
    $color = "";
    // $zone = strtolower($zone);

    if ($zone == 1) {
        $color = "red";
    } else if ($zone == 2) {
        $color = "yellow";
    } else {
        $color = "green";
    }

    return $color;
}

function format_rupiah($angka)
{

    $harga_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $harga_rupiah;
}

function code_lahan($status)
{

    $label = "";

    if ($status == 0) {
        $label = "Tersedia";
    } else {
        $label = "Terjual";
    }

    return $label;
}

function get_user_auth()
{

    return Auth::user();

}

function get_inhabitant($id)
{

    $data = Inhabitant::where('id_user', $id)->first();

    return $data;

}

function opsi_pemesanan($code)
{
    $label = "";

    if ($code == 0) {
        $label = "3 Bulan";
    } else {
        $label = "1 Tahun";
    }

    return $label;
}

function status_pemesanan($code)
{
    $label = "";

    if ($code == 0) {
        $label = "Belum Lunas";
    } else {
        $label = "Sudah Lunas";
    }

    return $label;
}

function status_lahan($code)
{
    $label = "";

    if ($code == 0) {
        $label = "Tersedia";
    } else {
        $label = "Terjual";
    }

    return $label;
}

function get_car_by_land($id_land)
{

    $data = Car::where('id_land', $id_land)->get();

    return $data;

}