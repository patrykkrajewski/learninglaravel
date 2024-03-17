<?php

use App\Http\Controllers\InvoiceController;
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

Route::prefix('invoices')->name('invoices.')->group(function () {
    Route::get('/', [InvoiceController::class, 'index'])->name('index');
    Route::get('/create', [InvoiceController::class, 'create'])->name('create');
    Route::post('/store', [InvoiceController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [InvoiceController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [InvoiceController::class, 'update'])->name('update');
    Route::put('/move/{id}', [InvoiceController::class, 'move'])->name('move');
    Route::get('/destroy/{id}', [InvoiceController::class, 'destroy'])->name('destroy');
    Route::get('/search', [InvoiceController::class, 'index'])->name('search');
});

