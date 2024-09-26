<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(ApiController::class)->group(function () {
    Route::get('/subcategories', 'categoryList');
    Route::get('/submenus/{id}', 'subMenuList');
    Route::get('/menus/{id}', 'menuList');
    Route::get('/reviews', 'reviews');
    Route::get('/faqs', 'faqs');
    Route::post('/send-otp', 'sendOtp');
    Route::post('/verify-otp', 'verifyOtp');
    Route::post('/resend-otp', 'resendOtp');
});
