<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController as AuthCont;
use App\Http\Controllers\AdminController as AdmCont;
use App\Http\Controllers\SupplierController as SuppCont;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthCont::class, 'login'])->name('login');
Route::get('/register', [AuthCont::class, 'register'])->name('register');
Route::post('/simpan_user', [AuthCont::class, 'simpan_user'])->name('simpan_user');
Route::post('/cek_user', [AuthCont::class, 'cek_user'])->name('cek_user');
Route::post('/logout', [AuthCont::class, 'logout'])->name('logout');

// Proses Verifikasi Email

// Route untuk halaman verifikasi email
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

// Route untuk memproses verifikasi email
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/login'); // Ubah ke halaman yang sesuai setelah verifikasi berhasil
})->middleware(['auth', 'signed'])->name('verification.verify');

// Route untuk mengirim ulang email verifikasi
Route::post('/email/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('resent', true);
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');


Route::middleware(['auth', 'role:admin', 'verified'])->group(function () {
    Route::get('/dashboard/admin', [AdmCont::class, 'dashboard'])
        ->name('admin.dashboard');
});

Route::middleware(['auth', 'role:supplier', 'verified'])->group(function () {
    Route::get('/dashboard/supplier', [SuppCont::class, 'dashboard'])
        ->name('supplier.dashboard');
    
    Route::get('/supplier/pengiriman_kayu', [SuppCont::class, 'pengiriman_kayu'])->name('supplier.pengiriman_kayu');

    Route::get('/supplier/kayu_dikirim', [SuppCont::class, 'kayu_dikirim'])->name('supplier.kayu_dikirim');

    Route::post('/supplier/simpan_kayu', [SuppCont::class, 'simpan_kayu'])->name('supplier.simpan_kayu');

    Route::post('/supplier/simpan_pbb_kendaraan', [SuppCont::class, 'simpan_pbb_kendaraan'])->name('supplier.simpan_pbb_kendaraan');

    Route::post('/supplier/preview_surat', [SuppCont::class, 'preview_surat'])->name('supplier.preview_surat');

    Route::post('/supplier/simpan_pbb', [SuppCont::class, 'simpan_pbb'])->name('supplier.simpan_pbb');

    Route::post('/supplier/simpan_kendaraan', [SuppCont::class, 'simpan_kendaraan'])->name('supplier.simpan_kendaraan');

    Route::get('/supplier/tampil_pbb_kendaraan', [SuppCont::class, 'tampil_pbb_kendaraan'])->name('supplier.tampil_pbb_kendaraan');

    Route::post('/supplier/preview_surat', [SuppCont::class, 'preview_surat'])->name('supplier.preview_surat');

    Route::post('/supplier/simpan_surat', [SuppCont::class, 'simpan_surat'])->name('supplier.simpan_surat');

    Route::get('/supplier/data_pengiriman', [SuppCont::class, 'data_pengiriman'])->name('supplier.data_pengiriman');

    Route::post('/supplier/buat_surat_angkutan', [SuppCont::class, 'buat_surat_angkutan'])->name('supplier.buat_surat_angkutan');

    Route::get('/supplier/lihat_surat/{kode_pengiriman}', [SuppCont::class, 'lihat_surat'])->name('supplier.lihat_surat');

    Route::get('/supplier/detail_pengiriman/{kode_pengiriman}', [SuppCont::class, 'detail_pengiriman'])->name('supplier.detail_pengiriman');

    Route::get('/supplier/profil', [SuppCont::class, 'profil'])->name('supplier.profil');
});
