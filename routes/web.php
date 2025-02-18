<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ContractModelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaxController;
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
    // Boxes
    Route::get('/boxes', [BoxController::class, 'index'])->name('boxes.index');
    Route::get('/boxes/create', [BoxController::class, 'create'])->name('boxes.create');
    Route::post('/boxes', [BoxController::class, 'store'])->name('boxes.store');
    Route::get('/boxes/{box}', [BoxController::class, 'show'])->name('boxes.show');
    Route::get('/boxes/{box}/edit', [BoxController::class, 'edit'])->name('boxes.edit');
    Route::put('/boxes/{box}', [BoxController::class, 'update'])->name('boxes.update');
    Route::delete('/boxes/{box}', [BoxController::class, 'destroy'])->name('boxes.destroy');

    // Tenant
    Route::get('/tenants', [TenantController::class, 'index'])->name('tenants.index');
    Route::get('/tenants/create', [TenantController::class, 'create'])->name('tenants.create');
    Route::post('/tenants', [TenantController::class, 'store'])->name('tenants.store');
    Route::get('/tenants/{tenant}', [TenantController::class, 'show'])->name('tenants.show');
    Route::get('/tenants/{tenant}/edit', [TenantController::class, 'edit'])->name('tenants.edit');
    Route::put('/tenants/{tenant}', [TenantController::class, 'update'])->name('tenants.update');
    Route::delete('/tenants/{tenant}', [TenantController::class, 'destroy'])->name('tenants.destroy');

    // ModelContract
    Route::get('/contractModels', [ContractModelController::class, 'index'])->name('contractModels.index');
    Route::get('/contractModels/create', [ContractModelController::class, 'create'])->name('contractModels.create');
    Route::post('/contractModels', [ContractModelController::class, 'store'])->name('contractModels.store');
    Route::get('/contractModels/{contractModel}', [ContractModelController::class, 'show'])->name('contractModels.show');
    Route::get('/contractModels/{contractModel}/edit', [ContractModelController::class, 'edit'])->name('contractModels.edit');
    Route::put('/contractModels/{contractModel}', [ContractModelController::class, 'update'])->name('contractModels.update');
    Route::delete('/contractModels/{contractModel}', [ContractModelController::class, 'destroy'])->name('contractModels.destroy');

    // Contract
    Route::get('/contracts', [ContractController::class, 'index'])->name('contracts.index');
    Route::get('/contracts/create', [ContractController::class, 'create'])->name('contracts.create');
    Route::post('/contracts', [ContractController::class, 'store'])->name('contracts.store');
    Route::get('/contracts/{contract}', [ContractController::class, 'show'])->name('contracts.show');
    Route::get('/contracts/{contract}/edit', [ContractController::class, 'edit'])->name('contracts.edit');
    Route::put('/contracts/{contract}', [ContractController::class, 'update'])->name('contracts.update');
    Route::delete('/contracts/{contract}', [ContractController::class, 'destroy'])->name('contracts.destroy');

    // bills
    Route::get('/contracts/{contractId}/bills', [BillController::class, 'index'])->name('bills.index');
    Route::post('contracts/getBills', [BillController::class, 'generateBills'])->name('contracts.generateBills');
    Route::put('/bills/{bill}/pay', [BillController::class, 'pay'])->name('bills.pay');

    // tax
    Route::get('/taxes', [TaxController::class, 'index'])->name('taxes.index');
    //Route::get('/taxes/pdf', [TaxController::class, 'generatePdf'])->name('taxes.pdf');
});





require __DIR__.'/auth.php';
