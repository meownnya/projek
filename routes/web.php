<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts', PostController::class);
Route::delete('/musics/{id}', [PostController::class, 'deletemusic'])->name('deletemusic');
Route::delete('/posts/{id}', [PostController::class, 'deletephoto'])->name('deletephoto');

Route::put('/update/{id}',[PostController::class,'update'])->name('posts.update');
