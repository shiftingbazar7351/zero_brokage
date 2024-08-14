<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MetaDescripConroller;
use App\Http\Controllers\MetaTitleController;
use App\Http\Controllers\MetaUrlController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceDetailController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



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


Route::get('/service-list', [FrontendController::class, 'serviceList'])->name('service-list');


Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/service-details', [FrontendController::class, 'serviceDetails'])->name('service-details');
Route::get('/service-grid/{slug}', [FrontendController::class, 'subCategory'])->name('service.grid');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index')->name('user.index')->middleware('can:user-list');
        Route::get('/user/create', 'create')->name('user.create')->middleware('can:user-create');
        Route::post('/user', 'store')->name('user.store')->middleware('can:user-create');
        Route::get('/user/{user}/edit', 'edit')->name('user.edit')->middleware('can:user-edit');
        Route::patch('/user/update/{user}', 'update')->name('update.user')->middleware('can:user-edit');
        Route::post('/user/{user}', 'show')->name('user.show')->middleware('can:user-show');
        Route::delete('/user/{user}', 'destroy')->name('user.destroy')->middleware('can:user-delete');
    });

    Route::get('/dashboard', [AdminController::class, 'homepage'])->name('admin_page');
    Route::resource('categories', CategoryController::class);
    Route::post('/category-status', [CategoryController::class, 'categoryStatus'])->name('categories.status');

    Route::resource('subcategories', SubCategoryController::class);
    Route::post('/sub-category-status', [SubCategoryController::class, 'subCategoryStatus'])->name('subcategories.status');

    Route::resource('/menus', MenuController::class);
    Route::post('/menu-status', [MenuController::class, 'menuStatus'])->name('menu.status');
    Route::post('/fetch-subcategory/{id}', [MenuController::class, 'fetchsubcategory']);

    Route::resource('service-detail', ServiceDetailController::class);
    Route::resource('/enquiry', EnquiryController::class);
    Route::post('/enquiry-status', [EnquiryController::class, 'enquiryStatus'])->name('enquiry.status');

    Route::resource('/meta', MetaDescripConroller::class);
    Route::resource('/meta-url', MetaUrlController::class);
    Route::resource('/meta-title', MetaTitleController::class);

});


require __DIR__ . '/auth.php';
