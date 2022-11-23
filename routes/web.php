<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// User Interface Admin Penjualan
Route::get('/penjualan', [PenjualanController::class, 'penjualan']);
Route::get('/add-penjualan', [PenjualanController::class, 'addPenjualan']);
Route::get('/edit-penjualan/{id}', [PenjualanController::class, 'editPenjualan']);

// api penjualan
Route::post('/create-penjualan', [PenjualanController::class, 'post_penjualan']);
Route::post('/update-penjualan', [PenjualanController::class, 'update_penjualan']);
Route::get('/delete-penjualan/{id}', [PenjualanController::class, 'delete_penjualan']);


// User Interface Admin Pembelian
Route::get('/pembelian', [PembelianController::class, 'pembelian']);
Route::get('/add-pembelian', [PembelianController::class, 'addPembelian']);
Route::get('/edit-pembelian/{id}', [PembelianController::class, 'editPembelian']);

// api pembelian
Route::post('/create-pembelian', [PembelianController::class, 'post_pembelian']);
Route::post('/update-pembelian', [PembelianController::class, 'update_pembelian']);
Route::get('/delete-pembelian/{id}', [PembelianController::class, 'delete_pembelian']);


// User Interface Admin Barang
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/add-barang', [HomeController::class, 'addBarang']);
Route::get('/edit-barang/{id}', [HomeController::class, 'editBarang']);

// api barang
Route::post('/create-barang', [HomeController::class, 'post_barang']);
Route::post('/update-barang', [HomeController::class, 'update_barang']);
Route::get('/delete-barang/{id}', [HomeController::class, 'delete_barang']);

// User Interface Admin Lokasi
Route::get('/lokasi', [LokasiController::class, 'index']);
Route::get('/add-lokasi', [LokasiController::class, 'addLokasi']);
Route::get('/edit-lokasi/{id}', [LokasiController::class, 'editLokasi']);

// api lokasi
Route::post('/create-lokasi', [LokasiController::class, 'post_lokasi']);
Route::post('/update-lokasi', [LokasiController::class, 'update_lokasi']);
Route::get('/delete-lokasi/{id}', [LokasiController::class, 'delete_lokasi']);

// barang penjualan dan pembelian
Route::get('/barang-pembelian', [HomeController::class, 'get_barang_pembelian']);
Route::get('/barang-penjualan', [HomeController::class, 'get_barang_penjualan']);
Route::get('/kartu-stok', [HomeController::class, 'get_kartu_stok']);