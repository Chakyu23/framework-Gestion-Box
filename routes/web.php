<?php

use App\Http\Controllers\Box_ModelsController;
use App\Http\Controllers\LocatairesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(LocatairesController::class)->group(function () {
    Route::get('/Locataires', 'list');
    Route::get('/Locataire', 'store');
    Route::post('/Locataire/New', 'create');
    Route::get('/Locataire/{id}', 'show');
    Route::get('/Locataire/{id}/Edit', 'edit');
    Route::put('/Locataire/{id}', 'update');
    Route::delete('/Locataire/{id}', 'delete');
});

require __DIR__.'/auth.php';
