<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\IndiaServiceController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\IpAddressController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MetaDescripConroller;
use App\Http\Controllers\MetaTitleController;
use App\Http\Controllers\MetaUrlController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceDetailController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubMenuController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VerifiedController;

use Modules\Employee\Http\Controllers\CompanyController;
use Modules\Employee\Http\Controllers\EmployeeProductController;
use Modules\Employee\Http\Controllers\HeadOfficeController;

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

Route::get('/pricing-details', function () {
    return view('frontend.pricing');
})->name('pricing');

Route::get('/term-condition', function () {
    return view('frontend.term-and-condition');
})->name('term-condition');


Route::get('/pricing', function () {
    return view('frontend.pricing');
})->name('pricing');

Route::get('/privacy-policy', function () {
    return view('frontend.privacy-policy');
})->name('privacy-policy');

Route::get('/reciept', function () {
    return view('frontend.reciept');
})->name('reciept');

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
    Route::get('/filter-submenus/{slug}', 'filterSubmenus')->name('filter.submenu');
    Route::post('/enquiry-verify-otp', 'verifyOtp')->name('enquiry.verify.otp');
    Route::get('/fetch-city-data', 'fetchDataOfProvider')->name('fetchDataOfProvider');

});

Route::post('/fetch-city/{stateId}', [SubMenuController::class, 'fetchCity']);

Route::post('/get-otp', [OtpController::class, 'getOtp'])->name('getOtp');
Route::post('/verify-otp', [OtpController::class, 'verifyOtp'])->name('verifyOtp');

Route::middleware(['auth', 'check.ip'])->group(function () {
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

    // Resource route for submenu
    Route::resource('/submenu', SubMenuController::class);

    // Grouping the additional routes related to submenu
    Route::controller(SubMenuController::class)->group(function () {
        Route::post('/submenu-status', 'subMenuStatus')->name('submenu.status');
        Route::post('/fetch-subcategory/{id}', 'fetchsubcategory');
        Route::post('/getMenus/{subcatId}', 'getMenus');
        Route::post('/reviews-status', 'subMenuStatus')->name('reviews.status');
    });



    Route::resource('service-detail', ServiceDetailController::class);

    Route::resource('/enquiry', EnquiryController::class);
    Route::controller(EnquiryController::class)->group(function () {
        Route::post('/enquiry-status', 'enquiryStatus')->name('enquiry.status');
        Route::get('/get-menus/{subcategoryId}', 'fetchMenu');
        Route::get('/reporting-data', 'reportData')->name('report.index');
    });


    Route::resource('/meta', MetaUrlController::class);

    Route::resource('/verified', VerifiedController::class);
    Route::post('/verified-status', [VerifiedController::class, 'verifyStatus'])->name('verified.status');
    Route::resource('/vendors', VendorController::class);
    Route::controller(VendorController::class)->group(function () {
        Route::post('/fetch-city-vendor/{stateId}', 'fetchCity');
        Route::post('/product-fetch-subcategory', 'fetchSubcategory')->name('fetch.subcategory');
        Route::post('/product-fetch-menu', 'fetchMenu')->name('fetch.menu');
        Route::post('/product-fetch-submenu', 'fetchSubmenu')->name('fetch.submenu');
        Route::post('/getsubMenus/{menuId}', 'getsubMenus');
        Route::post('/vendor-send-otp', 'sendOtp')->name('vendor.send.otp');
        Route::post('/vendor-verify-otp', 'verifyOtp')->name('vendor.verify.otp');
    });

    Route::resource('/products', ProductController::class);
    Route::resource('/ipaddress', IpAddressController::class);
    Route::post('/ipaddress-status', [IpAddressController::class, 'ipaddressStatus'])->name('ipaddress.status');

    Route::resource('/reviews', ReviewController::class);
    Route::resource('/faq', FaqController::class);
    Route::post('/faq-status', [FaqController::class, 'faqStatus'])->name('faq.status');
    Route::resource('/india-services', IndiaServiceController::class);
    Route::resource('/newsletter', NewsletterController::class);
    Route::resource('/transaction', TransactionController::class);
    Route::post('/transaction-status', [TransactionController::class, 'transactionStatus'])->name('transaction.status');
    Route::post('/transaction/approve/{id}', [TransactionController::class, 'approve'])->name('transaction.approve');
    Route::post('/transaction/reject/{id}', [TransactionController::class, 'reject'])->name('transaction.reject');

    Route::resource('/invoice', InvoiceController::class);
    Route::post('invoice/{id}/edit', [InvoiceController::class, 'update'])->name('invoice.edit');
    Route::get('/transactions', [TransactionController::class, 'getTransactionDetails'])->name('transactions.details');
    Route::get('/generate-pdf', [InvoiceController::class, 'generatePDF'])->name('generate.pdf');
    Route::post('/invoice/data/store/{id}', [InvoiceController::class, 'dataStore'])->name('invoice.data.store');

    Route::resource('/employee-company', CompanyController::class);
    Route::resource('/employee-product', EmployeeProductController::class);
    Route::resource('/employee-headoffice', HeadOfficeController::class);
});

require __DIR__ . '/auth.php';
