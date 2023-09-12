<?php

use App\Http\Controllers\BeritaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/posts',[BeritaController::class,'berita']);
Route::get('/posts/{id}',[BeritaController::class,'show']);
Route::get('/kategori',[BeritaController::class,'listkategori']);
Route::get('/kategori/{id}',[BeritaController::class,'kategori']);