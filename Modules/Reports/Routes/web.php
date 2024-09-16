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

Route::prefix('reports')->group(function() {
    Route::get('expenses', 'ReportsController@expenses')->name('reports.expense');
    Route::get('invoices', 'ReportsController@invoices')->name('reports.invoice');
});
