<?php

use App\Http\Controllers\FolderController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts', PostController::class);
Route::delete('/deletephoto/{id}',[PostController::class,'deletephoto'])->name('deletephoto');
Route::delete('/deletemusic/{id}', [PostController::class, 'deleteMusic'])->name('deletemusic');
Route::post('/addmusic/{id}',[PostController::class,'addmusic'])->name('addmusic');
Route::post('/addphotos/{id}',[PostController::class,'addphotos'])->name('addphotos');
Route::put('/update/{id}',[PostController::class,'update'])->name('posts.update');

Route::resource('folders', FolderController::class);
Route::get('/search', [SearchController::class, 'search'])->name('search');
