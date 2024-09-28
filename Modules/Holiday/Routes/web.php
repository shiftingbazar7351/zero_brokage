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
    Route::get('/holiday-bank', 'index')->name('holiday-bank.index')->middleware('can:holiday-bank-list'); // List all holiday-headoffice
    Route::get('/holiday-bank/create', 'create')->name('holiday-bank.create')->middleware('can:holiday-bank-create'); // Show form to create a category
    Route::post('/holiday-bank', 'store')->name('holiday-bank.store')->middleware('can:holiday-bank-create'); // Store a new category
    Route::get('/holiday-bank/{bank}/edit', 'edit')->name('holiday-bank.edit')->middleware('can:holiday-bank-edit'); // Edit category form
    Route::put('/holiday-bank/{bank}', 'update')->name('holiday-bank.update')->middleware('can:holiday-bank-edit'); // Update the category
    Route::get('/holiday-bank/{bank}', 'show')->name('holiday-bank.show')->middleware('can:holiday-bank-show'); // Show a single category (corrected to GET)
    Route::delete('/holiday-bank/{bank}', 'destroy')->name('holiday-bank.destroy')->middleware('can:holiday-bank-delete'); // Delete a category
    Route::post('/holiday-bank-status', 'BankStatus')->name('holiday-bank.status')->middleware('can:holiday-bank-status'); // Change category status
});
