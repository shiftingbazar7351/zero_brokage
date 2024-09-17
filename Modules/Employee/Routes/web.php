<?php

use Illuminate\Support\Facades\Route;
use Modules\Employee\Http\Controllers\CompanyController;
use Modules\Employee\Http\Controllers\EmployeeProductController;
use Modules\Employee\Http\Controllers\HeadOfficeController;
use Modules\Employee\Http\Controllers\BranchController;
use Modules\Employee\Http\Controllers\DepartmentController;


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

Route::resource('/employee-company', CompanyController::class);
Route::resource('/employee-product', EmployeeProductController::class);
Route::resource('/employee-headoffice', HeadOfficeController::class);
Route::resource('/employee-branch', BranchController::class);
Route::resource('/employee-department', DepartmentController::class);

Route::controller(CompanyController::class)->group(function () {
    Route::get('/employee-company', 'index')->name('employee-company.index')->middleware('can:employee-company-list'); // List all employee-company
    Route::get('/employee-company/create', 'create')->name('employee-company.create')->middleware('can:employee-company-create'); // Show form to create a category
    Route::post('/employee-company', 'store')->name('employee-company.store')->middleware('can:employee-company-create'); // Store a new category
    Route::get('/employee-company/{category}/edit', 'edit')->name('employee-company.edit')->middleware('can:employee-company-edit'); // Edit category form
    Route::put('/employee-company/{category}', 'update')->name('employee-company.update')->middleware('can:employee-company-edit'); // Update the category
    Route::get('/employee-company/{category}', 'show')->name('employee-company.show')->middleware('can:employee-company-show'); // Show a single category (corrected to GET)
    Route::delete('/employee-company/{category}', 'destroy')->name('employee-company.destroy')->middleware('can:employee-company-delete'); // Delete a category
    Route::post('/category-status', 'categoryStatus')->name('employee-company.status')->middleware('can:employee-company-status'); // Change category status
});

Route::controller(EmployeeProductController::class)->group(function () {
    Route::get('/employee-product', 'index')->name('employee-product.index')->middleware('can:employee-product-list'); // List all employee-product
    Route::get('/employee-product/create', 'create')->name('employee-product.create')->middleware('can:employee-product-create'); // Show form to create a category
    Route::post('/employee-product', 'store')->name('employee-product.store')->middleware('can:employee-product-create'); // Store a new category
    Route::get('/employee-product/{category}/edit', 'edit')->name('employee-product.edit')->middleware('can:employee-product-edit'); // Edit category form
    Route::put('/employee-product/{category}', 'update')->name('employee-product.update')->middleware('can:employee-product-edit'); // Update the category
    Route::get('/employee-product/{category}', 'show')->name('employee-product.show')->middleware('can:employee-product-show'); // Show a single category (corrected to GET)
    Route::delete('/employee-product/{category}', 'destroy')->name('employee-product.destroy')->middleware('can:employee-product-delete'); // Delete a category
    Route::post('/employee-company-status', 'employeeCompanyStatus')->name('employee-product.status')->middleware('can:employee-product-status'); // Change category status
});


Route::controller(HeadOfficeController::class)->group(function () {
    Route::get('/employee-company', 'index')->name('employee-company.index')->middleware('can:employee-company-list'); // List all employee-company
    Route::get('/employee-company/create', 'create')->name('employee-company.create')->middleware('can:employee-company-create'); // Show form to create a category
    Route::post('/employee-company', 'store')->name('employee-company.store')->middleware('can:employee-company-create'); // Store a new category
    Route::get('/employee-company/{category}/edit', 'edit')->name('employee-company.edit')->middleware('can:employee-company-edit'); // Edit category form
    Route::put('/employee-company/{category}', 'update')->name('employee-company.update')->middleware('can:employee-company-edit'); // Update the category
    Route::get('/employee-company/{category}', 'show')->name('employee-company.show')->middleware('can:employee-company-show'); // Show a single category (corrected to GET)
    Route::delete('/employee-company/{category}', 'destroy')->name('employee-company.destroy')->middleware('can:employee-company-delete'); // Delete a category
    Route::post('/category-status', 'categoryStatus')->name('employee-company.status')->middleware('can:employee-company-status'); // Change category status
});


Route::controller(BranchController::class)->group(function () {
    Route::get('/employee-company', 'index')->name('employee-company.index')->middleware('can:employee-company-list'); // List all employee-company
    Route::get('/employee-company/create', 'create')->name('employee-company.create')->middleware('can:employee-company-create'); // Show form to create a category
    Route::post('/employee-company', 'store')->name('employee-company.store')->middleware('can:employee-company-create'); // Store a new category
    Route::get('/employee-company/{category}/edit', 'edit')->name('employee-company.edit')->middleware('can:employee-company-edit'); // Edit category form
    Route::put('/employee-company/{category}', 'update')->name('employee-company.update')->middleware('can:employee-company-edit'); // Update the category
    Route::get('/employee-company/{category}', 'show')->name('employee-company.show')->middleware('can:employee-company-show'); // Show a single category (corrected to GET)
    Route::delete('/employee-company/{category}', 'destroy')->name('employee-company.destroy')->middleware('can:employee-company-delete'); // Delete a category
    Route::post('/category-status', 'categoryStatus')->name('employee-company.status')->middleware('can:employee-company-status'); // Change category status
});
