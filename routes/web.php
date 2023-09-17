<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['auth'])->group(function () {
    Route::get('/berita',[BeritaController::class, 'index'])->name('berita.index'); 
    Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout'); 
    
    Route::get('/berita/create',[BeritaController::class, 'create'])->name('berita.create');  
    Route::post('/berita',[BeritaController::class, 'store'])->name('berita.store');   
    Route::get('/berita/{id}/edit',[BeritaController::class, 'edit'])->name('berita.edit');  
    Route::put('/berita/{id}',[BeritaController::class, 'update'])->name('berita.update');   
    Route::get('/berita/{id}',[BeritaController::class, 'destroy'])->name('berita.destroy');   
    
    Route::get('/kategori',[KategoriController::class, 'index'])->name('kategori.index');  
    Route::get('/kategori/create',[KategoriController::class, 'create'])->name('kategori.create');  
    Route::post('/kategori',[KategoriController::class, 'store'])->name('kategori.store');   
    Route::get('/kategori/{id}/edit',[KategoriController::class, 'edit'])->name('kategori.edit');   
    Route::put('/kategori/{id}',[KategoriController::class, 'update'])->name('kategori.update');     

    Route::get('/video',[VideoController::class, 'index'])->name('video.index');  
    Route::get('/video/create',[VideoController::class, 'create'])->name('video.create');  
    Route::post('/video',[VideoController::class, 'store'])->name('video.store');   
    Route::get('/video/{id}/edit',[VideoController::class, 'edit'])->name('video.edit');   
    Route::put('/video/{id}',[VideoController::class, 'update'])->name('video.update');    
    Route::get('/video/{id}',[VideoController::class, 'destroy'])->name('video.destroy');  
});

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');


Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register/action', [RegisterController::class, 'actionregister'])->name('actionregister');

