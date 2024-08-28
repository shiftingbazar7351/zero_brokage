<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\IndiaServiceController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MetaDescripConroller;
use App\Http\Controllers\MetaTitleController;
use App\Http\Controllers\MetaUrlController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceDetailController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubMenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
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
Route::get('/category-listing', function () {
    return view('frontend.categories');
})->name('categories.listing');

Route::get('/booking', function () {
    return view('frontend.booking');
})->name('booking');

// Route::get('/service-details', function () {
//     return view('frontend.service-details');
// })->name('service-details');

Route::get('/preview-details', function () {
    return view('frontend.preview_details');
})->name('preview-details');

Route::get('/pricing-details', function () {
    return view('frontend.pricing');
})->name('pricing');

Route::get('/privacy-policy', function () {
    return view('frontend.privacy-policy');
})->name('privacy');

Route::get('/term-condition', function () {
    return view('frontend.term-and-condition');
})->name('term-condition');

// Route::get('/services-in-india', function () {
//     return view('frontend.services-in-india');
// })->name('services-in-india');

Route::get('/vender-profile', function () {
    return view('frontend.vender-profile');
})->name('vender-profile');

// Route::get('/service-in-india-city', function () {
//     return view('frontend.service-in-india-city');
// })->name('service-in-india-city');

Route::get('/create-vendor', function () {
    return view('frontend.create-vendor');
})->name('create-vendor');

Route::get('/privacy-policy', function () {
    return view('frontend.privacy-policy');
})->name('privacy-policy');

Route::get('/service-list', [FrontendController::class, 'serviceList'])->name('service-list');
Route::get('/services-in-india', [FrontendController::class, 'servicesInIndia'])->name('services-in-india');
Route::get('/service-in-india-city', [FrontendController::class, 'servicesInIndiaCity'])->name('services-in-india');


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

    Route::resource('/submenu', SubMenuController::class);
    Route::post('/submenu-status', [SubMenuController::class, 'subMenuStatus'])->name('submenu.status');
    Route::post('/fetch-subcategory/{id}', [SubMenuController::class, 'fetchsubcategory']);
    Route::post('/getMenus/{subcategoryId}', [SubMenuController::class, 'getMenus']);
    Route::post('/fetch-city/{stateId}', [SubMenuController::class, 'fetchCity']);

    Route::resource('service-detail', ServiceDetailController::class);
    Route::resource('/enquiry', EnquiryController::class);
    Route::post('/enquiry-status', [EnquiryController::class, 'enquiryStatus'])->name('enquiry.status');

    Route::resource('/meta', MetaDescripConroller::class);
    Route::resource('/meta-url', MetaUrlController::class);
    Route::resource('/meta-title', MetaTitleController::class);


    Route::resource('/vendors', VendorController::class);

    Route::resource('/faq', FaqController::class);
    Route::post('/faq-status', [FaqController::class, 'faqStatus'])->name('faq.status');

    Route::resource('/india-services', IndiaServiceController::class);

});


require __DIR__ . '/auth.php';
