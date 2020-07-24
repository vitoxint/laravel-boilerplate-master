<?php

use Illuminate\Http\Request;

use App\Http\Controllers\Backend\ProductoVentaController;
use App\Http\Controllers\Backend\OrdenTrabajoController;
use App\Http\Controllers\Frontend\ContactController;



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

Route::post('/api/contact/send',         [ContactController::class, 'sendApi']);

Route::get('/api/productos-venta/lista', [ProductoVentaController::class, 'getLista']);
Route::post('/api/productos-venta/lista_search', [ProductoVentaController::class, 'getListaSearch']);
Route::post('/api/productos-venta/lista_check',  [ProductoVentaController::class, 'getListaCheck']);


Route::group(['namespace' => 'ProductoVenta', 'prefix' => 'v1'], function () {
    
    //Route::get('productos-venta/lista', [ProductoVentaController::class, 'getLista']);
    Route::get('productos-venta/{producto}/show', [ProductoVentaController::class, 'show']);
/*     Route::get('productos-venta/create', [ProductoVentaController::class, 'create'])->name('productos-venta.create');
    Route::post('productos-venta', [ProductoVentaController::class, 'store'])->name('productos-venta.store');
    Route::get('productos-venta/dataAjax', [ProductoVentaController::class, 'dataAjax'])->name('productos-venta.dataAjax');

    Route::post('productos-ventas', [ProductoVentaController::class, 'opencode'])->name('productos-venta.opencode');

    Route::get('marca-select2', [ProductoVentaController::class, 'marcaSelect2'])->name('marcas.dataAjax');
    Route::get('familia-select2', [ProductoVentaController::class, 'familiaSelect2'])->name('familias.dataAjax'); */

/*     Route::group(['prefix' => 'productos-venta/{producto}'], function () {
        Route::get('edit', [ProductoVentaController::class, 'edit'])->name('productos-venta.edit');
        Route::patch('/', [ProductoVentaController::class, 'update'])->name('productos-venta.update');
        Route::delete('/', [ProductoVentaController::class, 'destroy'])->name('productos-venta.destroy');

        Route::get('print_etq', [ProductoVentaController::class, 'print_etq'])->name('productos-venta.print_etq');
    });


    Route::get('productos-venta/resultados', [ProductoVentaController::class, 'buscar_producto'])->name('productos-venta.buscar_producto'); */

    Auth::routes();
    
});

Route::group(['namespace' => 'OrdenTrabajo', 'prefix' => 'g1'], function () {

    //Route::get('/ordenTrabajo/getChartMonth', [OrdenTrabajoController::class, 'getOtsOfMonthGraph']);

    Auth::routes();
});




