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
    $trail->parent('admin.orden_trabajos.index', route('admin.orden_trabajos.index'));
    //$trail->parent('admin.orden_trabajos.edit', route('admin.orden_trabajos.edit', $trabajo ));
    
    $trail->push($trabajo->folio. ' / Editar ítem OT: '. $item_ot->folio, route('admin.item_ots.edit',[$item_ot, $trabajo]));
});
