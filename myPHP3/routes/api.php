<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiTinController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API cho Tin tức
Route::get('/tin-theo-loai/{idLT}', [ApiTinController::class, 'tin_theo_loai']);
Route::get('/chi-tiet-tin/{id}', [ApiTinController::class, 'chi_tiet_tin']);
