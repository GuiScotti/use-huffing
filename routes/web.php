<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoupaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('/roupas', RoupaController::class);
    Route::post('/roupas/{id}/favorito', [RoupaController::class, 'favorito'])->middleware('auth')->name('roupas.favorito');
    Route::get('/favoritos', [RoupaController::class, 'favoritos'])->name('roupas.favoritos');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';