<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockControlController;


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
    Route::get('/search', [InvoiceController::class, 'search'])->name('search');
    Route::put('/stock/delete', [InvoiceController::class, 'deleteStock'])->name('stock.delete');
});
Route::prefix('stock_controls')->name('stock_controls.')->group(function () {
    Route::get('/', [StockControlController::class, 'index'])->name('index');
    Route::get('/edit/{id}', [StockControlController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [StockControlController::class, 'update'])->name('update');
    Route::get('/search', [StockControlController::class, 'search'])->name('search');
});


