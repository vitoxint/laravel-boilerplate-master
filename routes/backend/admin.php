<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ClienteController;
use App\Http\Controllers\Backend\ClienteRepresentanteController;
use App\Http\Controllers\Backend\OrdenTrabajoController;
use App\Http\Controllers\Backend\ItemOtController;
use App\Http\Controllers\Backend\ImagenItemOtController;
use App\Http\Controllers\Backend\CotizacionController;
use App\Http\Controllers\Backend\ItemCotizacionController;
use App\Http\Controllers\Backend\ProcesoController;
use App\Http\Controllers\Backend\MaquinaController;
use App\Http\Controllers\Backend\EmpleadoController;
use App\Http\Controllers\Backend\MaquinaHasOperadorController;
use App\Http\Controllers\Backend\EtapaItemOtController;
use App\Http\Controllers\Backend\MaterialController;



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

        Route::get('send', [OrdenTrabajoController::class, 'send'])->name('orden_trabajos.send');
        Route::get('printCliente', [OrdenTrabajoController::class, 'printCliente'])->name('orden_trabajos.printCliente');
        Route::get('printTaller', [OrdenTrabajoController::class, 'printTaller'])->name('orden_trabajos.printTaller');
    });

    Route::get('orden_trabajos/pendientes', [OrdenTrabajoController::class, 'pendientes'])->name('orden_trabajos.pendientes');
    Route::get('orden_trabajos/entregadas', [OrdenTrabajoController::class, 'entregadas'])->name('orden_trabajos.entregadas');
    Route::get('orden_trabajos/anuladas', [OrdenTrabajoController::class, 'anuladas'])->name('orden_trabajos.anuladas');

    Route::get('orden_trabajos/{dias}', [OrdenTrabajoController::class, 'px_entregas'])->name('orden_trabajos.px_entregas');
});  



Route::group(['namespace' => 'Cotizacion'], function () {
    
    Route::get('cotizaciones', [CotizacionController::class, 'index'])->name('cotizaciones.index');
    Route::get('cotizaciones/create', [CotizacionController::class, 'create'])->name('cotizaciones.create');
    Route::post('cotizaciones', [CotizacionController::class, 'store'])->name('cotizaciones.store');

    Route::group(['prefix' => 'cotizaciones/{cotizacion}'], function () {
        Route::get('edit', [CotizacionController::class, 'edit'])->name('cotizaciones.edit');
        Route::get('print', [CotizacionController::class, 'print'])->name('cotizaciones.print');
        Route::get('send', [CotizacionController::class, 'send'])->name('cotizaciones.send');
        Route::patch('/', [CotizacionController::class, 'update'])->name('cotizaciones.update');
        Route::delete('/', [CotizacionController::class, 'destroy'])->name('cotizaciones.destroy');
    });

    Route::get('cotizaciones/vigentes', [CotizacionController::class, 'vigentes'])->name('cotizaciones.vigentes');
    Route::get('cotizaciones/aceptadas', [CotizacionController::class, 'aceptadas'])->name('cotizaciones.aceptadas');

    Route::get('cotizaciones/resultados', [CotizacionController::class, 'buscar_cotizacion'])->name('cotizaciones.buscar_cotizacion');
   
}); 



Route::group(['namespace' => 'ItemOt'], function () {
    
    Route::get('item_ots', [ItemOtController::class, 'index'])->name('item_ots.index');
    Route::get('item_ots/{trabajo}/create', [ItemOtController::class, 'create'])->name('item_ots.create');
    Route::post('item_ots/{trabajo}', [ItemOtController::class, 'store'])->name('item_ots.store');

    Route::group(['prefix' => 'item_ots/{item_ot}/{trabajo}'], function () {
        Route::get('edit', [ItemOtController::class, 'edit'])->name('item_ots.edit');
        Route::get('editTaller', [ItemOtController::class, 'editTaller'])->name('item_ots.editTaller');
        Route::patch('/', [ItemOtController::class, 'update'])->name('item_ots.update');
        Route::get('print_etq', [ItemOtController::class, 'print_etq'])->name('item_ots.print_etq');
        Route::delete('/', [ItemOtController::class, 'destroy'])->name('item_ots.destroy');
    });
}); 


Route::group(['namespace' => 'ItemCotizacion'], function () {
    
 /*    Route::get('item_ots', [ItemOtController::class, 'index'])->name('item_ots.index');
    Route::get('item_ots/{trabajo}/create', [ItemOtController::class, 'create'])->name('item_ots.create'); */
    Route::post('item_cotizacions', [ItemCotizacionController::class, 'store'])->name('item_cotizacions.store');
    Route::post('item_cotizacions/destroy', [ItemCotizacionController::class, 'destroy'])->name('item_cotizacions.destroy');

  /*   Route::group(['prefix' => 'item_ots/{item_ot}/{trabajo}'], function () {
        Route::get('edit', [ItemOtController::class, 'edit'])->name('item_ots.edit');
        Route::patch('/', [ItemOtController::class, 'update'])->name('item_ots.update');
        Route::delete('/', [ItemOtController::class, 'destroy'])->name('item_ots.destroy');
    }); */
}); 

Route::group(['namespace' => 'Proceso'], function () {
    
    Route::get('procesos', [ProcesoController::class, 'index'])->name('procesos.index');
    Route::get('procesos/create', [ProcesoController::class, 'create'])->name('procesos.create');
    Route::post('procesos', [ProcesoController::class, 'store'])->name('procesos.store');

    Route::group(['prefix' => 'procesos/{proceso}'], function () {
        Route::get('edit', [ProcesoController::class, 'edit'])->name('procesos.edit');
        Route::patch('/', [ProcesoController::class, 'update'])->name('procesos.update');
        Route::delete('/', [ProcesoController::class, 'destroy'])->name('procesos.destroy');
    });

}); 

Route::group(['namespace' => 'Maquina'], function () {
    
    Route::get('maquinas', [MaquinaController::class, 'index'])->name('maquinas.index');
    Route::get('maquinas/create', [MaquinaController::class, 'create'])->name('maquinas.create');
    Route::post('maquinas', [MaquinaController::class, 'store'])->name('maquinas.store');
    Route::get('maquinas/dataAjax', [MaquinaController::class, 'dataAjax'])->name('maquinas.dataAjax');

    Route::group(['prefix' => 'maquinas/{maquina}'], function () {
        Route::get('edit', [MaquinaController::class, 'edit'])->name('maquinas.edit');
        Route::patch('/', [MaquinaController::class, 'update'])->name('maquinas.update');
        Route::delete('/', [MaquinaController::class, 'destroy'])->name('maquinas.destroy');
    });

}); 

Route::group(['namespace' => 'Empleado'], function () {
    
    Route::get('empleados', [EmpleadoController::class, 'index'])->name('empleados.index');
    Route::get('empleados/create', [EmpleadoController::class, 'create'])->name('empleados.create');
    Route::post('empleados', [EmpleadoController::class, 'store'])->name('empleados.store');
    Route::get('empleados/dataAjax', [EmpleadoController::class, 'dataAjax'])->name('empleados.dataAjax');

    Route::group(['prefix' => 'empleados/{empleado}'], function () {
        Route::get('edit', [EmpleadoController::class, 'edit'])->name('empleados.edit');
        Route::patch('/', [EmpleadoController::class, 'update'])->name('empleados.update');
        Route::delete('/', [EmpleadoController::class, 'destroy'])->name('empleados.destroy');
    });

    Route::get('empleados/resultados', [EmpleadoController::class, 'buscar_operadores'])->name('empleados.buscar_operadores');

}); 


Route::group(['namespace' => 'EtapaItemOt'], function () {
    
       //Route::get('item_ots', [ItemOtController::class, 'index'])->name('item_ots.index');
       Route::get('etapa_itemots/{item_ot}', [EtapaItemOtController::class, 'create'])->name('etapa_itemots.create');
       Route::post('etapa_itemots/{item_ot}', [EtapaItemOtController::class, 'store'])->name('etapa_itemots.store');

        Route::group(['prefix' => 'etapa_itemots/{etapaItemOt}'], function () {
           Route::get('edit', [EtapaItemOtController::class, 'edit'])->name('etapa_itemots.edit');
           Route::patch('/', [EtapaItemOtController::class, 'update'])->name('etapa_itemots.update');
           Route::delete('/', [EtapaItemOtController::class, 'destroy'])->name('etapa_itemots.destroy');
       }); 
   });


   Route::group(['namespace' => 'Material'], function () {
    
    Route::get('materiales', [MaterialController::class, 'index'])->name('materiales.index');
    Route::get('materiales/create', [MaterialController::class, 'create'])->name('materiales.create');
    Route::post('materiales', [MaterialController::class, 'store'])->name('materiales.store');
    Route::get('materiales/dataAjax', [MaterialController::class, 'dataAjax'])->name('materiales.dataAjax');

    Route::group(['prefix' => 'materiales/{material}'], function () {
        Route::get('edit', [MaterialController::class, 'edit'])->name('materiales.edit');
        Route::patch('/', [MaterialController::class, 'update'])->name('materiales.update');
        Route::delete('/', [MaterialController::class, 'destroy'])->name('materiales.destroy');
    });

   // Route::get('empleados/resultados', [MaterialController::class, 'buscar_operadores'])->name('empleados.buscar_operadores');

});
   

Route::get('get-valor-proceso', 'ProcesoController@getValorProceso')->name('get-valor-proceso');

Route::post('maquinaOperadores/destroy', [MaquinaHasOperadorController::class, 'destroy'])->name('maquinahasoperador.destroy');


Route::post('imagen_item_ots', 'ImagenItemOtController@store')->name('imagen_itemot.store');

Route::post('imagen_item_ots/destroy', 'ImagenItemOtController@destroy')->name('imagen_itemot.destroy');

Route::get('get-commune-list', 'CommuneController@getCommuneList')->name('get-commune-list');
Route::get('get-maquina-list', 'MaquinaController@getMaquinaList')->name('get-maquina-list');
Route::get('get-operador-list', 'EmpleadoController@getOperadorList')->name('get-operador-list');

Route::get('get-contactos-list', 'ClienteRepresentanteController@getContactoList')->name('get-contactos-list');

Route::post('imagen_item_ots/display', 'ImagenItemOtController@display')->name('imagen_itemot.display');
   