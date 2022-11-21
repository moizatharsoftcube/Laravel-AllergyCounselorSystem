<?php

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

Route::get('show-products',[\App\Http\Controllers\Api\ApiController::class,'show_products'])->name('show_products');
Route::get('show-single-product/{id}',[\App\Http\Controllers\Api\ApiController::class,'show_single_product'])->name('show_single_product');
Route::post('add-product',[\App\Http\Controllers\Api\ApiController::class,'add_product'])->name('add_product');
