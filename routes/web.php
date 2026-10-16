<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

// Pertemuan 2 - Named Routes
Route::get('/profile', function () {
    return 'Halaman Profile';
})->name('profile');

// Pertemuan 2 - Routes Group
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return 'Halaman Dashboard Admin';
    });

    Route::get('/users', function () {
        return 'Halaman Users Admin';
    });
});

// Modul Praktikum - Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// Tugas Praktikum 2 - About
Route::get('/about', function () {
    return 'Haii, Selamat datang di Barokah Mart, kami menjual
    berbagai macam produk kebutuhan sehari-hari hingga menjual
    makanan segar!';
});

// Tugas Praktikum 2 - Produk
Route::get('/products', function () {
    return 'Daftar Produk';
});

Route::post('/products', function () {
    return 'Data produk berhasil disimpan';
});

// Pertemuan 4 - Login Manual
Route::get('/login', [LoginController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [LoginController::class, 'store'])
    ->middleware('guest')
    ->name('login.store');

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Akses Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);

    Route::get('/reports/sales', [ReportController::class, 'sales'])
        ->name('report.sales');

    Route::get('/users', function () {
        return 'Halaman Kelola Akun Kasir';
    });
});

// Akses Admin dan Kasir
Route::middleware(['auth', 'role:admin,kasir'])->group(function () {
    Route::get('/pos', [PosController::class, 'index'])
        ->name('pos.index');

    Route::post('/pos', [PosController::class, 'store'])
        ->name('pos.store');

    Route::get('/pos/history', function () {
        return 'Riwayat Transaksi Saya';
    })->name('pos.history');
});

// Pertemuan 5 - Praktikum Presentasi
Route::get('/index', function () {
    $posts = [
        (object) ['title' => 'Belajar', 'content' => true],
        (object) ['title' => 'Belajar lagi', 'content' => true],
        (object) ['title' => 'Belajar lagi lagi', 'content' => true],
    ];

    return view('posts.index', compact('posts'));
});

// Praktikum 7 - Route 
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);