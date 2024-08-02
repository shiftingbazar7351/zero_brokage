<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SubmenuController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\UserController;


Route::resource('categories', CategoryController::class);
Route::get('/categories-details', [CategoryController::class, 'service_details'])->name('details');
####-----------------------------------------CategoryController--------------------------  ---------###
Route::resource('subcategories', SubCategoryController::class);
Route::post('/fetch-subcategory/{id}', [SubCategoryController::class, 'fetchsubcategory']);
Route::post('/fetch-menus/{id}', [SubCategoryController::class, 'fetchmenu']);

####-----------------------------------------SubmenuController-------------------------------- -----###
Route::post('/services-submenu', [SubmenuController::class, 'store'])->name('submenu.store');

####-----------------------------------------UserController--------------------------------  -------###
Route::get('/', [UserController::class, 'homepage'])->name('services');
Route::get('/services_subcategory', [UserController::class, 'sub_category'])->name('subcategory');
// Route::get('/categories-demo', [UserController::class, 'category_demo']);
Route::get('/services_menu', [UserController::class, 'menu'])->name('menu');
Route::get('/services_submenu', [UserController::class, 'submenu'])->name('submenu');

####-----------------------------------------MenuController---------------------------------- ------###
// Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
// Route::get('menus/{id}/edit', [MenuController::class, 'edit'])->name('menus.edit');
// Route::put('menus/{id}', [MenuController::class, 'update'])->name('menus.update');
// Route::delete('menus/{id}', [MenuController::class, 'destroy'])->name('menus.destroy');
// Route::post('/services-menu', [MenuController::class, 'store'])->name('menu.store');

Route::resource('menu', CategoryController::class);
Route::patch('/categories/{id}/update-status', [CategoryController::class, 'updateStatus'])->name('categories.updateStatus');

####-----------------------------------------FooterController----------------------------------------###
Route::get('/footer-about-us', [FooterController::class, 'about_us'])->name('about');
Route::get('/footer-blog', [FooterController::class, 'blog'])->name('blog');
Route::get('/footer-contact', [FooterController::class, 'contact'])->name('contact');

####-----------------------------------------AdminController------------------------------------    ---###
Route::get('/admin-homepage', [AdminController::class, 'homepage'])->name('admin_page');




// Route::get('/admin', function () {
//     return view('admin');
// });
