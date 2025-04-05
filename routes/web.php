<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\FakturController;


Route::get('/', function () {
    return view('welcome');
});


Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::resource('barang', BarangController::class);
Route::resource('kategori', KategoriController::class);


Route::get('/barang-user', [BarangController::class, 'userView'])->name('barang.user');


Route::post('/keranjang/{id}', [FakturController::class, 'tambahKeranjang'])->name('keranjang.tambah');
Route::get('/faktur', [FakturController::class, 'tampilFaktur'])->name('faktur.index');
Route::post('/faktur', [FakturController::class, 'simpanFaktur'])->name('faktur.simpan');

Route::get('/faktur/cetak/{id}', [App\Http\Controllers\FakturController::class, 'cetakFaktur'])->name('faktur.cetak');
