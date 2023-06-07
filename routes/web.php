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
    // Route::post('edit_inhabitant', [App\Http\Controllers\ProfileController::class, 'edit_inhabitant'])->name('profile.edit_inhabitant');

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
