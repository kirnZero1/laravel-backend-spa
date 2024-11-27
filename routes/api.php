<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/user/register',[UserController::class, 'register']);
Route::post('/user/login',[UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/products',[ProductController::class, 'index']);
    Route::get('/products/{id}',[ProductController::class, 'show']);
    Route::post('/products/store',[ProductController::class, 'store']);
    Route::put('/products/update/{id}',[ProductController::class, 'update']);
    Route::post('/products/destroy/{id}',[ProductController::class, 'destroy']);
    Route::get('/products/search/{name}',[ProductController::class, 'destroy']);

    Route::post('/user/logout',[UserController::class, 'destroy']);
});

