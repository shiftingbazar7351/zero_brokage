<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SubmenuController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\UserController;

Route::get('/category-listing', function () {
    return view('frontend.categories');
})->name('categories.listing');

Route::get('/booking', function () {
    return view('frontend.booking');
})->name('booking');

Route::get('/service-details', function () {
    return view('frontend.service-details');
})->name('service-details');
// frontend
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/service-grid/{slug}', [FrontendController::class, 'subCategory'])->name('service.grid');
// Route::get('/service-details/{slug}', [FrontendController::class, 'serviceDetails'])->name('service.details');

// for backend
Route::resource('categories', CategoryController::class);
Route::get('/categories-details', [CategoryController::class, 'service_details'])->name('details');
Route::resource('subcategories', SubCategoryController::class);
Route::post('/fetch-subcategory/{id}', [SubCategoryController::class, 'fetchsubcategory']);
Route::post('/fetch-menus/{id}', [SubCategoryController::class, 'fetchmenu']);
Route::post('/fetch-city/{stateId}', [SubCategoryController::class, 'fetchCity']);

Route::post('/services-submenu', [SubmenuController::class, 'store'])->name('submenu.store');

Route::get('/services_subcategory', [UserController::class, 'sub_category'])->name('subcategory');
Route::get('/services_menu', [UserController::class, 'menu'])->name('menu');
Route::get('/services_submenu', [UserController::class, 'submenu'])->name('submenu');
Route::resource('menu', CategoryController::class);
Route::post('/update-status', [CategoryController::class, 'updateStatus'])->name('update.status');
Route::get('/footer-about-us', [FooterController::class, 'about_us'])->name('about');
Route::get('/footer-blog', [FooterController::class, 'blog'])->name('blog');
Route::get('/footer-contact', [FooterController::class, 'contact'])->name('contact');
Route::get('/admin-homepage', [AdminController::class, 'homepage'])->name('admin_page');
