<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Pertemuan 2
Route::get('/about', function () {
    return 'Halaman About';
});

Route::get('/user/{id}', function ($id) {
    return 'User: ' . $id;
});

Route::get('/user/{name?}', function ($name = 'Tamu') {
    return $name;
});

Route::get('/user-id/{id}', function ($id) {
    return 'User ID: ' . $id;
})->where('id', '[0-9]+');

use App\Models\User;

Route::get('/user/{user}', function (User $user) {
    return $user->name;
});

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