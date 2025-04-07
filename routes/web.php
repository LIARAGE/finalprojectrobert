<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\FakturController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('barang', BarangController::class);
    Route::resource('kategori', KategoriController::class);
});


Route::get('/barang-user', [BarangController::class, 'userView'])->name('barang.user');

Route::post('/keranjang/{id}', [FakturController::class, 'tambahKeranjang'])->name('keranjang.tambah');
Route::get('/faktur', [FakturController::class, 'tampilFaktur'])->name('faktur.index');
Route::post('/faktur', [FakturController::class, 'simpanFaktur'])->name('faktur.simpan');
Route::get('/faktur/cetak/{id}', [FakturController::class, 'cetakFaktur'])->name('faktur.cetak');
