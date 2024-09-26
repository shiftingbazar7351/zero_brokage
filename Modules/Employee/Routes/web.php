<?php

use Illuminate\Support\Facades\Route;
use Modules\Employee\Http\Controllers\CompanyController;
use Modules\Employee\Http\Controllers\EmployeeProductController;
use Modules\Employee\Http\Controllers\HeadOfficeController;
use Modules\Employee\Http\Controllers\BranchController;
use Modules\Employee\Http\Controllers\DepartmentController;
use Modules\Employee\Http\Controllers\EmployeeController;
use Modules\Employee\Http\Controllers\SalaryController;
use Modules\Employee\Http\Controllers\BankController;
use Modules\Employee\Http\Controllers\HrNameController;

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

// Route::resource('/employee-company', CompanyController::class);
// Route::resource('/employee-product', EmployeeProductController::class);
// Route::resource('/employee-headoffice', HeadOfficeController::class);
// Route::resource('/employee-branch', BranchController::class);
// Route::resource('/employee-department', DepartmentController::class);

Route::controller(CompanyController::class)->group(function () {
    Route::get('/employee-company', 'index')->name('employee-company.index')->middleware('can:employee-company-list'); // List all employee-company
    Route::get('/employee-company/create', 'create')->name('employee-company.create')->middleware('can:employee-company-create'); // Show form to create a category
    Route::post('/employee-company', 'store')->name('employee-company.store')->middleware('can:employee-company-create'); // Store a new category
    Route::get('/employee-company/{company}/edit', 'edit')->name('employee-company.edit')->middleware('can:employee-company-edit'); // Edit category form
    Route::put('/employee-company/{company}', 'update')->name('employee-company.update')->middleware('can:employee-company-edit'); // Update the category
    Route::get('/employee-company/{company}', 'show')->name('employee-company.show')->middleware('can:employee-company-show'); // Show a single category (corrected to GET)
    Route::delete('/employee-company/{company}', 'destroy')->name('employee-company.destroy')->middleware('can:employee-company-delete'); // Delete a category
    Route::post('/employee-company-status', 'CompanyStatus')->name('employee-company.status')->middleware('can:employee-company-status'); // Change category status
});

Route::controller(EmployeeProductController::class)->group(function () {
    Route::get('/employee-product', 'index')->name('employee-product.index')->middleware('can:employee-product-list'); // List all employee-product
    Route::get('/employee-product/create', 'create')->name('employee-product.create')->middleware('can:employee-product-create'); // Show form to create a category
    Route::post('/employee-product', 'store')->name('employee-product.store')->middleware('can:employee-product-create'); // Store a new category
    Route::get('/employee-product/{product}/edit', 'edit')->name('employee-product.edit')->middleware('can:employee-product-edit'); // Edit category form
    Route::put('/employee-product/{product}', 'update')->name('employee-product.update')->middleware('can:employee-product-edit'); // Update the category
    Route::get('/employee-product/{product}', 'show')->name('employee-product.show')->middleware('can:employee-product-show'); // Show a single category (corrected to GET)
    Route::delete('/employee-product/{product}', 'destroy')->name('employee-product.destroy')->middleware('can:employee-product-delete'); // Delete a category
    Route::post('/employee-product-status', 'productStatus')->name('employee-product.status')->middleware('can:employee-product-status'); // Change category status
});

Route::controller(HeadOfficeController::class)->group(function () {
    Route::get('/employee-headoffice', 'index')->name('employee-headoffice.index')->middleware('can:employee-headoffice-list'); // List all employee-headoffice
    Route::get('/employee-headoffice/create', 'create')->name('employee-headoffice.create')->middleware('can:employee-headoffice-create'); // Show form to create a category
    Route::post('/employee-headoffice', 'store')->name('employee-headoffice.store')->middleware('can:employee-headoffice-create'); // Store a new category
    Route::get('/employee-headoffice/{headoffice}/edit', 'edit')->name('employee-headoffice.edit')->middleware('can:employee-headoffice-edit'); // Edit category form
    Route::put('/employee-headoffice/{headoffice}', 'update')->name('employee-headoffice.update')->middleware('can:employee-headoffice-edit'); // Update the category
    Route::get('/employee-headoffice/{headoffice}', 'show')->name('employee-headoffice.show')->middleware('can:employee-headoffice-show'); // Show a single category (corrected to GET)
    Route::delete('/employee-headoffice/{headoffice}', 'destroy')->name('employee-headoffice.destroy')->middleware('can:employee-headoffice-delete'); // Delete a category
    Route::post('/employee-headoffice-status', 'HeadOfficeStatus')->name('employee-headoffice.status')->middleware('can:employee-headoffice-status'); // Change category status
});

Route::controller(BranchController::class)->group(function () {
    Route::get('/employee-branch', 'index')->name('employee-branch.index')->middleware('can:employee-branch-list'); // List all employee-branch
    Route::get('/employee-branch/create', 'create')->name('employee-branch.create')->middleware('can:employee-branch-create'); // Show form to create a category
    Route::post('/employee-branch', 'store')->name('employee-branch.store')->middleware('can:employee-branch-create'); // Store a new category
    Route::get('/employee-branch/{branch}/edit', 'edit')->name('employee-branch.edit')->middleware('can:employee-branch-edit'); // Edit category form
    Route::put('/employee-branch/{branch}', 'update')->name('employee-branch.update')->middleware('can:employee-branch-edit'); // Update the category
    Route::get('/employee-branch/{branch}', 'show')->name('employee-branch.show')->middleware('can:employee-branch-show'); // Show a single category (corrected to GET)
    Route::delete('/employee-branch/{branch}', 'destroy')->name('employee-branch.destroy')->middleware('can:employee-branch-delete'); // Delete a category
    Route::post('/employee-branch-status', 'branchStatus')->name('employee-branch.status')->middleware('can:employee-branch-status'); // Change category status
});


Route::controller(DepartmentController::class)->group(function () {
    Route::get('/employee-department', 'index')->name('employee-department.index')->middleware('can:employee-department-list'); // List all employee-department
    Route::get('/employee-department/create', 'create')->name('employee-department.create')->middleware('can:employee-department-create'); // Show form to create a category
    Route::post('/employee-department', 'store')->name('employee-department.store')->middleware('can:employee-department-create'); // Store a new category
    Route::get('/employee-department/{department}/edit', 'edit')->name('employee-department.edit')->middleware('can:employee-department-edit'); // Edit department form
    Route::put('/employee-department/{department}', 'update')->name('employee-department.update')->middleware('can:employee-department-edit'); // Update the department
    Route::get('/employee-department/{department}', 'show')->name('employee-department.show')->middleware('can:employee-department-show'); // Show a single department (corrected to GET)
    Route::delete('/employee-department/{department}', 'destroy')->name('employee-department.destroy')->middleware('can:employee-department-delete'); // Delete a category
    Route::post('/employee-department-status', 'DepartmentStatus')->name('employee-department.status')->middleware('can:employee-department-status'); // Change category status
});

Route::controller(EmployeeController::class)->group(function () {
    Route::get('/employee', 'index')->name('employee.index')->middleware('can:employee-list'); // List all employee-department
    Route::get('/employee/create', 'create')->name('employee.create')->middleware('can:employee-create'); // Show form to create a category
    Route::post('/employee', 'store')->name('employee.store')->middleware('can:employee-create'); // Store a new category
    Route::get('/employee/{id}/edit', 'edit')->name('employee.edit')->middleware('can:employee-edit'); // Edit department form
    Route::put('/employee/{id}', 'update')->name('employee.update')->middleware('can:employee-edit'); // Update the department
    Route::get('/employee/{id}', 'show')->name('employee.show')->middleware('can:employee-show'); // Show a single department (corrected to GET)
    Route::delete('/employee/{id}', 'destroy')->name('employee.destroy')->middleware('can:employee-delete'); // Delete a category
    Route::post('/employee-status', 'DepartmentStatus')->name('employee.status')->middleware('can:employee-status'); // Change category status
});

Route::controller(SalaryController::class)->group(function () {
    Route::get('/employee-salary', 'index')->name('employee-salary.index')->middleware('can:employee-salary-list'); // List all employee-headoffice
    Route::get('/employee-salary/create', 'create')->name('employee-salary.create')->middleware('can:employee-salary-create'); // Show form to create a category
    Route::post('/employee-salary', 'store')->name('employee-salary.store')->middleware('can:employee-salary-create'); // Store a new category
    Route::get('/employee-salary/{salary}/edit', 'edit')->name('employee-salary.edit')->middleware('can:employee-salary-edit'); // Edit category form
    Route::put('/employee-salary/{salary}', 'update')->name('employee-salary.update')->middleware('can:employee-salary-edit'); // Update the category
    Route::get('/employee-salary/{salary}', 'show')->name('employee-salary.show')->middleware('can:employee-salary-show'); // Show a single category (corrected to GET)
    Route::delete('/employee-salary/{salary}', 'destroy')->name('employee-salary.destroy')->middleware('can:employee-salary-delete'); // Delete a category
    Route::post('/employee-salary-status', 'SalaryStatus')->name('employee-salary.status')->middleware('can:employee-salary-status'); // Change category status

});
Route::get('/employees', [SalaryController::class, 'getEmployees']);

Route::controller(BankController::class)->group(function () {
    Route::get('/employee-bank', 'index')->name('employee-bank.index')->middleware('can:employee-bank-list'); // List all employee-headoffice
    Route::get('/employee-bank/create', 'create')->name('employee-bank.create')->middleware('can:employee-bank-create'); // Show form to create a category
    Route::post('/employee-bank', 'store')->name('employee-bank.store')->middleware('can:employee-bank-create'); // Store a new category
    Route::get('/employee-bank/{bank}/edit', 'edit')->name('employee-bank.edit')->middleware('can:employee-bank-edit'); // Edit category form
    Route::put('/employee-bank/{bank}', 'update')->name('employee-bank.update')->middleware('can:employee-bank-edit'); // Update the category
    Route::get('/employee-bank/{bank}', 'show')->name('employee-bank.show')->middleware('can:employee-bank-show'); // Show a single category (corrected to GET)
    Route::delete('/employee-bank/{bank}', 'destroy')->name('employee-bank.destroy')->middleware('can:employee-bank-delete'); // Delete a category
    Route::post('/employee-bank-status', 'BankStatus')->name('employee-bank.status')->middleware('can:employee-bank-status'); // Change category status
});

Route::controller(HrNameController::class)->group(function () {
    Route::get('/employee-hr', 'index')->name('employee-hr.index')->middleware('can:employee-hr-list'); // List all employee-headoffice
    Route::get('/employee-hr/create', 'create')->name('employee-hr.create')->middleware('can:employee-hr-create'); // Show form to create a category
    Route::post('/employee-hr', 'store')->name('employee-hr.store')->middleware('can:employee-hr-create'); // Store a new category
    Route::get('/employee-hr/{hr}/edit', 'edit')->name('employee-hr.edit')->middleware('can:employee-hr-edit'); // Edit category form
    Route::put('/employee-hr/{hr}', 'update')->name('employee-hr.update')->middleware('can:employee-hr-edit'); // Update the category
    Route::get('/employee-hr/{hr}', 'show')->name('employee-hr.show')->middleware('can:employee-hr-show'); // Show a single category (corrected to GET)
    Route::delete('/employee-hr/{hr}', 'destroy')->name('employee-hr.destroy')->middleware('can:employee-hr-delete'); // Delete a category
    Route::post('/employee-hr-status', 'HrStatus')->name('employee-hr.status')->middleware('can:employee-hr-status'); // Change category status
});
