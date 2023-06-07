<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {

    if (isset(Auth::user()->id)) {
        return redirect()->route('beranda');

    } else {

        $data = [
            'title' => 'Login - Aplikasi Pemesanan Parkir Perumahan Buah Batu',
        ];

        return view('auth.login', $data);
    }
});

Auth::routes();

Route::get('/beranda', [App\Http\Controllers\BerandaController::class, 'index'])->name('beranda');

Route::prefix('profile')->group(function () {
    Route::get('/', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::post('update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    // Route::post('hapus_akun', [App\Http\Controllers\ProfileController::class, 'hapus_akun'])->name('profile.hapus_akun');
    Route::post('edit_pw', [App\Http\Controllers\ProfileController::class, 'edit_pw'])->name('profile.update_password');
    Route::post('edit_inhabitant', [App\Http\Controllers\ProfileController::class, 'edit_inhabitant'])->name('profile.edit_inhabitant');

});

Route::prefix('kelola_parkir')->group(function () {
    Route::get('/', [App\Http\Controllers\KelolaParkirController::class, 'index'])->name('kelola_parkir');
    Route::get('delete_zone/{id}', [App\Http\Controllers\KelolaParkirController::class, 'delete_zone'])->name('kelola_parkir.delete_zone');

    Route::post('update_zona', [App\Http\Controllers\KelolaParkirController::class, 'update_zona'])->name('kelola_parkir.update_zona');

    Route::get('list_lahan/{id}', [App\Http\Controllers\KelolaParkirController::class, 'list_lahan'])->name('kelola_parkir.list_lahan');

    Route::get('delete_parking/{id}', [App\Http\Controllers\KelolaParkirController::class, 'delete_parking'])->name('kelola_parkir.delete_parking');
    Route::get('tambah_data_lahan/{id}', [App\Http\Controllers\KelolaParkirController::class, 'tambah_data_lahan'])->name('kelola_parkir.tambah_data_lahan');
    Route::post('create_lahan', [App\Http\Controllers\KelolaParkirController::class, 'create_lahan'])->name('kelola_parkir.create_lahan');

    Route::get('update_data_lahan/{id}', [App\Http\Controllers\KelolaParkirController::class, 'update_data_lahan'])->name('kelola_parkir.update_data_lahan');
    Route::post('update_lahan', [App\Http\Controllers\KelolaParkirController::class, 'update_lahan'])->name('kelola_parkir.update_lahan');

    Route::get('getDataCar/{id}', [App\Http\Controllers\KelolaParkirController::class, 'getDataCar'])->name('kelola_parkir.getDataCar');

});

Route::prefix('laporan_warga')->group(function () {
    Route::get('/', [App\Http\Controllers\InhabitantReportController::class, 'index'])->name('laporan_warga');
    Route::get('selesaikan_laporan/{id}', [App\Http\Controllers\InhabitantReportController::class, 'selesaikan_laporan'])->name('laporan_warga.selesaikan_laporan');

});

Route::prefix('sewa_parkir')->group(function () {
    Route::get('/', [App\Http\Controllers\KelolaParkirController::class, 'index'])->name('sewa_parkir');
    Route::get('list_lahan/{id}', [App\Http\Controllers\KelolaParkirController::class, 'list_lahan'])->name('sewa_parkir.list_lahan');

    Route::get('{id}', [App\Http\Controllers\RentController::class, 'index'])->name('sewa_parkir.penyewaan');
    Route::post('store', [App\Http\Controllers\RentController::class, 'store'])->name('sewa_parkir.store');

});

Route::prefix('cek_lahan')->group(function () {
    Route::get('/', [App\Http\Controllers\LandCheckController::class, 'index'])->name('cek_lahan');

    Route::post('cari_lahan', [App\Http\Controllers\LandCheckController::class, 'cari_lahan'])->name('cek_lahan.cari_lahan');

    Route::get('detail_lahan/{id}', [App\Http\Controllers\LandCheckController::class, 'detail_lahan'])->name('cek_lahan.detail_lahan');

    // Route::get('list_lahan/{id}', [App\Http\Controllers\KelolaParkirController::class, 'list_lahan'])->name('sewa_parkir.list_lahan');

});

Route::prefix('mobil')->group(function () {
    Route::get('/', [App\Http\Controllers\CarController::class, 'index'])->name('mobil');
    Route::get('delete/{id}', [App\Http\Controllers\CarController::class, 'delete'])->name('mobil.delete');
    Route::post('store', [App\Http\Controllers\CarController::class, 'store'])->name('mobil.store');
    Route::post('update', [App\Http\Controllers\CarController::class, 'update'])->name('mobil.update');
    Route::get('update_land_car/{id}', [App\Http\Controllers\CarController::class, 'update_land_car'])->name('mobil.update_land_car');
    Route::post('add_car_to_land}', [App\Http\Controllers\CarController::class, 'add_car_to_land'])->name('mobil.add_car_to_land');

    // Route::get('list_lahan/{id}', [App\Http\Controllers\KelolaParkirController::class, 'list_lahan'])->name('sewa_parkir.list_lahan');

});

Route::prefix('histori_pemesanan')->group(function () {
    Route::get('/', [App\Http\Controllers\RentHistoryController::class, 'index'])->name('histori_pemesanan');
    Route::get('terima_pesanan/{id}', [App\Http\Controllers\RentHistoryController::class, 'terima_pesanan'])->name('histori_pemesanan.terima_pesanan');

    // Route::get('list_lahan/{id}', [App\Http\Controllers\KelolaParkirController::class, 'list_lahan'])->name('sewa_parkir.list_lahan');

});

Route::prefix('keuangan')->group(function () {
    Route::get('/', [App\Http\Controllers\FinanceController::class, 'index'])->name('keuangan');
    Route::post('store', [App\Http\Controllers\FinanceController::class, 'store'])->name('keuangan.store');

    // Route::get('list_lahan/{id}', [App\Http\Controllers\KelolaParkirController::class, 'list_lahan'])->name('sewa_parkir.list_lahan');

});

Route::prefix('kelola_admin')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('kelola_admin');
    Route::post('store', [App\Http\Controllers\AdminController::class, 'store'])->name('admin.store');
    Route::post('update', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.update');
    Route::get('hapus/{id}', [App\Http\Controllers\AdminController::class, 'destroy'])->name('admin.hapus');

    // Route::get('list_lahan/{id}', [App\Http\Controllers\KelolaParkirController::class, 'list_lahan'])->name('sewa_parkir.list_lahan');

});

Route::prefix('kelola_buku')->group(function () {
    Route::get('/', [App\Http\Controllers\BookController::class, 'index'])->name('kelola_buku');
    Route::post('store', [App\Http\Controllers\BookController::class, 'store'])->name('buku.store');
    Route::post('update', [App\Http\Controllers\BookController::class, 'update'])->name('buku.update');
    Route::get('hapus/{id}', [App\Http\Controllers\BookController::class, 'destroy'])->name('buku.hapus');

    // Route::get('list_lahan/{id}', [App\Http\Controllers\KelolaParkirController::class, 'list_lahan'])->name('sewa_parkir.list_lahan');

});

Route::prefix('peminjaman_buku')->group(function () {
    Route::get('/', [App\Http\Controllers\PeminjamanBukuController::class, 'index'])->name('peminjaman_buku');
    Route::post('store', [App\Http\Controllers\PeminjamanBukuController::class, 'store'])->name('peminjaman.store');
    Route::post('update', [App\Http\Controllers\PeminjamanBukuController::class, 'update'])->name('peminjaman.update');
    Route::get('hapus/{id}', [App\Http\Controllers\PeminjamanBukuController::class, 'destroy'])->name('peminjaman.hapus');
    Route::get('pengembalian/{id}', [App\Http\Controllers\PeminjamanBukuController::class, 'pengembalian'])->name('peminjaman.pengembalian');

    // Route::get('list_lahan/{id}', [App\Http\Controllers\KelolaParkirController::class, 'list_lahan'])->name('sewa_parkir.list_lahan');

});
