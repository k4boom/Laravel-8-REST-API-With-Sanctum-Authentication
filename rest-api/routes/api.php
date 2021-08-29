<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\ProductsController;
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

Route::resource('products',ProductsController::class);


Route::get('/products/search/{name}',[ProductsController::class,'search']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
