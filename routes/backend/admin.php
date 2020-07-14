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
use App\Http\Controllers\Backend\TrabajoUseMaterialController;
use App\Http\Controllers\Backend\DepositoController;
use App\Http\Controllers\Backend\ExistenciaMaterialController;
use App\Http\Controllers\Backend\SolicitudMaterialOtController;
use App\Http\Controllers\Backend\ProductoVentaController;
use App\Http\Controllers\Backend\ExistenciaProductoVentaController;
use App\Http\Controllers\Backend\EntregaOtController;
use App\Http\Controllers\Backend\PagoOtController;
use App\Http\Controllers\Backend\FileCotizacionController;
use App\Http\Controllers\Backend\CuentaClienteController;
use App\Http\Controllers\Backend\AbonoCuentaClienteController;



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


Route::group(['namespace' => 'CuentaCliente'], function () {
    
    Route::get('cuenta_clientes', [CuentaClienteController::class, 'index'])->name('cuenta_clientes.index');
    Route::get('cuenta_clientes/create', [CuentaClienteController::class, 'create'])->name('cuenta_clientes.create');
    Route::post('cuenta_clientes', [CuentaClienteController::class, 'store'])->name('cuenta_clientes.store');

    Route::group(['prefix' => 'cuenta_clientes/{cuenta}'], function () {
        Route::get('edit', [CuentaClienteController::class, 'edit'])->name('cuenta_clientes.edit');
        Route::patch('/', [CuentaClienteController::class, 'update'])->name('cuenta_clientes.update');
        Route::delete('/', [CuentaClienteController::class, 'destroy'])->name('cuenta_clientes.destroy');
    });

    //Route::get('contacto_clientes/resultados', [ClienteRepresentanteController::class, 'buscar_clientes'])->name('contacto_clientes.buscar_contactos');
});



Route::group(['namespace' => 'OrdenTrabajo' ], function () {
    
    Route::get('orden_trabajos', [OrdenTrabajoController::class, 'index'])->name('orden_trabajos.index');
    Route::get('orden_trabajos/create', [OrdenTrabajoController::class, 'create'])->name('orden_trabajos.create');
    Route::post('orden_trabajos', [OrdenTrabajoController::class, 'store'])->name('orden_trabajos.store');
    Route::post('orden_trabajos/opencode', [OrdenTrabajoController::class, 'opencode'])->name('orden_trabajos.opencode');

    Route::get('ordenTrabajo/getChartMonth', [OrdenTrabajoController::class, 'getOtsOfMonthGraph']);

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

    Route::get('ordenTrabajos/resultados', [OrdenTrabajoController::class, 'buscar_ot'])->name('orden_trabajos.buscar_trabajo');
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

    Route::get('items_terminados/dataAjax', [ItemOtController::class, 'dataAjax'])->name('item_ots.dataAjax');

    Route::group(['prefix' => 'item_ots/{item_ot}/{trabajo}'], function () {
        Route::get('edit', [ItemOtController::class, 'edit'])->name('item_ots.edit');
        Route::get('editTaller', [ItemOtController::class, 'editTaller'])->name('item_ots.editTaller');
        Route::patch('/', [ItemOtController::class, 'update'])->name('item_ots.update');
        Route::get('print_etq', [ItemOtController::class, 'print_etq'])->name('item_ots.print_etq');
        Route::delete('/', [ItemOtController::class, 'destroy'])->name('item_ots.destroy');
    });
}); 


Route::post('item_ots', [ItemOtController::class, 'opencode'])->name('item_ots.opencode');


Route::group(['namespace' => 'ItemCotizacion'], function () {
 
    Route::post('item_cotizacions', [ItemCotizacionController::class, 'store'])->name('item_cotizacions.store');
    Route::post('item_cotizacions/destroy', [ItemCotizacionController::class, 'destroy'])->name('item_cotizacions.destroy');


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

           Route::get('comenzar', [EtapaItemOtController::class, 'comenzar'])->name('etapa_itemots.comenzar');
           Route::get('terminar', [EtapaItemOtController::class, 'terminar'])->name('etapa_itemots.terminar');

           Route::get('comenzar_taller', [EtapaItemOtController::class, 'comenzarTaller'])->name('etapa_itemots.comenzarTaller');
           Route::get('terminar_taller', [EtapaItemOtController::class, 'terminarTaller'])->name('etapa_itemots.terminarTaller');
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

    Route::get('materiales/barra', [MaterialController::class, 'filtrarBarras'])->name('materiales.barra');
    Route::get('materiales/barra_perforada', [MaterialController::class, 'filtrarPerforadas'])->name('materiales.barra_perforada');
    Route::get('materiales/plancha', [MaterialController::class, 'filtrarPlanchas'])->name('materiales.plancha');

    Route::get('materiales/resultados', [MaterialController::class, 'buscar_material'])->name('materiales.buscar_material');


});


Route::group(['namespace' => 'TrabajoUseMaterial'], function () {
    
    //Route::get('solicitud_material', [SolicitudMaterialOtController::class, 'index_solicitudes_material'])->name('solicitud_material.index');/*
    /*Route::get('item_ots/{trabajo}/create', [ItemOtController::class, 'create'])->name('item_ots.create'); */
    Route::post('trabajo_materials', [TrabajoUseMaterialController::class, 'store'])->name('trabajo_material.store');
    Route::post('trabajo_materials_consumir', [TrabajoUseMaterialController::class, 'consumir'])->name('trabajo_material.consumir');
    Route::post('trabajo_materials/destroy', [TrabajoUseMaterialController::class, 'destroy'])->name('trabajo_material.destroy');

        Route::group(['prefix' => 'solicitudes_material/{solicitud}'], function () {
        //Route::get('edit', [TrabajoUseMaterialController::class, 'edit'])->name('solicitudes_material.edit');
        Route::patch('/', [ItemOtController::class, 'update'])->name('solicitudes_material.update');
        //Route::delete('/', [ItemOtController::class, 'destroy'])->name('item_ots.destroy');
    }); 
}); 

Route::group(['namespace' => 'SolicitudMaterialOt'], function () {
    
    Route::get('solicitud_material', [SolicitudMaterialOtController::class, 'index_solicitudes_material'])->name('solicitud_material.index');/*
    Route::get('item_ots/{trabajo}/create', [ItemOtController::class, 'create'])->name('item_ots.create'); */
    Route::post('solicitud_materials', [SolicitudMaterialOtController::class, 'store'])->name('solicitud_material.store');
    Route::post('solicitud_materials/cambiarstatus', [SolicitudMaterialOtController::class, 'cambiarEstado'])->name('solicitud_material.cambiar_estado');

    Route::post('solicitud_materials/destroy', [SolicitudMaterialOtController::class, 'destroy'])->name('solicitud_material.destroy');

        Route::group(['prefix' => 'solicitudes_material/{solicitud}'], function () {
        Route::get('edit', [SolicitudMaterialOtController::class, 'edit'])->name('solicitudes_material.edit');
       // Route::patch('/', [ItemOtController::class, 'update'])->name('solicitudes_material.update');
        //Route::delete('/', [ItemOtController::class, 'destroy'])->name('item_ots.destroy');
    }); 
}); 



Route::group(['namespace' => 'Deposito'], function () {
    
    Route::get('depositos', [DepositoController::class, 'index'])->name('depositos.index');
    Route::get('depositos/create', [DepositoController::class, 'create'])->name('depositos.create');
    Route::post('depositos', [DepositoController::class, 'store'])->name('depositos.store');
    Route::get('depositos/dataAjax', [DepositoController::class, 'dataAjax'])->name('depositos.dataAjax');

    Route::group(['prefix' => 'depositos/{deposito}'], function () {
        Route::get('edit', [DepositoController::class, 'edit'])->name('depositos.edit');
        Route::patch('/', [DepositoController::class, 'update'])->name('depositos.update');
        Route::delete('/', [DepositoController::class, 'destroy'])->name('depositos.destroy');
    });

    //Route::get('empleados/resultados', [EmpleadoController::class, 'buscar_operadores'])->name('empleados.buscar_operadores');

}); 


Route::group(['namespace' => 'ExistenciaMaterial'], function () {
    
    Route::get('existencia_material', [ExistenciaMaterialController::class, 'index'])->name('existencia_material.index');
    

    Route::get('existencia_material/create', [ExistenciaMaterialController::class, 'create'])->name('existencia_material.create');
    Route::post('existencia_material', [ExistenciaMaterialController::class, 'store'])->name('existencia_material.store');
    Route::get('existencia_material/dataAjax', [ExistenciaMaterialController::class, 'dataAjax'])->name('existencia-material.dataAjax');

    Route::group(['prefix' => 'existencia_material/{existenciaMaterial}'], function () {
        Route::get('edit', [ExistenciaMaterialController::class, 'edit'])->name('existencia_material.edit');
        Route::patch('/', [ExistenciaMaterialController::class, 'update'])->name('existencia_material.update');
        Route::delete('/', [ExistenciaMaterialController::class, 'destroy'])->name('existencia_material.destroy');
    });

}); 


Route::group(['namespace' => 'ProductoVenta'], function () {
    
    Route::get('productos-venta', [ProductoVentaController::class, 'index'])->name('productos-venta.index');
    Route::get('productos-venta/create', [ProductoVentaController::class, 'create'])->name('productos-venta.create');
    Route::post('productos-venta', [ProductoVentaController::class, 'store'])->name('productos-venta.store');
    Route::get('productos-venta/dataAjax', [ProductoVentaController::class, 'dataAjax'])->name('productos-venta.dataAjax');

    Route::post('productos-ventas', [ProductoVentaController::class, 'opencode'])->name('productos-venta.opencode');

    Route::get('marca-select2', [ProductoVentaController::class, 'marcaSelect2'])->name('marcas.dataAjax');
    Route::get('familia-select2', [ProductoVentaController::class, 'familiaSelect2'])->name('familias.dataAjax');

    Route::group(['prefix' => 'productos-venta/{producto}'], function () {
        Route::get('edit', [ProductoVentaController::class, 'edit'])->name('productos-venta.edit');
        Route::patch('/', [ProductoVentaController::class, 'update'])->name('productos-venta.update');
        Route::delete('/', [ProductoVentaController::class, 'destroy'])->name('productos-venta.destroy');

        Route::get('print_etq', [ProductoVentaController::class, 'print_etq'])->name('productos-venta.print_etq');
    });


    Route::get('productos-venta/resultados', [ProductoVentaController::class, 'buscar_producto'])->name('productos-venta.buscar_producto');


});

Route::group(['namespace' => 'ExistenciaProductoVenta'], function () {
    
    /* Route::get('existencia_producto', [ExistenciaProductoVentaController::class, 'index'])->name('existencia_producto.index');
    

    Route::get('existencia_producto/create', [ExistenciaProductoVentaController::class, 'create'])->name('existencia_producto.create'); */
    Route::post('existencia_producto', [ExistenciaProductoVentaController::class, 'store'])->name('existencia_producto.store');
    Route::post('existencia_producto/destroy', [ExistenciaProductoVentaController::class, 'destroy'])->name('existencia_producto.destroy');

    Route::post('existencia_producto/sumar', [ExistenciaProductoVentaController::class, 'sumar'])->name('existencia_producto.sumar');
    Route::post('existencia_producto/restar', [ExistenciaProductoVentaController::class, 'restar'])->name('existencia_producto.restar');
/*     Route::get('existencia_producto/dataAjax', [ExistenciaProductoVentaController::class, 'dataAjax'])->name('existencia-producto.dataAjax');

    Route::group(['prefix' => 'existencia_producto/{existenciaProducto}'], function () {
        Route::get('edit', [ExistenciaProductoVentaController::class, 'edit'])->name('existencia_producto.edit');
        Route::patch('/', [ExistenciaProductoVentaController::class, 'update'])->name('existencia_producto.update');
        Route::delete('/', [ExistenciaProductoVentaController::class, 'destroy'])->name('existencia_producto.destroy');
    }); */

}); 

Route::group(['namespace' => 'EntregaOt'], function () {
    
    Route::get('entrega_ot', [EntregaOtController::class, 'index'])->name('entrega_ot.index');
    Route::get('entrega_ot/create', [EntregaOtController::class, 'create'])->name('entrega_ot.create');
    Route::post('entrega_ot', [EntregaOtController::class, 'store'])->name('entrega_ot.store');
    Route::post('entrega_ot/delete', [EntregaOtController::class, 'destroy'])->name('entrega_ot.destroy');
    //Route::get('existencia_material/dataAjax', [EntregaOtControllerController::class, 'dataAjax'])->name('existencia-material.dataAjax');

    Route::group(['prefix' => 'entrega_ot/{entregaOt}'], function () {
        Route::get('edit', [EntregaOtController::class, 'edit'])->name('entrega_ot.edit');
        Route::patch('/', [EntregaOtController::class, 'update'])->name('entrega_ot.update');
        
    });

});

Route::group(['namespace' => 'PagoOt'], function () {
    
    Route::get('pago_ot', [PagoOtController::class, 'index'])->name('pago_ot.index');
    Route::get('pago_ot/create', [PagoOtController::class, 'create'])->name('pago_ot.create');
    Route::post('pago_ot', [PagoOtController::class, 'store'])->name('pago_ot.store');
    Route::post('pago_ot/delete', [PagoOtController::class, 'destroy'])->name('pago_ot.destroy');
    //Route::get('existencia_material/dataAjax', [EntregaOtControllerController::class, 'dataAjax'])->name('existencia-material.dataAjax');

    Route::group(['prefix' => 'pago_ot/{pagoOt}'], function () {
        Route::get('edit', [PagoOtController::class, 'edit'])->name('pago_ot.edit');
        Route::patch('/', [PagoOtController::class, 'update'])->name('pago_ot.update');
        
    });

});

Route::group(['namespace' => 'AbonoCuentaCliente'], function () {
    
    Route::get('abono_cuenta', [AbonoCuentaClienteController::class, 'index'])->name('abono_cuenta.index');
    Route::get('abono_cuenta/create', [AbonoCuentaClienteController::class, 'create'])->name('abono_cuenta.create');
    Route::post('abono_cuenta', [AbonoCuentaClienteController::class, 'store'])->name('abono_cuenta.store');
    Route::post('abono_cuenta/delete', [AbonoCuentaClienteController::class, 'destroy'])->name('abono_cuenta.destroy');
    //Route::get('existencia_material/dataAjax', [EntregaOtControllerController::class, 'dataAjax'])->name('existencia-material.dataAjax');

    Route::group(['prefix' => 'abono_cuenta/{pagoOt}'], function () {
        Route::get('edit', [AbonoCuentaClienteController::class, 'edit'])->name('abono_cuenta.edit');
        Route::patch('/', [AbonoCuentaClienteController::class, 'update'])->name('abono_cuenta.update');
        
    });

});


Route::get('materiales/datosMaterial' , 'MaterialController@getDatosMaterial'  )->name('get-datos-material');
Route::get('materiales/editarMaterial' , 'MaterialController@getEditMaterial'  )->name('edit-material');
Route::get('materiales/abrirMaterial' , 'MaterialController@getAbrirMaterial'  )->name('materiales.abrir');


Route::get('existenciaMaterial/editarMaterial' , 'ExistenciaMaterialController@getEditExistenciaMaterial'  )->name('edit-existencia_material');
Route::get('existenciaMaterial/abrirMaterial' , 'ExistenciaMaterialController@getAbrirExistenciaMaterial'  )->name('existencia_material.abrir');
Route::get('existenciaMaterial/eliminarMaterial' , 'ExistenciaMaterialController@eliminarMaterial'  )->name('eliminar-existencia_material');



Route::get('existencia_materiales/datosExistenciaMaterial' , 'ExistenciaMaterialController@getDatosTrozado'  )->name('get-datos-trozado');

Route::get('get-valor-proceso', 'ProcesoController@getValorProceso')->name('get-valor-proceso');

Route::post('maquinaOperadores/destroy', [MaquinaHasOperadorController::class, 'destroy'])->name('maquinahasoperador.destroy');


Route::post('imagen_item_ots', 'ImagenItemOtController@store')->name('imagen_itemot.store');
Route::post('imagen_item_ots/destroy', 'ImagenItemOtController@destroy')->name('imagen_itemot.destroy');

Route::post('imagen_cotizacions', 'FileCotizacionController@store')->name('file_cotizacion.store');
Route::post('imagen_cotizacions/destroy', 'FileCotizacionController@destroy')->name('file_cotizacion.destroy');

Route::get('get-commune-list', 'CommuneController@getCommuneList')->name('get-commune-list');
Route::get('get-maquina-list', 'MaquinaController@getMaquinaList')->name('get-maquina-list');
Route::get('get-operador-list', 'EmpleadoController@getOperadorList')->name('get-operador-list');

Route::get('get-contactos-list', 'ClienteRepresentanteController@getContactoList')->name('get-contactos-list');

Route::post('imagen_item_ots/display', 'ImagenItemOtController@display')->name('imagen_itemot.display');
Route::post('imagen_cotizacions/display', 'FileCotizacionController@display')->name('file_cotizacion.display');
   