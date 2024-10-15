<?php

use Modules\Holiday\Http\Controllers\HolidayController;

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



Route::controller(HolidayController::class)->group(function () {
    Route::get('/holiday', 'index')->name('holiday.index')->middleware('can:holiday-list'); // List all holiday-headoffice
    Route::get('/holiday/create', 'create')->name('holiday.create')->middleware('can:holiday-create'); // Show form to create a category
    Route::post('/holiday', 'store')->name('holiday.store')->middleware('can:holiday-create'); // Store a new category
    Route::get('/holiday/{id}/edit', 'edit')->name('holiday.edit')->middleware('can:holiday-edit'); // Edit category form
    Route::put('/holiday/{id}', 'update')->name('holiday.update')->middleware('can:holiday-edit'); // Update the category
    Route::get('/holiday/{id}', 'show')->name('holiday.show')->middleware('can:holiday-show'); // Show a single category (corrected to GET)
    Route::delete('/holiday/{id}', 'destroy')->name('holiday.destroy')->middleware('can:holiday-delete'); // Delete a category
    Route::post('/holiday-status', 'HolidayStatus')->name('holiday.status')->middleware('can:holiday-status'); // Change category status
});
