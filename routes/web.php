<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProfileController;
use App\Models\Kategori;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/berita',[BeritaController::class, 'index'])->name('berita.index'); 
Route::get('/berita/create',[BeritaController::class, 'create'])->name('berita.create'); 
Route::post('/berita',[BeritaController::class, 'store'])->name('berita.store'); 
Route::get('/berita/{id}/edit',[BeritaController::class, 'edit'])->name('berita.edit'); 
Route::put('/berita/{id}',[BeritaController::class, 'update'])->name('berita.update'); 
Route::delete('/berita/{id}',[BeritaController::class, 'destroy'])->name('berita.destroy'); 

Route::get('/kategori',[KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/create',[KategoriController::class, 'create'])->name('kategori.create');
Route::post('/kategori',[KategoriController::class, 'store'])->name('kategori.store'); 
Route::get('/kategori/{id}/edit',[KategoriController::class, 'edit'])->name('kategori.edit'); 
Route::put('/kategori/{id}',[KategoriController::class, 'update'])->name('kategori.update'); 
Route::delete('/kategori/{id}',[KategoriController::class, 'destroy'])->name('kategori.destroy'); 

require __DIR__.'/auth.php';
