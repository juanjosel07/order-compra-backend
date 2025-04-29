<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'orders', 'controller' => OrderController::class], function () {

	Route::get('/', 'index');
	Route::get('/{order}', 'show')->middleware('validate.order');
	Route::post('/', 'store');
	Route::put('/{order}', 'update')->middleware('validate.order');
	Route::delete('/{order}', 'destroy')->middleware('validate.order');
});

Route::group(['prefix' =>'products', 'controller' => ProductoController::class], function () {
	Route::get('/', 'index');
});
