<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ClienteController;
use App\Http\Controllers\Backend\ClienteRepresentanteController;
use App\Http\Controllers\Backend\OrdenTrabajoController;
use App\Http\Controllers\Backend\ItemOtController;
use App\Http\Controllers\Backend\ImagenItemOtController;


// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::group(['namespace' => 'Cliente'], function () {
    
    Route::get('clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
    Route::get('clientes/dataAjax', [ClienteController::class, 'dataAjax'])->name('clientes.dataAjax');
    Route::post('clientes', [ClienteController::class, 'store'])->name('clientes.store');

    Route::group(['prefix' => 'clientes/{cliente}'], function () {
        Route::get('edit', [ClienteController::class, 'edit'])->name('clientes.edit');
        Route::patch('/', [ClienteController::class, 'update'])->name('clientes.update');
        Route::delete('/', [ClienteController::class, 'destroy'])->name('clientes.destroy');
    });

    Route::get('clientes/resultados', [ClienteController::class, 'buscar_clientes'])->name('clientes.buscar_clientes');
});  


Route::group(['namespace' => 'ContactoCliente'], function () {
    
    Route::get('contacto_clientes', [ClienteRepresentanteController::class, 'index'])->name('contacto_clientes.index');
    Route::get('contacto_clientes/{cliente}/create', [ClienteRepresentanteController::class, 'create'])->name('contacto_clientes.create');
    Route::post('contacto_clientes/{cliente}', [ClienteRepresentanteController::class, 'store'])->name('contacto_clientes.store');

    Route::group(['prefix' => 'contacto_clientes/{contacto}/{cliente}'], function () {
        Route::get('edit', [ClienteRepresentanteController::class, 'edit'])->name('contacto_clientes.edit');
        Route::patch('/', [ClienteRepresentanteController::class, 'update'])->name('contacto_clientes.update');
        Route::delete('/', [ClienteRepresentanteController::class, 'destroy'])->name('contacto_clientes.destroy');
    });

    Route::get('contacto_clientes/resultados', [ClienteRepresentanteController::class, 'buscar_clientes'])->name('contacto_clientes.buscar_contactos');
}); 


Route::group(['namespace' => 'OrdenTrabajo'], function () {
    
    Route::get('orden_trabajos', [OrdenTrabajoController::class, 'index'])->name('orden_trabajos.index');
    Route::get('orden_trabajos/create', [OrdenTrabajoController::class, 'create'])->name('orden_trabajos.create');
    Route::post('orden_trabajos', [OrdenTrabajoController::class, 'store'])->name('orden_trabajos.store');

    Route::group(['prefix' => 'orden_trabajos/{trabajo}'], function () {
        Route::get('edit', [OrdenTrabajoController::class, 'edit'])->name('orden_trabajos.edit');
        Route::patch('/', [OrdenTrabajoController::class, 'update'])->name('orden_trabajos.update');
        Route::delete('/', [OrdenTrabajoController::class, 'destroy'])->name('orden_trabajos.destroy');
    });

    Route::get('orden_trabajos/pendientes', [OrdenTrabajoController::class, 'pendientes'])->name('orden_trabajos.pendientes');
    Route::get('orden_trabajos/entregadas', [OrdenTrabajoController::class, 'entregadas'])->name('orden_trabajos.entregadas');
    Route::get('orden_trabajos/anuladas', [OrdenTrabajoController::class, 'anuladas'])->name('orden_trabajos.anuladas');

    Route::get('orden_trabajos/{dias}', [OrdenTrabajoController::class, 'px_entregas'])->name('orden_trabajos.px_entregas');
});  



Route::group(['namespace' => 'ItemOt'], function () {
    
    Route::get('item_ots', [ItemOtController::class, 'index'])->name('item_ots.index');
    Route::get('item_ots/{trabajo}/create', [ItemOtController::class, 'create'])->name('item_ots.create');
    Route::post('item_ots/{trabajo}', [ItemOtController::class, 'store'])->name('item_ots.store');

    Route::group(['prefix' => 'item_ots/{item_ot}/{trabajo}'], function () {
        Route::get('edit', [ItemOtController::class, 'edit'])->name('item_ots.edit');
        Route::patch('/', [ItemOtController::class, 'update'])->name('item_ots.update');
        Route::delete('/', [ItemOtController::class, 'destroy'])->name('item_ots.destroy');
    });
}); 

Route::group(['namespace' => 'ImagenItemOt'], function () {
    
    //Route::get('item_ots', [ItemOtController::class, 'index'])->name('item_ots.index');
    //Route::get('item_ots/{trabajo}/create', [ItemOtController::class, 'create'])->name('item_ots.create');
    //Route::post('imagen_item_ots/{item_ot}', [ImagenItemOtController::class, 'store'])->name('imagen_itemot.store');
    //Route::post('imagen_item_ots', [ImagenItemOtController::class, 'store'])->name('imagen_itemot.store');
    //Route::post('imagen_item_ots', [ImagenItemOtController::class, 'store'])->name('imagen_itemot.store');

    

    Route::group(['prefix' => 'imagen_item_ots'], function () {
        //Route::get('edit', [ItemOtController::class, 'edit'])->name('item_ots.edit');
        //Route::patch('/', [ItemOtController::class, 'update'])->name('item_ots.update');
       // Route::delete('/destroy', [ImagenItemOtController::class, 'destroy'])->name('imagen_itemot.destroy');
    });
}); 

Route::post('imagen_item_ots', 'ImagenItemOtController@store')->name('imagen_itemot.store');

Route::post('imagen_item_ots/destroy', 'ImagenItemOtController@destroy')->name('imagen_itemot.destroy');

Route::get('get-commune-list', 'CommuneController@getCommuneList')->name('get-commune-list');
Route::get('get-contactos-list', 'ClienteRepresentanteController@getContactoList')->name('get-contactos-list');
