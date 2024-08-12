<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MetaDescripConroller;
use App\Http\Controllers\MetaTitleController;
use App\Http\Controllers\MetaUrlController;
use App\Http\Controllers\ServiceDetailController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\MenuController;

// frontend
// These routes are handled by the FrontendController
Route::get('/category-listing', function () {
    return view('frontend.categories');
})->name('categories.listing');

Route::get('/booking', function () {
    return view('frontend.booking');
})->name('booking');

Route::get('/service-details', function () {
    return view('frontend.service-details');
})->name('service-details');

Route::get('/preview-details', function () {
    return view('frontend.preview_details');
})->name('service-details');

Route::get('/pricing-details', function () {
    return view('frontend.pricing');
})->name('pricing');

Route::get('/privacy-policy', function () {
    return view('frontend.privacy-policy');
})->name('privacy');

Route::get('/term-condition', function () {
    return view('frontend.term-condition');
})->name('term-condition');


Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/service-details', [FrontendController::class, 'serviceDetails'])->name('service-details');
Route::get('/service-grid/{slug}', [FrontendController::class, 'subCategory'])->name('service.grid');

// Backend Routes
Route::get('/admin-homepage', [AdminController::class, 'homepage'])->name('admin_page');

// These routes are handled by the CategoryController
Route::resource('categories', CategoryController::class);
Route::get('/categories-details', [CategoryController::class, 'service_details'])->name('details');
Route::post('/update-status', [CategoryController::class, 'updateStatus'])->name('update.status');

// These routes are handled by the SubCategoryController
Route::resource('subcategories', SubCategoryController::class);
Route::post('/fetch-subcategory/{id}', [SubCategoryController::class, 'fetchsubcategory']);
Route::post('/fetch-menus/{id}', [SubCategoryController::class, 'fetchmenu']);
Route::post('/fetch-city/{stateId}', [SubCategoryController::class, 'fetchCity']);
Route::post('/update-subcategorystatus', [SubCategoryController::class, 'updateStatus'])->name('update.subcategorystatus');

// These routes are handled by various Meta controllers
Route::resource('/meta', MetaDescripConroller::class);
Route::resource('/meta-url', MetaUrlController::class);
Route::resource('/meta-title', MetaTitleController::class);
Route::resource('/service-detail', ServiceDetailController::class);

Route::resource('/enquiry', EnquiryController::class);
// Route::post('/fetch-subcategory/{id}', [EnquiryController::class, 'fetchsubcategory']);
// Fetch subcategories based on category ID
Route::get('/fetch-subcategory/{category_id}', [EnquiryController::class, 'fetchSubcategories'])->name('enquiry.subcategories');


Route::resource('/menus', MenuController::class);
Route::post('/update-subcategorystatus', [MenuController::class, 'updateStatus'])->name('update.subcategorystatus');
Route::post('/fetch-subcategory/{id}', [MenuController::class, 'fetchsubcategory']);

// Route::post('/services-submenu', [SubmenuController::class, 'store'])->name('submenu.store');
// Route::get('/services_subcategory', [UserController::class, 'sub_category'])->name('subcategory');
// Route::get('/services_menu', [UserController::class, 'menu'])->name('menu');
// Route::get('/services_submenu', [UserController::class, 'submenu'])->name('submenu');
// Route::resource('menu', CategoryController::class);

// Route::get('/footer-about-us', [FooterController::class, 'about_us'])->name('about');
// Route::get('/footer-blog', [FooterController::class, 'blog'])->name('blog');
// Route::get('/footer-contact', [FooterController::class, 'contact'])->name('contact');

// Route::post('/fetch-city/{id}', [SubCategoryController::class, 'fetchcity']);

