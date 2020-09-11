<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;

Route::get('/api/productos-venta/lista', [ProductController::class, 'getLista']);

Route::post('/api/productos-venta/categoria', [ProductController::class, 'getListaCategoria']);

Route::post('/api/productos-venta/buscar', [ProductController::class, 'getListaSearch']);


