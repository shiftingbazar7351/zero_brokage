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
use App\Http\Controllers\MetaUrlController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Security\PermissionController;
use App\Http\Controllers\Security\RoleController;
use App\Http\Controllers\Security\RolePermission;
use App\Http\Controllers\ServiceDetailController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubMenuController;
use App\Http\Controllers\TransactionController;

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
        Route::post('/user-status', 'userStatus')->name('user.status')->middleware('can:user-status');

    });
    // Permission Module
    Route::get('/role-permission', [RolePermission::class, 'index'])->name('role.permission.list')->middleware('can:role-list');
    Route::post('/store/role-permission', [RolePermission::class, 'store'])->name('role.permission.store')->middleware('can:role-list');
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);
    // Dashboard Routes

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('categories.index')->middleware('can:categories-list'); // List all categories
        Route::get('/categories/create', 'create')->name('categories.create')->middleware('can:categories-create'); // Show form to create a category
        Route::post('/categories', 'store')->name('categories.store')->middleware('can:categories-create'); // Store a new category
        Route::get('/categories/{category}/edit', 'edit')->name('categories.edit')->middleware('can:categories-edit'); // Edit category form
        Route::put('/categories/{category}', 'update')->name('categories.update')->middleware('can:categories-edit'); // Update the category
        Route::get('/categories/{category}', 'show')->name('categories.show')->middleware('can:categories-show'); // Show a single category (corrected to GET)
        Route::delete('/categories/{category}', 'destroy')->name('categories.destroy')->middleware('can:categories-delete'); // Delete a category
        Route::post('/category-status', 'categoryStatus')->name('categories.status')->middleware('can:categories-status'); // Change category status
    });


    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/subcategories', 'index')->name('subcategories.index')->middleware('can:subcategory-list');
        Route::get('/subcategories/create', 'create')->name('subcategories.create')->middleware('can:subcategory-create');
        Route::post('/subcategories', 'store')->name('subcategories.store')->middleware('can:subcategory-create');
        Route::get('/subcategories/{subcategory}/edit', 'edit')->name('subcategories.edit')->middleware('can:subcategory-edit');
        Route::patch('/subcategories/update/{subcategory}', 'update')->name('subcategories.update')->middleware('can:subcategory-edit');
        Route::post('/subcategories/{subcategory}', 'show')->name('subcategories.show')->middleware('can:subcategory-show');
        Route::delete('/subcategories/{subcategory}', 'destroy')->name('subcategories.destroy')->middleware('can:subcategory-delete');
        Route::post('/sub-category-status', 'subCategoryStatus')->name('subcategories.status')->middleware('can:subcategory-status');
    });

    Route::controller(MenuController::class)->group(function () {
        Route::get('/menus', 'index')->name('menus.index')->middleware('can:menus-list');
        Route::get('/menus/create', 'create')->name('menus.create')->middleware('can:menus-create');
        Route::post('/menus', 'store')->name('menus.store')->middleware('can:menus-create');
        Route::get('/menus/{menu}/edit', 'edit')->name('menus.edit')->middleware('can:menus-edit');
        Route::patch('/menus/update/{menu}', 'update')->name('menus.update')->middleware('can:menus-edit');
        Route::post('/menus/{menu}', 'show')->name('menus.show')->middleware('can:menus-show');
        Route::delete('/menus/{menu}', 'destroy')->name('menus.destroy')->middleware('can:menus-delete');
        Route::post('/menu-status', 'menuStatus')->name('menu.status')->middleware('can:menus-status');
    });

    Route::controller(SubMenuController::class)->group(function () {
        Route::get('/submenu', 'index')->name('submenu.index')->middleware('can:submenu-list');
        Route::get('/submenu/create', 'create')->name('submenu.create')->middleware('can:submenu-create');
        Route::post('/submenu', 'store')->name('submenu.store')->middleware('can:submenu-create');
        Route::get('/submenu/{submenu}/edit', 'edit')->name('submenu.edit')->middleware('can:submenu-edit');
        Route::patch('/submenu/update/{submenu}', 'update')->name('submenu.update')->middleware('can:submenu-edit');
        Route::post('/submenu/{submenu}', 'show')->name('submenu.show')->middleware('can:submenu-show');
        Route::delete('/submenu/{submenu}', 'destroy')->name('submenu.destroy')->middleware('can:submenu-delete');
        Route::post('/submenu-status', 'subMenuStatus')->name('submenu.status')->middleware('can:submenu-status');
        Route::post('/fetch-subcategory/{id}', 'fetchsubcategory');
        Route::post('/getMenus/{subcatId}', 'getMenus');
    });

    Route::controller(controller: EnquiryController::class)->group(function () {
        Route::get('/enquiry', 'index')->name('enquiry.index')->middleware('can:enquiry-list');
        Route::get('/enquiry/create', 'create')->name('enquiry.create')->middleware('can:enquiry-create');
        Route::post('/enquiry', 'store')->name('enquiry.store')->middleware('can:enquiry-create');
        Route::get('/enquiry/{enquiry}/edit', 'edit')->name('enquiry.edit')->middleware('can:enquiry-edit');
        Route::patch('/enquiry/update/{enquiry}', 'update')->name('enquiry.update')->middleware('can:enquiry-edit');
        Route::post('/enquiry/{enquiry}', 'show')->name('enquiry.show')->middleware('can:enquiry-show');
        Route::delete('/enquiry/{enquiry}', 'destroy')->name('enquiry.destroy')->middleware('can:enquiry-delete');
        Route::post('/enquiry-status', 'enquiryStatus')->name('enquiry.status')->middleware('can:enquiry-status');
        Route::get('/get-menus/{subcategoryId}', 'fetchMenu');
    });

    Route::controller(ServiceDetailController::class)->group(function () {
        Route::get('/service-detail', 'index')->name('service-detail.index')->middleware('can:service-detail-list');
        Route::get('/service-detail/create', 'create')->name('service-detail.create')->middleware('can:service-detail-create');
        Route::post('/service-detail', 'store')->name('service-detail.store')->middleware('can:service-detail-create');
        Route::get('/service-detail/{service-detail}/edit', 'edit')->name('service-detail.edit')->middleware('can:service-detail-edit');
        Route::patch('/service-detail/update/{service-detail}', 'update')->name('service-detail.update')->middleware('can:service-detail-edit');
        Route::post('/service-detail/{service-detail}', 'show')->name('service-detail.show')->middleware('can:service-detail-show');
        Route::delete('/service-detail/{service-detail}', 'destroy')->name('service-detail.destroy')->middleware('can:service-detail-delete');
    });

    Route::controller(MetaUrlController::class)->group(function () {
        Route::get('/meta', 'index')->name('meta.index')->middleware('can:meta-list');
        Route::get('/meta/create', 'create')->name('meta.create')->middleware('can:meta-create');
        Route::post('/meta', 'store')->name('meta.store')->middleware('can:meta-create');
        Route::get('/meta/{meta}/edit', 'edit')->name('meta.edit')->middleware('can:meta-edit');
        Route::patch('/meta/update/{meta}', 'update')->name('meta.update')->middleware('can:meta-edit');
        Route::post('/meta/{meta}', 'show')->name('meta.show')->middleware('can:meta-show');
        Route::delete('/meta/{meta}', 'destroy')->name('meta.destroy')->middleware('can:meta-delete');
    });
    Route::controller(VerifiedController::class)->group(function () {
        Route::get('/verified', 'index')->name('verified.index')->middleware('can:verified-list');
        Route::get('/verified/create', 'create')->name('verified.create')->middleware('can:verified-create');
        Route::post('/verified', 'store')->name('verified.store')->middleware('can:verified-create');
        Route::get('/verified/{verified}/edit', 'edit')->name('verified.edit')->middleware('can:verified-edit');
        Route::patch('/verified/update/{verified}', 'update')->name('verified.update')->middleware('can:verified-edit');
        Route::post('/verified/{verified}', 'show')->name('verified.show')->middleware('can:verified-show');
        Route::delete('/verified/{verified}', 'destroy')->name('verified.destroy')->middleware('can:verified-delete');
        Route::post('/verified-status', 'verifyStatus')->name('verified.status')->middleware('can:verified-status');
    });

    Route::controller(VendorController::class)->group(function () {
        Route::get('/vendors', 'index')->name('vendors.index')->middleware('can:vendors-list');
        Route::get('/vendors/create', 'create')->name('vendors.create')->middleware('can:vendors-create');
        Route::post('/vendors', 'store')->name('vendors.store')->middleware('can:vendors-create');
        Route::get('/vendors/{vendors}/edit', 'edit')->name('vendors.edit')->middleware('can:vendors-edit');
        Route::patch('/vendors/update/{vendors}', 'update')->name('vendors.update')->middleware('can:vendors-edit');
        Route::post('/vendors/{vendors}', 'show')->name('vendors.show')->middleware('can:vendors-show');
        Route::delete('/vendors/{vendors}', 'destroy')->name('vendors.destroy')->middleware('can:vendors-delete');
        Route::post('/vendors-status', 'verifyStatus')->name('vendors.status')->middleware('can:vendors-status');
        Route::post('/fetch-city-vendor/{stateId}', 'fetchCity');
        Route::post('/product-fetch-subcategory', 'fetchSubcategory')->name('fetch.subcategory');
        Route::post('/product-fetch-menu', 'fetchMenu')->name('fetch.menu');
        Route::post('/product-fetch-submenu', 'fetchSubmenu')->name('fetch.submenu');
        Route::post('/getsubMenus/{menuId}', 'getsubMenus');
        Route::post('/vendor-send-otp', 'sendOtp')->name('vendor.send.otp');
        Route::post('/vendor-verify-otp', 'verifyOtp')->name('vendor.verify.otp');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('products.index')->middleware('can:products-list');
        Route::get('/products/create', 'create')->name('products.create')->middleware('can:products-create');
        Route::post('/products', 'store')->name('products.store')->middleware('can:products-create');
        Route::get('/products/{products}/edit', 'edit')->name('products.edit')->middleware('can:products-edit');
        Route::patch('/products/update/{products}', 'update')->name('products.update')->middleware('can:products-edit');
        Route::post('/products/{products}', 'show')->name('products.show')->middleware('can:products-show');
        Route::delete('/products/{products}', 'destroy')->name('products.destroy')->middleware('can:products-delete');
    });

    Route::controller(IpAddressController::class)->group(function () {
        Route::get('/ipaddress', 'index')->name('ipaddress.index')->middleware('can:ipaddress-list');
        Route::get('/ipaddress/create', 'create')->name('ipaddress.create')->middleware('can:ipaddress-create');
        Route::post('/ipaddress', 'store')->name('ipaddress.store')->middleware('can:ipaddress-create');
        Route::get('/ipaddress/{ipaddress}/edit', 'edit')->name('ipaddress.edit')->middleware('can:ipaddress-edit');
        Route::patch('/ipaddress/update/{ipaddress}', 'update')->name('ipaddress.update')->middleware('can:ipaddress-edit');
        Route::post('/ipaddress/{ipaddress}', 'show')->name('ipaddress.show')->middleware('can:ipaddress-show');
        Route::delete('/ipaddress/{ipaddress}', 'destroy')->name('ipaddress.destroy')->middleware('can:ipaddress-delete');
        Route::post('/ipaddress-status', 'ipaddressStatus')->name('ipaddress.status')->middleware('can:ipaddress-status');
    });

    Route::controller(ReviewController::class)->group(function () {
        Route::get('/reviews', 'index')->name('reviews.index')->middleware('can:reviews-list');
        Route::get('/reviews/create', 'create')->name('reviews.create')->middleware('can:reviews-create');
        Route::post('/reviews', 'store')->name('reviews.store')->middleware('can:reviews-create');
        Route::get('/reviews/{reviews}/edit', 'edit')->name('reviews.edit')->middleware('can:reviews-edit');
        Route::patch('/reviews/update/{reviews}', 'update')->name('reviews.update')->middleware('can:reviews-edit');
        Route::post('/reviews/{reviews}', 'show')->name('reviews.show')->middleware('can:reviews-show');
        Route::delete('/reviews/{reviews}', 'destroy')->name('reviews.destroy')->middleware('can:reviews-delete');
    });

    Route::controller(FaqController::class)->group(function () {
        Route::get('/faq', 'index')->name('faq.index')->middleware('can:faq-list');
        Route::get('/faq/create', 'create')->name('faq.create')->middleware('can:faq-create');
        Route::post('/faq', 'store')->name('faq.store')->middleware('can:faq-create');
        Route::get('/faq/{faq}/edit', 'edit')->name('faq.edit')->middleware('can:faq-edit');
        Route::patch('/faq/update/{faq}', 'update')->name('faq.update')->middleware('can:faq-edit');
        Route::post('/faq/{faq}', 'show')->name('faq.show')->middleware('can:faq-show');
        Route::delete('/faq/{faq}', 'destroy')->name('faq.destroy')->middleware('can:faq-delete');
        Route::post('/faq-status', 'faqStatus')->name('faq.status')->middleware('can:faq-status');
    });

    Route::controller(IndiaServiceController::class)->group(function () {
        Route::get('/india-services', 'index')->name('india-services.index')->middleware('can:india-services-list');
        Route::get('/india-services/create', 'create')->name('india-services.create')->middleware('can:india-services-create');
        Route::post('/india-services', 'store')->name('india-services.store')->middleware('can:india-services-create');
        Route::get('/india-services/{india-services}/edit', 'edit')->name('india-services.edit')->middleware('can:india-services-edit');
        Route::patch('/india-services/update/{india-services}', 'update')->name('india-services.update')->middleware('can:india-services-edit');
        Route::post('/india-services/{india-services}', 'show')->name('india-services.show')->middleware('can:india-services-show');
        Route::delete('/india-services/{india-services}', 'destroy')->name('india-services.destroy')->middleware('can:india-services-delete');
    });

    Route::resource('/newsletter', NewsletterController::class);
    Route::controller(TransactionController::class)->group(function () {
        Route::get('/transaction', 'index')->name('transaction.index')->middleware('can:transaction-list');
        Route::get('/transaction/create', 'create')->name('transaction.create')->middleware('can:transaction-create');
        Route::post('/transaction', 'store')->name('transaction.store')->middleware('can:transaction-create');
        Route::get('/transaction/{transaction}/edit', 'edit')->name('transaction.edit')->middleware('can:transaction-edit');
        Route::patch('/transaction/update/{transaction}', 'update')->name('transaction.update')->middleware('can:transaction-edit');
        Route::post('/transaction/{transaction}', 'show')->name('transaction.show')->middleware('can:transaction-show');
        Route::delete('/transaction/{transaction}', 'destroy')->name('transaction.destroy')->middleware('can:transaction-delete');
        Route::post('/transaction-status', 'transactionStatus')->name('transaction.status')->middleware('can:transaction-status');
        Route::post('/transaction/approve/{id}', 'approve')->name('transaction.approve')->middleware('can:transaction-approvals');
        Route::post('/transaction/reject/{id}', 'reject')->name('transaction.reject')->middleware('can:transaction-approvals');
        Route::get('/transactions', 'getTransactionDetails')->name('transactions.details');
    });

    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/invoice', 'index')->name('invoice.index')->middleware('can:invoice-list');
        Route::get('/invoice/create', 'create')->name('invoice.create')->middleware('can:invoice-create');
        Route::post('/invoice', 'store')->name('invoice.store')->middleware('can:invoice-create');
        Route::get('/invoice/{invoice}/edit', 'edit')->name('invoice.edit')->middleware('can:invoice-edit');
        Route::patch('/invoice/update/{invoice}', 'update')->name('invoice.update')->middleware('can:invoice-edit');
        Route::post('/invoice/{invoice}', 'show')->name('invoice.show')->middleware('can:invoice-show');
        Route::delete('/invoice/{invoice}', 'destroy')->name('invoice.destroy')->middleware('can:invoice-delete');
        Route::get('/generate-pdf', 'generatePDF')->name('generate.pdf');
        Route::post('/invoice/data/store/{id}', 'dataStore')->name('invoice.data.store')->middleware('can:invoice-create');
    });

    Route::get('/dashboard', [AdminController::class, 'homepage'])->name('admin_page');
    // Route::resource('categories', CategoryController::class);
    // Route::post('/category-status', [CategoryController::class, 'categoryStatus'])->name('categories.status');

    // Route::resource('subcategories', SubCategoryController::class);
    // Route::post('/sub-category-status', [SubCategoryController::class, 'subCategoryStatus'])->name('subcategories.status');

    // Route::resource('/menus', MenuController::class);
    // Route::post('/menu-status', [MenuController::class, 'menuStatus'])->name('menu.status');

    // Resource route for submenu
    // Route::resource('/submenu', SubMenuController::class);

    // Grouping the additional routes related to submenu
    // Route::controller(SubMenuController::class)->group(function () {
    //     Route::post('/submenu-status', 'subMenuStatus')->name('submenu.status');
    //     Route::post('/fetch-subcategory/{id}', 'fetchsubcategory');
    //     Route::post('/getMenus/{subcatId}', 'getMenus');
    //     Route::post('/reviews-status', 'subMenuStatus')->name('reviews.status');
    // });



    // Route::resource('service-detail', ServiceDetailController::class);

    // Route::resource('/enquiry', EnquiryController::class);
    // Route::controller(EnquiryController::class)->group(function () {
        // Route::post('/enquiry-status', 'enquiryStatus')->name('enquiry.status');
        // Route::get('/get-menus/{subcategoryId}', 'fetchMenu');
        // Route::get('/reporting-data', 'reportData')->name('report.index');
    // });


    // Route::resource('/meta', MetaUrlController::class);

    // Route::resource('/verified', VerifiedController::class);
    // Route::post('/verified-status', [VerifiedController::class, 'verifyStatus'])->name('verified.status');
    // Route::resource('/vendors', VendorController::class);
    // Route::controller(VendorController::class)->group(function () {
    //     Route::post('/fetch-city-vendor/{stateId}', 'fetchCity');
    //     Route::post('/product-fetch-subcategory', 'fetchSubcategory')->name('fetch.subcategory');
    //     Route::post('/product-fetch-menu', 'fetchMenu')->name('fetch.menu');
    //     Route::post('/product-fetch-submenu', 'fetchSubmenu')->name('fetch.submenu');
    //     Route::post('/getsubMenus/{menuId}', 'getsubMenus');
    //     Route::post('/vendor-send-otp', 'sendOtp')->name('vendor.send.otp');
    //     Route::post('/vendor-verify-otp', 'verifyOtp')->name('vendor.verify.otp');
    // });

    // Route::resource('/products', ProductController::class);
    // Route::resource('/ipaddress', IpAddressController::class);
    // Route::post('/ipaddress-status', [IpAddressController::class, 'ipaddressStatus'])->name('ipaddress.status');

    // Route::resource('/reviews', ReviewController::class);
    // Route::resource('/faq', FaqController::class);
    // Route::post('/faq-status', [FaqController::class, 'faqStatus'])->name('faq.status');
    // Route::resource('/india-services', IndiaServiceController::class);
    // Route::resource('/newsletter', NewsletterController::class);
    // Route::resource('/transaction', TransactionController::class);
    // Route::post('/transaction-status', [TransactionController::class, 'transactionStatus'])->name('transaction.status');
    // Route::post('/transaction/approve/{id}', [TransactionController::class, 'approve'])->name('transaction.approve');
    // Route::post('/transaction/reject/{id}', [TransactionController::class, 'reject'])->name('transaction.reject');

    // Route::resource('/invoice', InvoiceController::class);
    // Route::post('invoice/{id}/edit', [InvoiceController::class, 'update'])->name('invoice.edit');
    // Route::get('/transactions', [TransactionController::class, 'getTransactionDetails'])->name('transactions.details');
    // Route::get('/generate-pdf', [InvoiceController::class, 'generatePDF'])->name('generate.pdf');
    // Route::post('/invoice/data/store/{id}', [InvoiceController::class, 'dataStore'])->name('invoice.data.store');

});

require __DIR__ . '/auth.php';
