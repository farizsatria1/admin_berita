<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\UserappController;
use App\Http\Controllers\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//API Berita    
Route::get('/posts',[BeritaController::class,'berita']);
Route::get('/posts/{id}',[BeritaController::class,'show']);

//API kategori
Route::get('/kategori',[BeritaController::class,'listkategori']);
Route::get('/kategori/{id}',[BeritaController::class,'kategori']);

//API search
Route::get('/search',[BeritaController::class,'cari']);

//API Video
Route::get('/videos',[VideoController::class,'list']);

//API Profile dan Authentikasi
Route::post('/daftar', [UserappController::class, 'daftar']);
Route::post('/login', [UserappController::class, 'login']);

