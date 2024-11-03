<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Auth;

// Halaman utama atau welcome yang dapat diakses siapa saja
Route::get('/', function () {
    return view('auth.login');
});

// Route Autentikasi
Auth::routes(); // Menambahkan route login, register, reset password secara otomatis

// Grup route yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {
    // Route untuk halaman utama setelah login
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Route untuk PostController
    Route::resource('posts', PostController::class);
    Route::delete('/deletephoto/{id}', [PostController::class, 'deletephoto'])->name('deletephoto');
    Route::delete('/deletemusic/{id}', [PostController::class, 'deleteMusic'])->name('deletemusic');
    Route::post('/addmusic/{id}', [PostController::class, 'addmusic'])->name('addmusic');
    Route::post('/addphotos/{id}', [PostController::class, 'addphotos'])->name('addphotos');
    Route::put('/update/{id}', [PostController::class, 'update'])->name('posts.update');

    // Route untuk FolderController
    Route::resource('folders', FolderController::class);

    // Route untuk pencarian
    Route::get('/search', [SearchController::class, 'search'])->name('search');
});
