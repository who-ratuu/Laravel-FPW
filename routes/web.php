<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Pertemuan 2
//Named Routes
Route::get('/profile', function () {
    return 'Halaman Profile';
})->name('profile');

//Routes Group
Route::prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return 'Halaman Dashboard Admin';
    });

    Route::get('/users', function () {
        return 'Halaman Users Admin';
    });

});
// Modul Praktikum
use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// Tugas Praktikum 2 
// No 2
Route::get('/about', function () {
    return 'Barokah Mart menjual berbagai macam produk 
    kebutuhan sehari-hari hingga makanan segar!';
});
 
// No 3
Route::get('/products', function () {
    return 'Daftar Produk';
});

Route::post('/products', function () {
    return 'Data produk berhasil disimpan';
});


