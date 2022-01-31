<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Brands\brands_controller;
use App\Http\Controllers\Products\products_controller;
use App\Http\Controllers\Messages\messages_controller;
use App\Http\Controllers\Settings\settings_controller;
use App\Http\Controllers\Render\render_controller;
use App\Http\Controllers\socialmedia\socialmedia_controller;

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

Route::middleware('api')->post('/login',[AuthController::class,'login']);
Route::middleware(['api','auth:sanctum'])->get('/logout',[AuthController::class,'logout']);
Route::middleware(['api','auth:sanctum'])->post('/update-account',[AuthController::class,'update_account']);

Route::middleware(['api','auth:sanctum'])->get('/get-brands',[brands_controller::class,'get_brands']);
Route::middleware(['api','auth:sanctum'])->get('/get-products',[products_controller::class,'get_products']);
Route::middleware(['api','auth:sanctum'])->get('/get-messages',[messages_controller::class,'get_messages']);
Route::middleware(['api','auth:sanctum'])->post('/send-message',[messages_controller::class,'send_message']);
Route::middleware(['api','auth:sanctum'])->get('/get-settings',[settings_controller::class,'get_settings']);
Route::middleware(['api','auth:sanctum'])->post('/save-settings',[settings_controller::class,'save_settings']);
Route::middleware(['api','auth:sanctum'])->post('/add-brand',[brands_controller::class,'add_brand']);
Route::middleware(['api','auth:sanctum'])->post('/edit-brand',[brands_controller::class,'edit_brand']);
Route::middleware(['api','auth:sanctum'])->post('/delete-brand',[brands_controller::class,'delete_brand']);
Route::middleware(['api','auth:sanctum'])->post('/add-product',[products_controller::class,'add_product']);
Route::middleware(['api','auth:sanctum'])->post('/edit-product',[products_controller::class,'edit_product']);
Route::middleware(['api','auth:sanctum'])->post('/delete-product',[products_controller::class,'delete_product']);
Route::middleware(['api','auth:sanctum'])->get('/get-socials',[socialmedia_controller::class,'get_socials']);
Route::middleware(['api','auth:sanctum'])->post('/add-social',[socialmedia_controller::class,'add_social']);
Route::middleware(['api','auth:sanctum'])->post('/edit-social',[socialmedia_controller::class,'edit_social']);
Route::middleware(['api','auth:sanctum'])->post('/delete-social',[socialmedia_controller::class,'delete_social']);

Route::middleware('api')->post('/visitor/view-product',[products_controller::class,'view_product']);
Route::middleware(['api'])->get('/visitor/get-products',[products_controller::class,'get_products']);
Route::middleware(['api','auth:sanctum'])->post('/delete-message',[messages_controller::class,'delete_message']);




//////////////////////////////////////SITE/////////////////////////////////////////////////////
Route::middleware(['api'])->get('/render',[render_controller::class,'render']);
