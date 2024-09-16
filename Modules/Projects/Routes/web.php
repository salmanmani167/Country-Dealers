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

Route::prefix('projects')->group(function() {
    Route::get('/', 'ProjectsController@index')->name('projects.index');
    Route::post('/', 'ProjectsController@store')->name('projects.store');
    Route::put('/', 'ProjectsController@update')->name('projects.update');
    Route::delete('/', 'ProjectsController@destroy')->name('projects.destroy');
    Route::get('list', 'ProjectsController@list')->name('projects.list');
    Route::get('view/{project}', 'ProjectsController@show')->name('projects.show');
});
Route::get('leads', 'ProjectsController@leads')->name('projects.leads');
