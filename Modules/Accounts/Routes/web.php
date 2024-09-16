<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Modules\Accounts\Http\Controllers\SalesController;
use Modules\Accounts\Http\Controllers\InvoiceController;
use Modules\Accounts\Http\Controllers\AccountsController;
use Modules\Accounts\Http\Controllers\ProductsController;

Route::get("taxes", [AccountsController::class, 'taxes'])->name('taxes');
Route::get("provident-funds", [AccountsController::class, 'providentFunds'])->name('provident-funds');
Route::get("expenses", [AccountsController::class, 'expenses'])->name('expenses');
Route::resource('invoices', InvoiceController::class);
Route::get('invoices-pdf/{invoice}', [InvoiceController::class, 'pdf'])->name('invoice.pdf');
Route::get('products', [ProductsController::class, 'index'])->name('products');
Route::get('sales', [SalesController::class, 'index'])->name('sales.index');
