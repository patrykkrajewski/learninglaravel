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
Route::get('/stock-controls', function (){
    return view('stock_controls');
});
Route::get('/', function (){
    return view('invoice_archive');
});
Route::prefix('invoices')->name('invoices.')->group(function () {
    Route::get('/', [InvoiceController::class, 'index'])->name('index');
    Route::get('/create', [InvoiceController::class, 'create'])->name('create');
    Route::post('/store', [InvoiceController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [InvoiceController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [InvoiceController::class, 'update'])->name('update');
    Route::get('/search', [InvoiceController::class, 'search'])->name('search');
});
Route::get('/stock-controls', [StockControlController::class, 'index'])->name('stock-controls');
Route::put('/stock-controls/edit/{id}', [StockControlController::class, 'edit'])->name('stock-controls.edit');



