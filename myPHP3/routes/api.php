<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiTinController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API cho Tin tức
Route::get('/tin-theo-loai/{idLT}', [ApiTinController::class, 'tin_theo_loai']);
Route::get('/chi-tiet-tin/{id}', [ApiTinController::class, 'chi_tiet_tin']);

// API cho Sản phẩm và Loại sản phẩm (Lab 8)
Route::apiResource('products', ProductController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('loaisanpham', CategoryController::class);
