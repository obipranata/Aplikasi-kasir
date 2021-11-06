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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@index');

// Route::middleware(['admin'])->group(function(){
//     Route::get('/', 'admin\DashboardController@index')->name('admin-dashboard');
// });
// Route::middleware(['kasir'])->group(function(){
//     Route::get('/','kasir\TransaksiController@index')->name('kasir-transaksi');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->namespace('Admin')->middleware(['admin'])->group(function(){
    Route::get('/', 'DashboardController@index')->name('admin-dashboard');
    Route::get('/transaksi', 'TransaksiController@index')->name('admin-transaksi');
    Route::get('/getTransaksi/{nota}', 'TransaksiController@getTransaksi')->name('get-transaksi');
    Route::post('/cetak-barcode/{kd_produk}', 'ProdukController@cetak')->name('cetak-produk');
    Route::resource('kategori', 'KategoriController');
    Route::resource('produk', 'ProdukController');
    Route::resource('kasir', 'KasirController');
});

Route::prefix('kasir')->namespace('Kasir')->middleware(['kasir'])->group(function(){
    Route::get('/','TransaksiController@index')->name('kasir-transaksi');
    Route::get('/getProduk/{kd_produk}', 'TransaksiController@getProduk')->name('get-produk');
    Route::post('/transaksi/store', 'TransaksiController@store');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
