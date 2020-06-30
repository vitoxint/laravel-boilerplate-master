<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';

Breadcrumbs::for('admin.clientes.index', function ($trail) {
    $trail->push('Clientes', route('admin.clientes.index'));
});

Breadcrumbs::for('admin.clientes.buscar_clientes', function ($trail) {
    $trail->push('Resultado de la búsqueda', route('admin.clientes.buscar_clientes'));
});

Breadcrumbs::for('admin.contacto_clientes.buscar_contactos', function ($trail) {
    $trail->push('Resultado de la búsqueda', route('admin.contacto_clientes.buscar_contactos'));
});

Breadcrumbs::for('admin.clientes.create', function ($trail) {
    $trail->parent('admin.clientes.index', route('admin.clientes.index'));
    $trail->push('Registrar nuevo cliente', route('admin.clientes.create'));
});

Breadcrumbs::for('admin.clientes.edit', function ($trail, $cliente) {
    $trail->parent('admin.clientes.index', route('admin.clientes.index'));
    //$trail->push('', route('admin.clientes.edit'));
    $trail->push($cliente->razon_social, route('admin.clientes.edit', $cliente));
});

Breadcrumbs::for('admin.contacto_clientes.create', function ($trail, $cliente) {
    $trail->parent('admin.clientes.index', route('admin.clientes.index'));
    $trail->push('Crear contacto cliente', route('admin.contacto_clientes.create',$cliente));
});

Breadcrumbs::for('admin.contacto_clientes.edit', function ($trail, $contacto) {
    //$trail->parent('admin.clientes.edit', route('admin.clientes.edit', $contacto->cliente ));
    $trail->push('Editar contacto cliente', route('admin.contacto_clientes.edit', [$contacto, $contacto->cliente]));
});

Breadcrumbs::for('admin.contacto_clientes.index', function ($trail) {
    $trail->push('Contacto clientes', route('admin.contacto_clientes.index'));
});

Breadcrumbs::for('admin.orden_trabajos.index', function ($trail) {
    $trail->push('Orden Trabajos', route('admin.orden_trabajos.index'));
});

Breadcrumbs::for('admin.orden_trabajos.anuladas', function ($trail) {
    $trail->push('Orden Trabajos Anuladas', route('admin.orden_trabajos.anuladas'));
});

Breadcrumbs::for('admin.orden_trabajos.pendientes', function ($trail) {
    $trail->push('Orden Trabajos En Taller', route('admin.orden_trabajos.pendientes'));
});

Breadcrumbs::for('admin.orden_trabajos.entregadas', function ($trail) {
    $trail->push('Orden Trabajos Entregadas', route('admin.orden_trabajos.entregadas'));
});

Breadcrumbs::for('admin.orden_trabajos.px_entregas', function ($trail, $dias) {
    $trail->push('Entregas pendientes en los próximos '.$dias.' días', route('admin.orden_trabajos.px_entregas',$dias));
});

Breadcrumbs::for('admin.orden_trabajos.create', function ($trail) {
    $trail->parent('admin.orden_trabajos.index', route('admin.orden_trabajos.index'));
    $trail->push('Ingresar nueva OT', route('admin.orden_trabajos.create'));
});

Breadcrumbs::for('admin.orden_trabajos.edit', function ($trail, $trabajo) {
    $trail->parent('admin.orden_trabajos.index', route('admin.orden_trabajos.index'));
    $trail->push($trabajo->folio, route('admin.orden_trabajos.edit',$trabajo));
});

Breadcrumbs::for('admin.item_ots.create', function ($trail,$trabajo) {
    //$trail->parent('admin.orden_trabajos.edit', route('admin.orden_trabajos.edit', $trabajo ));
    $trail->parent('admin.orden_trabajos.index', route('admin.orden_trabajos.index'));
    $trail->push( $trabajo->folio .' | Agregar ítem OT', route('admin.item_ots.create', $trabajo));
});

Breadcrumbs::for('admin.item_ots.edit', function ($trail, $item_ot, $trabajo) {
    //$trail->parent('admin.orden_trabajos.index', route('admin.orden_trabajos.index'));
    //$trail->parent('admin.orden_trabajos.edit', route('admin.orden_trabajos.edit', $trabajo ));
    $trail->push( 'Orden Trabajo', route('admin.orden_trabajos.index', $trabajo));
    $trail->push( $trabajo->folio , route('admin.orden_trabajos.edit', $trabajo));
    
    $trail->push($item_ot->folio, route('admin.item_ots.edit',[$item_ot, $trabajo]));
});

Breadcrumbs::for('admin.cotizaciones.index', function ($trail) {
    $trail->push('Cotizaciones', route('admin.cotizaciones.index'));
});

Breadcrumbs::for('admin.cotizaciones.vigentes', function ($trail) {
    $trail->parent('admin.cotizaciones.index', route('admin.cotizaciones.index'));
    $trail->push('Cotizaciones vigentes', route('admin.cotizaciones.vigentes'));
});

Breadcrumbs::for('admin.cotizaciones.aceptadas', function ($trail) {
    $trail->parent('admin.cotizaciones.index', route('admin.cotizaciones.index'));
    $trail->push('Cotizaciones aceptadas', route('admin.cotizaciones.aceptadas'));
});

Breadcrumbs::for('admin.cotizaciones.buscar_cotizacion', function ($trail) {
    $trail->parent('admin.cotizaciones.index', route('admin.cotizaciones.index'));
    $trail->push('Resultados de la búsqueda', route('admin.cotizaciones.buscar_cotizacion'));
});

Breadcrumbs::for('admin.cotizaciones.create', function ($trail) {
    $trail->parent('admin.cotizaciones.index', route('admin.cotizaciones.index'));
    $trail->push('Nueva cotización', route('admin.cotizaciones.create'));
});

Breadcrumbs::for('admin.cotizaciones.edit', function ($trail, $cotizacion) {
    $trail->parent('admin.cotizaciones.index', route('admin.cotizaciones.index'));
    $trail->push('Editar cotización: '.$cotizacion->folio, route('admin.cotizaciones.edit',$cotizacion));
});

Breadcrumbs::for('admin.item_ots.index', function ($trail) {
    $trail->push('Trabajos (ítems)', route('admin.item_ots.index'));
});

Breadcrumbs::for('admin.item_ots.editTaller', function ($trail,$item_ot, $trabajo) {

    $trail->parent('admin.item_ots.index', route('admin.item_ots.index'));
  
    $trail->push('Ver trabajo : '. $item_ot->folio, route('admin.item_ots.editTaller',[$item_ot, $trabajo]));
   
});

Breadcrumbs::for('admin.procesos.index', function ($trail) {
    $trail->push('Clasificación de procesos', route('admin.procesos.index'));
});

Breadcrumbs::for('admin.procesos.create', function ($trail) {
    $trail->parent('admin.procesos.index', route('admin.procesos.index'));
    $trail->push('Añadir nuevo proceso', route('admin.procesos.create'));
});

Breadcrumbs::for('admin.procesos.edit', function ($trail,$proceso) {
    $trail->parent('admin.procesos.index', route('admin.procesos.index'));
    $trail->push('Editar: '.$proceso->codigo, route('admin.procesos.edit' ,$proceso));
});

Breadcrumbs::for('admin.maquinas.index', function ($trail) {
    $trail->push('Registro de máquinas', route('admin.maquinas.index'));
});

Breadcrumbs::for('admin.maquinas.create', function ($trail) {
    $trail->parent('admin.maquinas.index', route('admin.maquinas.index'));
    $trail->push('Registrar nueva máquina', route('admin.maquinas.create'));
});

Breadcrumbs::for('admin.maquinas.edit', function ($trail,$maquina) {
    $trail->parent('admin.maquinas.index', route('admin.maquinas.index'));
    $trail->push('Editar datos máquina : '. $maquina->codigo, route('admin.maquinas.edit', $maquina));
});

Breadcrumbs::for('admin.empleados.index', function ($trail) {
    $trail->push('Registro de operadores', route('admin.empleados.index'));
});

Breadcrumbs::for('admin.empleados.buscar_operadores', function ($trail) {
    $trail->push('Operadores encontrados la búsqueda', route('admin.empleados.buscar_operadores'));
});

Breadcrumbs::for('admin.empleados.create', function ($trail) {
    $trail->parent('admin.empleados.index', route('admin.empleados.index'));
    $trail->push('Registrar nuevo operador', route('admin.empleados.create'));
});


Breadcrumbs::for('admin.empleados.edit', function ($trail,$empleado) {
    $trail->parent('admin.empleados.index', route('admin.empleados.index'));
    $trail->push('Editar operador: '.$empleado->codigo, route('admin.empleados.edit',$empleado));
});

Breadcrumbs::for('admin.etapa_itemots.create', function ($trail, $item_ot) {
    $trail->push('Orden Trabajo', route('admin.orden_trabajos.index'));
    $trail->push( $item_ot->ordenTrabajo->folio, route('admin.orden_trabajos.edit',[$item_ot->OrdenTrabajo]));
    $trail->push( $item_ot->folio, route('admin.item_ots.edit',[$item_ot, $item_ot->OrdenTrabajo]));
    $trail->push('Agregar proceso al trabajo', route('admin.etapa_itemots.create',$item_ot, $item_ot->ordenTrabajo));
});

Breadcrumbs::for('admin.etapa_itemots.edit', function ($trail,$etapaItemOt) {
    $trail->push('Orden Trabajo', route('admin.orden_trabajos.index'));
    $trail->push( $etapaItemOt->itemOt->ordenTrabajo->folio, route('admin.orden_trabajos.edit',[$etapaItemOt->itemOt->OrdenTrabajo]));
    $trail->push( $etapaItemOt->itemOt->folio, route('admin.item_ots.edit',[$etapaItemOt->itemOt, $etapaItemOt->itemOt->OrdenTrabajo]));
    $trail->push( $etapaItemOt->codigo, route('admin.etapa_itemots.edit',$etapaItemOt));
});

Breadcrumbs::for('admin.materiales.index', function ($trail) {
    $trail->push('Base de materiales', route('admin.materiales.index'));
});

Breadcrumbs::for('admin.materiales.create', function ($trail) {
    $trail->parent('admin.materiales.index', route('admin.materiales.index'));
    $trail->push('Registrar material', route('admin.materiales.create'));
});

Breadcrumbs::for('admin.materiales.edit', function ($trail ,$material) {
    $trail->parent('admin.materiales.index', route('admin.materiales.index'));
    $trail->push('Editar material / Consultar dimensionado', route('admin.materiales.edit',$material));
});

Breadcrumbs::for('admin.materiales.barra', function ($trail) {
    $trail->parent('admin.materiales.index', route('admin.materiales.index'));
    $trail->push('Barras Redonda', route('admin.materiales.barra'));
});

Breadcrumbs::for('admin.materiales.barra_perforada', function ($trail) {
    $trail->parent('admin.materiales.index', route('admin.materiales.index'));
    $trail->push('Barras Perforadas', route('admin.materiales.barra_perforada'));
});

Breadcrumbs::for('admin.materiales.plancha', function ($trail) {
    $trail->parent('admin.materiales.index', route('admin.materiales.index'));
    $trail->push('Planchas / Láminas', route('admin.materiales.plancha'));
});

Breadcrumbs::for('admin.materiales.buscar_material', function ($trail) {
    $trail->parent('admin.materiales.index', route('admin.materiales.index'));
    $trail->push('Resultados de la búsqueda', route('admin.materiales.buscar_material'));
});

Breadcrumbs::for('admin.depositos.index', function ($trail) {
    $trail->push('Lugares de depósito de material', route('admin.depositos.index'));
});

Breadcrumbs::for('admin.depositos.create', function ($trail) {
    $trail->parent('admin.depositos.index', route('admin.depositos.index'));
    $trail->push('Registrar nuevo lugar de depósito', route('admin.depositos.create'));
});

Breadcrumbs::for('admin.depositos.edit', function ($trail,$deposito) {
    $trail->parent('admin.depositos.index', route('admin.depositos.index'));
    $trail->push('Editar lugar de depósito material', route('admin.depositos.edit', $deposito));
});

Breadcrumbs::for('admin.existencia_material.index', function ($trail) {
    $trail->push('Materiales existentes (metales)', route('admin.existencia_material.index'));
});

Breadcrumbs::for('admin.solicitud_material.index', function ($trail) {
    $trail->push('Solicitudes activas de material', route('admin.solicitud_material.index'));
});

Breadcrumbs::for('admin.solicitudes_material.edit', function ($trail,$solicitud) {
    $trail->push('Solicitudes activas de material', route('admin.solicitud_material.index'));
    $trail->push('Responder solicitud de material', route('admin.solicitudes_material.edit', $solicitud));
});

Breadcrumbs::for('admin.existencia_material.edit', function ($trail, $existenciaMaterial) {
    $trail->push('Materiales existentes (metales)', route('admin.existencia_material.index'));
    $trail->push('Ajustar existencia', route('admin.existencia_material.edit' , $existenciaMaterial));
});

Breadcrumbs::for('admin.productos-venta.index', function ($trail) {
    $trail->push('Catálogo de productos', route('admin.productos-venta.index'));
});

Breadcrumbs::for('admin.productos-venta.create', function ($trail) {
    $trail->push('Catálogo de productos', route('admin.productos-venta.index'));
    $trail->push('Ingresar nuevo producto', route('admin.productos-venta.create'));
});

Breadcrumbs::for('admin.productos-venta.buscar_producto', function ($trail) {
    $trail->push('Resultados de la búsqueda', route('admin.productos-venta.buscar_producto'));
});

Breadcrumbs::for('admin.productos-venta.edit', function ($trail, $producto) {
    $trail->push('Catálogo de productos', route('admin.productos-venta.index'));
    $trail->push('Editar producto : '.$producto->codigo, route('admin.productos-venta.edit' ,$producto));
});

Breadcrumbs::for('admin.orden_trabajos.opencode', function ($trail) {
    $trail->push('Orden Trabajos', route('admin.orden_trabajos.index'));
    $trail->push('Buscar OT por código', route('admin.orden_trabajos.opencode'));
});

Breadcrumbs::for('admin.item_ots.opencode', function ($trail) {
    $trail->push('Trabajos (items)', route('admin.item_ots.index'));
    $trail->push('Buscar trabajo por código', route('admin.item_ots.opencode'));
});

Breadcrumbs::for('admin.productos-venta.opencode', function ($trail) {
    $trail->push('Catálogo de productos', route('admin.productos-venta.index'));
    $trail->push('Producto encontrado por código', route('admin.productos-venta.opencode'));
});