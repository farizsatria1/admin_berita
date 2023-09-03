<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
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

Route::get('/berita', function () {
    return view('berita.index');
})->middleware(['auth', 'verified'])->name('berita.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/berita',[BeritaController::class, 'index'])->name('berita.index')->middleware('auth'); 
    Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');
    
    Route::get('/berita/create',[BeritaController::class, 'create'])->name('berita.create')->middleware('auth'); 
    Route::post('/berita',[BeritaController::class, 'store'])->name('berita.store')->middleware('auth');  
    Route::get('/berita/{id}/edit',[BeritaController::class, 'edit'])->name('berita.edit')->middleware('auth'); 
    Route::put('/berita/{id}',[BeritaController::class, 'update'])->name('berita.update')->middleware('auth');  
    Route::delete('/berita/{id}',[BeritaController::class, 'destroy'])->name('berita.destroy')->middleware('auth');  
    
    Route::get('/kategori',[KategoriController::class, 'index'])->name('kategori.index')->middleware('auth'); 
    Route::get('/kategori/create',[KategoriController::class, 'create'])->name('kategori.create')->middleware('auth'); 
    Route::post('/kategori',[KategoriController::class, 'store'])->name('kategori.store')->middleware('auth');  
    Route::get('/kategori/{id}/edit',[KategoriController::class, 'edit'])->name('kategori.edit')->middleware('auth');  
    Route::put('/kategori/{id}',[KategoriController::class, 'update'])->name('kategori.update')->middleware('auth');  
    Route::delete('/kategori/{id}',[KategoriController::class, 'destroy'])->name('kategori.destroy')->middleware('auth');  
});

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');


Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register/action', [RegisterController::class, 'actionregister'])->name('actionregister');
