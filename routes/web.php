<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts', PostController::class);
Route::delete('/deletephoto/{id}',[PostController::class,'deletephoto'])->name('deletephoto');
Route::delete('/deletemusic/{id}', [PostController::class, 'deleteMusic'])->name('deletemusic');
Route::put('/update/{id}',[PostController::class,'update'])->name('posts.update');
