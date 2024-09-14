<?php

use Illuminate\Support\Facades\Route;
use Modules\Employee\Http\Controllers\CompanyController;
use Modules\Employee\Http\Controllers\EmployeeProductController;
use Modules\Employee\Http\Controllers\HeadOfficeController;
use Modules\Employee\Http\Controllers\BranchController;


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
