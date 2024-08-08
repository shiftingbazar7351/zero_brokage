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
use App\Http\Controllers\MetaDescripConroller;
use App\Http\Controllers\MetaUrlController;
use App\Http\Controllers\MetaTitleController;

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
// for backend
Route::resource('categories', CategoryController::class);
Route::get('/categories-details', [CategoryController::class, 'service_details'])->name('details');

Route::resource('subcategories', SubCategoryController::class);
Route::post('/fetch-subcategory/{id}', [SubCategoryController::class, 'fetchsubcategory']);
Route::post('/fetch-menus/{id}', [SubCategoryController::class, 'fetchmenu']);
Route::post('/fetch-city/{stateId}', [SubCategoryController::class, 'fetchCity']);
Route::post('/edit-fetch-city/{stateId}', [SubCategoryController::class, 'editFetchCity']);

Route::post('/update-subcategorystatus', [SubCategoryController::class, 'updateStatus'])->name('update.subcategorystatus');
Route::post('/services-submenu', [SubmenuController::class, 'store'])->name('submenu.store');
Route::get('/services_subcategory', [UserController::class, 'sub_category'])->name('subcategory');
Route::get('/services_menu', [UserController::class, 'menu'])->name('menu');
Route::get('/services_submenu', [UserController::class, 'submenu'])->name('submenu');
Route::resource('menu', CategoryController::class);
Route::post('/update-status', [CategoryController::class, 'updateStatus'])->name('update.status');
Route::post('/update-subcategorystatus', [SubCategoryController::class, 'updateStatus'])->name('update.subcategorystatus');
Route::get('/footer-about-us', [FooterController::class, 'about_us'])->name('about');
Route::get('/footer-blog', [FooterController::class, 'blog'])->name('blog');
Route::get('/footer-contact', [FooterController::class, 'contact'])->name('contact');
Route::get('/admin-homepage', [AdminController::class, 'homepage'])->name('admin_page');
Route::post('/fetch-city/{id}', [SubCategoryController::class, 'fetchcity']);
Route::resource('/meta', MetaDescripConroller::class);
Route::resource('/meta-url', MetaUrlController::class);
Route::resource('/meta-title', MetaTitleController::class);