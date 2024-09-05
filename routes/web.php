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
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceDetailController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubMenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VerifiedController;
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

// Route::get('/vender-profile', function () {
//     return view('frontend.vender-profile');
// })->name('vender-profile');

// Route::get('/services', function () {
//     return view('frontend.service-detail');
// })->name('services');

Route::get('/create-vendor', function () {
    return view('frontend.create-vendor');
})->name('create-vendor');

Route::get('/pricing', function () {
    return view('frontend.pricing');
})->name('pricing');

Route::get('/privacy-policy', function () {
    return view('frontend.privacy-policy');
})->name('privacy-policy');

Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/service-list', 'serviceList')->name('service-list');
    Route::get('/services-in-{city}', 'servicesInIndia')->name('services-in-india');
    Route::get('/service-details', 'serviceDetails')->name('service-details');
    Route::get('/service-grid/{slug}', 'subCategory')->name('service.grid');
    Route::post('/user/enquiry/store', 'enquiryStore')->name('enquirystore');
    Route::post('/user/enquiry/update', 'enquiryUpdate')->name('enquiryupdate');
    Route::get('{slug}-in-india', 'servicesInIndiaCity')->name('services-in-india-city');
    Route::get('/provider-details/{id}', 'providerDetails')->name('vender-profile');
    Route::post('/user/review/store', 'reviewStore')->name('reviewstore');
    Route::get('/get-menus/{subcategory_id}', 'getMenus')->name('get.menus');
    Route::get('/search-filter', 'search')->name('search.filter');
    Route::get('/filter-submenus', 'filterSubmenus')->name('your.search.route');
    // Route::post('/verify-otp', 'verifyOtp')->name('send.verify.otp');
});

Route::post('/fetch-city/{stateId}', [SubMenuController::class, 'fetchCity']);



Route::post('/get-otp', [OtpController::class, 'getOtp'])->name('getOtp');
// Route::post('/verify-otp', [OtpController::class, 'verifyOtp'])->name('verifyOtp');



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

    Route::resource('service-detail', ServiceDetailController::class);
    Route::resource('/enquiry', EnquiryController::class);
    Route::post('/enquiry-status', [EnquiryController::class, 'enquiryStatus'])->name('enquiry.status');
    Route::get('/get-menus/{subcategoryId}', [EnquiryController::class, 'fetchMenu']);


    Route::resource('/meta', MetaUrlController::class);

    Route::resource('/verified', VerifiedController::class);
    Route::post('/verified-status', [VerifiedController::class, 'verifyStatus'])->name('verified.status');
    Route::resource('/vendors', VendorController::class);
    Route::controller(VendorController::class)->group(function () {
        Route::post('/fetch-city-vendor/{stateId}', 'fetchCity');
        Route::post('/fetch-subcategory/{id}', 'fetchsubcategory');
        Route::post('/getMenus/{subcategoryId}', 'getMenus');
        Route::post('/getsubMenus/{menuId}', 'getsubMenus');
        Route::post('/vendor-send-otp', 'sendOtp')->name('vendor.send.otp');
        Route::post('/vendor-verify-otp', 'verifyOtp')->name('vendor.verify.otp');


    });
    Route::resource('/reviews', ReviewController::class);
    Route::post('/reviews-status', [SubMenuController::class, 'subMenuStatus'])->name('reviews.status');
    Route::resource('/faq', FaqController::class);
    Route::post('/faq-status', [FaqController::class, 'faqStatus'])->name('faq.status');
    Route::resource('/india-services', IndiaServiceController::class);
    Route::resource('/newsletter', NewsletterController::class);

    Route::get('/fetch-city-data', [FrontendController::class, 'fetchDataOfProvider'])->name('fetchDataOfProvider');
});


require __DIR__ . '/auth.php';
