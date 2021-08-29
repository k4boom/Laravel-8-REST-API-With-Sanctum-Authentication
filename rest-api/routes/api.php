<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AuthController;
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
//This one looks more clear to understand where exactly we are reaching out
//Route::get('/products','App\Http\Controllers\ProductsController@index');

//This one looks more aesthetic 
//Route::post('/products',[ProductsController::class,'store']);

//But we dont need them

//PUBLIC ROUTES

Route::post('/login',[AuthController::class,'login']);

Route::post('/register',[AuthController::class,'register']);

Route::get('/products','App\Http\Controllers\ProductsController@index');

Route::get('/products/{id}','App\Http\Controllers\ProductsController@show');

Route::get('/products/search/{name}',[ProductsController::class,'search']);

//Route::resource('products',ProductsController::class);


//PROTECTED ROUTES

Route::group(['middleware' => ['auth:sanctum'] ], function () {
    Route::post('/products',[ProductsController::class,'store']);
    Route::put('/products/{id}',[ProductsController::class,'update']);
    Route::delete('/products/{id}',[ProductsController::class,'destroy']);
    
    Route::post('/logout',[AuthController::class,'logout']);
});
