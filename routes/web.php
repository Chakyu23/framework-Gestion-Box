<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ContractModelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocataireController;

Route::get('/', [HomeController::class, 'index'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('boxes', BoxController::class);
    Route::resource('tenants', TenantController::class);
    Route::resource('contractModels', ContractModelController::class);
    Route::resource('contracts', ContractController::class);
    Route::resource('bills', BillController::class);
});

Route::resource('locataire', LocataireController::class)->middleware('auth');

require __DIR__.'/auth.php';
