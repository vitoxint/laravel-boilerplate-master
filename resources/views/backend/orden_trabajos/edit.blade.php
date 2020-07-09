@extends('backend.layouts.app')

@section('title','Ordenes de Trabajo' . ' | ' . 'Editar OT: '. $trabajo->folio)

@section('content')


        <div class="card">
        {{ html()->modelForm($trabajo, 'PATCH', route('admin.orden_trabajos.update', $trabajo))->class('form-horizontal')->acceptsFiles()->open() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Ordenes de Trabajo
                            <small class="text-muted">Editar OT: {{$trabajo->folio}}</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                        <div class="col">

                    <div class="form-group row">
                        {{ html()->label(__('Cliente '))->class('col-md-2 form-control-label')->for('cliente_id') }}

                        <div class="col-md-6">                       
                            
                            {{ html()->text('cliente_id')
                                    ->class('form-control')
                                    ->value('['.$trabajo->cliente->rut_cliente.'] - '. $trabajo->cliente->razon_social)
                                    ->attribute('maxlength', 191)
                                    ->disabled()                                   
                                     }}
                    
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('Contacto cliente'))->class('col-md-2 form-control-label')->for('representante_id') }}

                        <div class="col-md-6">
                            @if($trabajo->representante)
                                                
                            {{ html()->text('representante_id')
                                        ->class('form-control')
                                        ->value($trabajo->representante->nombre)
                                        ->attribute('maxlength', 191)
                                        ->disabled()                                   
                                        }}
                                        
                            @else
              
                            {{ html()->text('representante_id')
                                        ->class('form-control')
                                        ->value('')
                                        ->attribute('maxlength', 191)
                                        ->disabled()                                   
                                        }}              
                            
                            @endif
                                                    
                        </div>
                    </div><!--form-group--> 

                        <div class="form-group row">
                        {{ html()->label('Cotización :')->class('col-md-2 form-control-label')->for('cotizacion') }}

                            <div class="col-md-2">
                                {{ html()->text('cotizacion')
                                    ->class('form-control')
                                    ->placeholder('Cotización referencia (opcional)')
                                    ->attribute('maxlength', 191)                                   
                                     }}
                            </div><!--col-->

                            {{ html()->label('O/C :')->class('col-md-1 form-control-label')->for('orden_compra') }}

                            <div class="col-md-2">
                                {{ html()->text('orden_compra')
                                    ->class('form-control')
                                    ->placeholder('orden compra referencia (opcional)')
                                    ->attribute('maxlength', 191)      
                                    ->autofocus() }}
                            </div><!--col-->  

                            {{ html()->label('Digitador :')->class('col-md-1 form-control-label')->for('user_id') }}

                            <div class="col-md-2">
                            
                                {{ html()->text('user_id')
                                    ->class('form-control')
                                    ->value($trabajo->usuario->first_name .' '.$trabajo->usuario->last_name )
                                    ->disabled()
                                    ->attribute('maxlength', 191)      
                                    ->autofocus() }}
                            </div><!--col-->                          

                            
                        </div><!--form-group-->


                        <div class="form-group row">

                        </div><!--form-group-->                        
  

                        <div class="form-group row">
                            {{ html()->label('Estado cumplimiento')->class('col-md-2 form-control-label')->for('statusOt') }}



                            <div class="col-md-2">
<!-- 
                                {{ html()->select('estado',array('1' => 'Sin iniciar', '2' => 'En proceso', '3' =>'Atrasada', '4' => 'Terminada', '5' => 'Entregada',  '6' => 'Anulada' ), $trabajo->estado)
                                    ->class('form-control')
                                    ->attribute('maxlength', 191) 
                                    ->required()
                                    
                                }} -->
                                <div id="statusOt">

                                @switch($trabajo->estado) 
                                        @case ('1') 
                                            <span class="badge btn-secondary" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> Sin Iniciar </p>  </span>
                                        @break;
                                        @case ('2') 
                                            <span class="badge btn-primary" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> En Proceso </p>  </span>
                                        @break;
                                        @case ('3')
                                            <span class="badge btn-danger" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> Atrasada </p>  </span>
                                        @break;
                                        @case ('4') 
                                            <span class="badge btn-success" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> Terminada </p> </span>
                                        @break;
                                        @case ('5') 
                                            <span class="badge btn-dark" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> Entregada </p>  </span>
                                        @break;
                                        @case ('6') 
                                            <span class="badge btn-warning" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> Anulada </p> </span>
                                        @break;
                                       

                                        @default
                                            {{$item_ot->trabajo->estado}}
                                        @break;                   
                                @endSwitch  
                                </div>


                            </div><!--col-->

                            {{ html()->label('Estado Pago:')->class('col-md-1 form-control-label')->for('statusPagoOt') }}
                            <div class="col-md-2">

                           
                                <div id="statusPagoOt">

                                @switch($trabajo->estado_pago) 
                                       
                                        @case ('1')
                                            <span class="badge btn-danger" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> Pendiente </p>  </span>
                                        @break;
                                        @case ('2') 
                                            <span class="badge btn-warning" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> Abonado </p> </span>
                                        @break;
                                        @case ('3') 
                                            <span class="badge btn-info" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> Pagada </p>  </span>
                                        @break;
                                       

                                        @default
                                            {{$trabajo->estado_pago}}
                                        @break;                   
                                @endSwitch  
                                </div>


                            </div><!--col-->

                            {{ html()->label('N°Factura:')->class('col-md-1 form-control-label')->for('factura') }}

                            <div class="col-md-2">
                                {{ html()->text('factura')
                                    ->class('form-control')
                                    ->placeholder('N°Factura (opcional)')
                                    ->attribute('maxlength', 191)      
                                    ->autofocus() }}
                            </div><!--col--> 


                            
                        </div><!--form-group-->  

                        <div class="form-group row">
                            {{ html()->label('Fecha compromiso entrega :')->class('col-md-2 form-control-label')->for('entrega_estimada') }}

                            <div class="col-md-2">
                                {{ html()->date('entrega_estimada')
                                    ->class('form-control')
                                    ->value($trabajo->entrega_estimada)
                                    ->attribute('maxlength', 191)      
                                    ->autofocus()
                                    
                                    ->required() }}
                            </div><!--col-->

                            {{ html()->label('Fecha inicio :')->class('col-md-1 form-control-label')->for('fecha_inicio') }}

                            <div class="col-md-2">
                                {{ html()->date('fecha_inicio')
                                    ->class('form-control')
                                    ->attribute('maxlength', 191)      
                                    ->autofocus()
                                    
                                     }}
                            </div><!--col-->

                            {{ html()->label('Fecha de termino :')->class('col-md-1 form-control-label')->for('fecha_termino') }}

                            <div class="col-md-2">
                                {{ html()->date('fecha_termino')
                                    ->class('form-control')
                                    ->attribute('maxlength', 191)      
                                    ->autofocus()
                                    
                                     }}
                            </div><!--col-->

                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Valor Neto :')->class('col-md-2 form-control-label')->for('valor_total') }}

                            <div class="col-md-2">
                                {{ html()->text('valor_total')
                                    ->class('form-control')
                                    ->value('$  '. number_format($trabajo->valor_total,0, ',' , '.'  ))                                   
                                    ->attribute('maxlength', 191)
                                    ->disabled()      
                                    ->autofocus()
                                    
                                    ->required() }}
                            </div><!--col-->

                            {{ html()->label('IVA (19%) :')->class('col-md-1 form-control-label')->for('iva') }}

                            <div class="col-md-2">
                                {{ html()->text('iva')
                                    ->class('form-control')
                                    ->value('$  '.number_format(($trabajo->valor_total * 0.19),0, ',' , '.'  ))      
                                    ->attribute('maxlength', 191)  
                                    ->disabled()      
                                    ->autofocus()
                                    
                                     }}
                            </div><!--col-->

                            {{ html()->label('valor Total :')->class('col-md-1 form-control-label')->for('valor_incluido') }}

                            <div class="col-md-2">
                                {{ html()->text('valor_incluido')
                                    ->class('form-control')
                                    ->attribute('maxlength', 191)
                                    ->value('$  '.number_format(($trabajo->valor_total * 1.19),0, ',' , '.'  ))   
                                    ->disabled()        
                                    ->autofocus()
                                    
                                     }}
                            </div><!--col-->

                        </div><!--form-group-->    


                        <div class="form-group row">
                            {{ html()->label('Total abonos :')->class('col-md-2 form-control-label')->for('abonos') }}

                            <div class="col-md-2">
                                {{ html()->text('abonos')
                                    ->class('form-control')
                                    ->value('$  '. number_format($trabajo->abonosOt->sum('monto'),0, ',' , '.'  ))                                   
                                    ->attribute('maxlength', 191)
                                    ->disabled()      
                                    ->autofocus()
                                    
                                    ->required() }}
                            </div><!--col-->

                            {{ html()->label('Saldos :')->class('col-md-1 form-control-label')->for('saldos') }}

                            <div class="col-md-2">
                                {{ html()->text('saldos')
                                    ->class('form-control')
                                    ->value('$  '.number_format(   $trabajo->valor_total * 1.19 - $trabajo->abonosOt->sum('monto')   ,0, ',' , '.' ) )      
                                    ->attribute('maxlength', 191)  
                                    ->disabled()      
                                    ->autofocus()
                                    
                                     }}
                            </div><!--col-->

                        </div><!--form-group-->   



                        </div><!--col-->
                    </div><!--row-->
                </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">

                    <a href="{{ route('admin.orden_trabajos.printCliente', $trabajo) }}" target="_blank" class="btn btn-default btn-sm btn-bordered" data-toggle="tooltip" data-placement="top" title="Imprimir PDF">
                        <i class="fas fa-file-pdf" style="color:red;"></i> Exportar Cliente
                    </a>

                    <a href="{{ route('admin.orden_trabajos.printTaller', $trabajo) }}" target="_blank" class="btn btn-default btn-sm btn-bordered" data-toggle="tooltip" data-placement="top" title="Imprimir PDF">
                        <i class="fas fa-file-pdf" style="color:red;"></i> Exportar Taller
                    </a>

                    <a href="{{ route('admin.orden_trabajos.send', $trabajo) }}" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Enviar OT">
                        <i class="fas fa-envelope" style="color:green;"></i> Enviar 
                    </a> 

                        
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
                        {{ form_cancel(route('admin.orden_trabajos.index'), __('buttons.general.cancel')) }}
                        
                    </div><!--row-->
                </div><!--row-->
            </div><!--card-footer-->

            {{ html()->closeModelForm() }}    
        </div><!--card-->


        <nav>
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-items-tab" data-toggle="tab" href="#nav-items" role="tab" aria-controls="nav-general" aria-selected="true"><i class="fas fa-boxes"> </i> ítems de la Orden de Trabajo</a>
                <!-- <a class="nav-item nav-link" id="nav-rubros-tab" data-toggle="tab" href="#nav-rubros" role="tab" aria-controls="nav-rubros" aria-selected="false">Rubros e ítems</a> -->
                <a class="nav-item nav-link" id="nav-pagos-tab" data-toggle="tab" href="#nav-pagos" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="fas fa-coins"></i> Registro de pagos</a>
                <a class="nav-item nav-link" id="nav-entregas-tab" data-toggle="tab" href="#nav-entregas" role="tab" aria-controls="nav-about" aria-selected="false"><i class="fas fa-truck-loading"></i> Registro de entregas</a>
            </div>
        </nav>
    

<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-items" role="tabpanel" aria-labelledby="nav-items-tab">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Ítems de la Orden de Trabajo <small class="text-muted">Todos los ítems</small>
                        </h4>
                    </div><!--col-->

                    <div class="col-sm-7">
                        @include('backend.item_ots.includes.header-buttons')
                    </div><!--col-->
                </div><!--row-->

                <div class="row mt-4">
                    <div class="col">
                    <div class="table-responsive" id="no-more-tables">
                    <table class="table col-sm-12 table-bordered table-striped table-condensed cf">
                        <thead class="cf">
                                <tr>
                                    <th>Folio</th>
                                    <th>Cantidad</th>
                                    <th>Descripcion</th>                                   
                                    <th>Val. Unitario</th>
                                    <th>Val. Parcial</th>
                                    <th>Avance</th>
                                    <th>Estado</th>       
                                    <th>@lang('labels.general.actions')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($trabajo->items_ot as $item_ot)
                                    <tr>
                                        <td data-title="Folio:">{{ $item_ot->folio }}</td>
                                        <td data-title="Cantidad:">{{ $item_ot->cantidad }}</td>
                                        <td data-title="Descripción:">{{ $item_ot->descripcion }}</td>
                                        <td align="right" data-title="Valor Unitario:">@money($item_ot->valor_unitario )</td>
                                        <td align="right" data-title="Valor Parcial:"> @money($item_ot->valor_parcial ) </td>
                                        
                                        <td data-title="Avance:" align="center">{{$item_ot->avanceItemOt()}}</td>
                                        <td style="text-align:center;" data-title="Estado ítem OT:" id="itemOt{{$item_ot->id}}">
                                            @switch($item_ot->estado)
                                                @case(1)
                                                    <span class="badge btn-secondary" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Sin Iniciar </p></span>
                                                    @break
                                                    
                                                @case(2)
                                                    <span class="badge btn-primary" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> En Proceso </p></span>
                                                    @break
                                                @case(3)
                                                    <span class="badge btn-danger" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Atrasada </p></span>
                                                    @break
                                                @case(4)
                                                    <span class="badge btn-success" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Terminada </p></span>
                                                    @break  
                                                @case(5)
                                                    <span class="badge btn-dark" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Entregada </p></span>
                                                    @break                                  
                                            
                                                @case(6)
                                                    <span class="badge btn-warning" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Anulada </p></span>
                                                    @break   
                                                @default
                                                <span>Something went wrong, please try again</span>
                                            
                                                    
                                            @endswitch
                                        
                                        </td>                               
                                      
                                        <td class="btn-td" data-title="Acciones:">@include('backend.item_ots.includes.actions', ['item_ot' => $item_ot , 'trabajo' => $trabajo])</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!--col-->
                </div><!--row-->
                <div class="row">
                    <div class="col-7">
                        <div class="float-left">
                            {!! $trabajo->items_ot->count() !!} 
                        </div>
                    </div><!--col-->

                    <div class="col-5">
                        <div class="float-right">
                           
                        </div>
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->
        </div><!--card-->
    </div>


    <div class="tab-pane fade" id="nav-pagos" role="tabpanel" aria-labelledby="nav-pagos-tab">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Registro de pagos/abonos
                        </h4>
                    </div><!--col-->

                </div><!--row-->

                <div class="row mt-4 mb-4">
                    <div class="col">

                    <div class="form-group row">

                    <div class="col-md-12">
                        <a style="color:black;" class="btn-btn-default"  data-toggle="collapse" href="#formAbono" role="button" aria-expanded="false" aria-controls="#formAbono">
                            Agregar abono
                        </a>   
                    </div>  
                        

                    </div>

                    <div id="formAbono" class="collapse" >
                    <div class="card card-body">

                        <div class="form-group row" >

                            {{ html()->label('Método pago:')->class('col-md-1 form-control-label')->for('medio_pago') }}

                            <div class="col-md-2">
                                {{ html()->select('medio_pago',array('1' => 'Efectivo', '2' => 'Tarjeta (Transbank)', '3' =>'Transferencia bancaria', '4' => 'Cuenta cliente'),null)
                                    ->class('form-control')
                                    ->attribute('maxlength', 191) 
                                    ->required()
                                    
                                }}
                            </div><!--col-->                        

                            {{ html()->label('Monto $:')->class('col-md-1 form-control-label')->for('monto') }}

                            <div class="col-md-2">
                                {{ html()->text('monto')
                                    ->class('form-control')  
                                    ->value(0)                                                              
                                    ->attribute('maxlength', 191)                                          
                                    ->autofocus()
                                    ->required()                                   
                                    }}
                            </div><!--col-->


                            {{ html()->label('Cuenta cliente:')->class('col-md-1 form-control-label')->for('cuenta_cl') }}

                            

                            <div class="col-md-2">
                                <select id="cuenta_cl" name="cuenta_cl" class="form-control"  >
                                            <option value="" selected>No Aplica</option>
                                        @foreach($trabajo->cliente->cuentaCliente->where('estado_activa',1) as $cuenta)
                                            <option value="{{$cuenta->id}}"> {{$cuenta->nombre}}</option>
                                        @endforeach
                                </select>
                            </div><!--col-->

                            <div class="col col-md-2">
                                <button class="btn btn-dark btn-xs" onclick="añadir_abono()"><i class="fas fa-check"></i> Confirmar abono </button>
                            </div>

                        </div>

                    </div>

                    </div>
                    <div class="col">

                    </div><!--form-group--> 

                    <div class="form-group row" style="">

                        <div class="col-md-12">
                            <div id="abonos" class="table-responsive">
                                <table class='table table-bordered table-hover' id="tab_logic">
                                    <thead>
                                        <tr class='info'>
                                            <th style='width:7%;'hidden="true">ID abono.</th>
                                            <th style='width:16%;'>Fecha</th>        
                                            <th style='width:24%;'>Monto</th>
                                            <th style='width:17%;'>Medio Pago </th>
                                            <th style='width:40%;'>Digitador</th>                                          
                                            <th style='width:13%;'>Acción</th>
                                        </tr>
                                    </thead>
                                    <thead id="dynamic_field2">

                                    @foreach($trabajo->abonosOt as $abono)
                                    <tr id="row2{{$abono->id}}">
                                            <td class="custom-tbl" hidden="true"><input class='form-control input-sm'style='width:100%;' type="text"  value="{{$abono->id}}" id="pr_item{{$abono->id}}" name="pr_item[]" readonly required></td>
                                            <?php $fecha_ab = new Carbon\Carbon($abono->fecha_abono); $fecha_ab = $fecha_ab->format('d-m-Y H:i'); ?>
                                            <td> <p id="fecha_abono{{$abono->id}}" name="abono_id[]"> {{$fecha_ab}} </p></td>  
                                            <td style="text-align:right;"><p  id="monto{{$abono->id}}"  name="monto[]">@money($abono->monto)</p></td>
                                            <td><p  id="medio_pago{{$abono->id}}"  name="medio_pago[]">
                                                @switch($abono->medio_pago)
                                                    @case(1)
                                                        Efectivo
                                                    @break
                                                    @case(2)
                                                        Tarjeta (Transbank)
                                                    @break
                                                    @case(3)
                                                        Transferencia bancaria
                                                    @break
                                                    @case(4)
                                                        Cuenta cliente ({{$abono->cuentaCliente->nombre}})
                                                    @break

                                                @endswitch
                                            
                                            </p></td>

                                            <td><p  id="digitador{{$abono->id}}"  name="digitador[]">{{$abono->encargado->first_name}} {{$abono->encargado->last_name}}</p></td>
                                         
                                            <td class="custom-tbl"><!-- <button type="button" id="{{$abono->id}}" class="btn-info btn-sm btn_add" name="add"><span class="fas fa-sync-alt"></span></button> -->
                                                           
                                                <button type="button" name="remove" id="{{$abono->id}}" class="btn-danger btn-sm btn_remove_abono"><span class="fas fa-times"></span></button>
                                                           
                                            </td>
                                        </tr>
                                    @endforeach
                                                                   
                                    </thead>
                                </table>
                        </div><!--col--></div>

                        </div><!--form-group-->  
                                
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->
        </div><!--card-->
    </div>    

    <div class="tab-pane fade" id="nav-entregas" role="tabpanel" aria-labelledby="nav-entregas-tab">
        <div class="card">
            
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Entregas del trabajo
                           <!--  <small class="text-muted">disponibles</small> -->
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                
                <div class="row mt-4 mb-4">
                    <div class="col">

                    <div class="form-group row">

                    <div class="col-md-12">
                        <a style="color:black;" class="btn-btn-default"  data-toggle="collapse" href="#formEntrega" role="button" aria-expanded="false" aria-controls="#formEntrega">
                            Agregar entrega
                        </a>   
                    </div>  
                        

                    </div>

                    <div class="collapse" id="formEntrega" >
                    <div class="card card-body">

                        <div class="form-group row" >

                            {{ html()->label('Receptor :')->class('col-md-1 form-control-label')->for('receptor') }}

                            <div class="col-md-3">
                                {{ html()->text('receptor')
                                    ->class('form-control')
                                                                
                                    ->attribute('maxlength', 191)                                          
                                    ->autofocus()
                                    ->required()                                   
                                    }}
                            </div><!--col-->

                            {{ html()->label('RUT Receptor:')->class('col-md-1 form-control-label')->for('rut_receptor') }}

                            <div class="col-md-2">
                                {{ html()->text('rut_receptor')
                                    ->class('form-control')                                
                                    ->attribute('maxlength', 12)                                            
                                    ->autofocus()

                                    }}
                            </div><!--col-->

                            {{ html()->label('Fecha:')->class('col-md-1 form-control-label')->for('hora') }}

                            <div class="col-md-3">
                                <div class='input-group date' id='hora' name="hora">
                                <?php $fecha = Carbon\Carbon::now(); $fecha = $fecha->format('d-m-Y H:i'); ?>
                                    <input type='text' class="form-control" required="true" value="{{$fecha}}"/>
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar btn btn-md"></span>
                                    </span>
                                </div>
                            </div><!--col-->

                        </div>

                        <div class="form-group row">

                            {{ html()->label('Agregar ítems')->class('col-md-1 form-control-label')->for('items') }}
                            <div class="col-md-6" >
                                <select name="items[]" id="items" class="form-control" style="width:100%" multiple="multiple" >
                                </select>
                            </div><!--col-->

                            {{ html()->label('N° Guía Despacho:')->class('col-md-1 form-control-label')->for('guia_despacho') }}

                            <div class="col-md-2">
                                {{ html()->text('guia_despacho')
                                    ->class('form-control')                                
                                    ->attribute('maxlength', 12)                                            
                                    ->autofocus()

                                    }}
                            </div><!--col-->

                    
                            <div class="col col-md-2">
                                <button class="btn btn-dark btn-xs" onclick="añadir_entrega()"><i class="fas fa-check"></i> Registrar </button>
                            </div>

                        </div>
                    </div>

                    </div>
                    <div class="col">

                    </div><!--form-group--> 

                    <div class="form-group row" style="">

                        <div class="col-md-12">
                            <div id="entregas" class="table-responsive">
                                <table class='table table-bordered table-hover' id="tab_logic">
                                    <thead>
                                        <tr class='info'>
                                            <th style='width:7%;'hidden="true">ID entrega.</th>
                                            <th style='width:16%;'>Fecha</th>        
                                            <th style='width:24%;'>Receptor</th>
                                            <th style='width:15%;'>Encargado </th>
                                            <th style='width:10%;'>N° Guía Desp. </th>

                                            <th style='width:40%;'>Ítems</th>
                                           
                                            <th style='width:13%;'>Acción</th>
                                        </tr>
                                    </thead>
                                    <thead id="dynamic_field">

                                    @foreach($trabajo->entregasOt as $entrega)
                                    <tr id="row{{$entrega->id}}">
                                            <td class="custom-tbl" hidden="true"><input class='form-control input-sm'style='width:100%;' type="text"  value="{{$entrega->id}}" id="pr_item{{$entrega->id}}" name="pr_item[]" readonly required></td>
                                            <?php $fecha_en = new Carbon\Carbon($entrega->hora_entrega); $fecha_en = $fecha_en->format('d-m-Y H:i'); ?>
                                            <td> <p id="hora_entrega{{$entrega->id}}" name="entrega_id[]"> {{$fecha_en}} </p></td>  
                                            <td><p  id="receptor{{$entrega->id}}"  name="receptor[]">[{{$entrega->rut_receptor}}]-{{$entrega->receptor}}</p></td>
                                            <td><p  id="encargado{{$entrega->id}}"  name="encargado[]">{{$entrega->encargado->first_name}} {{$entrega->encargado->last_name}}</p></td>
                                            <td style="text-align:center;"><p  id="guia{{$entrega->id}}"  name="guia[]">{{$entrega->guia_despacho}} </p></td>

                                            <td id="items{{$entrega->id}}"  name="items[]"> 
                                              @foreach($entrega->entregasItemOt as $itemEntrega)
                                                <span><p>[{{$itemEntrega->item_ot->folio}}]-{{$itemEntrega->item_ot->descripcion}}</p><span>
                                              @endforeach                                            
                                            </td>
                                         
                                            <td class="custom-tbl"><!-- <button type="button" id="{{$entrega->id}}" class="btn-info btn-sm btn_add" name="add"><span class="fas fa-sync-alt"></span></button> -->
                                                           
                                                <button type="button" name="remove" id="{{$entrega->id}}" class="btn-danger btn-sm btn_remove_entrega"><span class="fas fa-times"></span></button>
                                                           
                                            </td>
                                        </tr>
                                    @endforeach
                                                                   
                                    </thead>
                                </table>
                        </div><!--col-->

                        </div><!--form-group-->  
                                
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                       
                    </div><!--col-->

                    <div class="col text-right">
                        
                    </div><!--row-->
                </div><!--row-->
            </div><!--card-footer-->

           
        </div><!--card-->


    </div>
</div>
        


</div>



  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" /> -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>

  <script src="{{asset('datepicker/js/bootstrap-datetimepicker.js')}}"></script>
  <script src="{{asset('datepicker/js/moments.js')}}"></script>

  
  <script src="{{asset('js/jquery.rut.js')}}" ></script>

    <script>

        $("#rut_receptor")
        .rut({formatOn: 'keyup', validateOn: 'keyup'})
        .on('rutInvalido', function(){ 
            $(this).parents(".control-group").addClass("error")
        })
        .on('rutValido', function(){ 
            $(this).parents(".control-group").removeClass("error")
        });

    </script>


    <script>

        $(document).ready(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
            $('#hora').datetimepicker({
                // Formats
                // follow MomentJS docs: https://momentjs.com/docs/#/displaying/format/
                format: 'DD-MM-YYYY HH:mm',
                locale: 'es',
                
                // Your Icons
                // as Bootstrap 4 is not using Glyphicons anymore
                icons: {
                    time: 'fa fa-clock-o',
                    date: 'fa fa-calendar',
                    up: 'fa fa-chevron-up',
                    down: 'fa fa-chevron-down',
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-check',
                    clear: 'fa fa-trash',
                    close: 'fa fa-times'
                }
            });
        }); 

    </script>


    <script>
        $.fn.select2.defaults.set('language', 'es');
        
        $('#items').select2({
            placeholder: "Seleccionar ítem a entregar...",
            minimumInputLength: 1,
            ajax: {
                url: "{{route('admin.item_ots.dataAjax')}}?id="+ <?php echo $trabajo->id ?>,
                dataType: 'json',
                language: "es",
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };                   
                },
                cache: true
            },           
        });



        function añadir_entrega(){
  
            var ot_id =  <?php echo $trabajo->id; ?>;
            var receptor = $('#receptor').val();
            var rut_receptor = $("#rut_receptor").val();
            var hora = $("#hora").find("input").val();
            var items = $("#items").val();
            var guia_despacho = $("#guia_despacho").val();

            //if((itemslength != 0)&&(receptor != "")&&(hora != "")){

                $.ajax({
                type:'POST',
                url:'{{route("admin.entrega_ot.store")}}',
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                data:{ ot_id:ot_id, receptor:receptor, rut_receptor:rut_receptor ,hora:hora , items:items , guia_despacho:guia_despacho },
                success:function(data){
                    //alert(data.success);
                    $('#dynamic_field').append(
                        '<tr id="row'+data.id+'">'+
                                           ' <td class="custom-tbl" hidden="true"><input class="form-control input-sm" style="width:100%;" type="text"  value="'+data.id+'" id="pr_item'+data.id+'" name="pr_item[]" readonly required></td>'+
                                            ' <td> <p id="hora_entrega'+data.id+'" name="entrega_id[]">'+ data.hora_entrega+' </p></td>'  +
                                            ' <td> <p  id="receptor'+data.id+'"  name="receptor[]"> ['+ data.rut_receptor+']-'+data.receptor + '</p></td>'+
                                            ' <td> <p  id="encargado'+data.id+'"  name="encargado[]">'+data.encargado+'</p></td>'+

                                            ' <td style="text-align:center;"><p  id="guia'+data.id+'"  name="guia[]">'+data.guia_despacho+' </p></td>' + 

                                            ' <td id="items'+data.id+'"  name="items[]"> '+data.items+'</td>'+
  
                                            ' <td class="custom-tbl"><!-- <button type="button" id="" class="btn-info btn-sm btn_add" name="add"><span class="fas fa-sync-alt"></span></button> -->'+
                                                           
                                            '     <button type="button" name="remove" id="'+data.id+'" class="btn-danger btn-sm btn_remove"><span class="fas fa-times"></span></button>  </td></tr>'
                      );

                      $("#guia_despacho").val(''); 
                      $("#receptor").val();
                      $("#rut_receptor").val();


                      for (var i=0; i< data.items_id.length; i++)
                            {
                                var id= data.items_id[i];
                                //Para obtener el objeto de tu lista
                                $("#itemOt"+id).html('<span class="badge btn-dark" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Entregado </p>  </span>');
                                
                            }    

                      if(data.estado_ot == '5'){
                              $("#statusOt").html('<span class="badge btn-dark" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> Entregada </p>  </span>');
                              $("#estado").val('5');
                      }    

                      $("#items").empty();   
                
                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }

                });
            /* }else{
                alert('Faltan datos a ingresar');
            } */


        }




        $(document).on('click', '.btn_remove_entrega', function(){  
            var button_id = $(this).attr("id");

            $.ajax({
            type:'POST',
            url:'{{route("admin.entrega_ot.destroy")}}',
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            data:{item:button_id},
            success:function(data){
                
                $('#row'+button_id+'').remove(); 

                for (var i=0; i< data.array.length; i++)
                {
                    var id= data.array[i];
                    //Para obtener el objeto de tu lista
                    $("#itemOt"+id).html('<span class="badge btn-success" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Terminado </p>  </span>');
                    
                }

                $("#statusOt").html('<span class="badge btn-success" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> Terminada </p>  </span>');
                    $("#estado").val('4');  

                    //console.log(data.success);
                     
            },
            error: function() {
                console.log("No se ha podido obtener la información");
            }

            });                      
            
        });  

    </script>


    <script type="text/javascript">

        var formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
        });

   
        function añadir_abono(){
        
        var ot_id =  <?php echo $trabajo->id; ?>;
        var valor = $('#monto').val();
        var medio_pago = $("#medio_pago").val();
        var cuenta_cl = $("#cuenta_cl").val();
        

       

            $.ajax({
            type:'POST',
            url:'{{route("admin.pago_ot.store")}}',
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            data:{ ot_id:ot_id, valor:valor, medio_pago:medio_pago ,cuenta_cl:cuenta_cl  },
            success:function(data){
                //alert(data.success);

                var monto_abono = data.monto;
                var numFinal = parseFloat(monto_abono);
                $('#dynamic_field2').append(
                    '<tr id="row2'+data.id+'">'+
                                        ' <td class="custom-tbl" hidden="true"><input class="form-control input-sm" style="width:100%;" type="text"  value="'+data.id+'" id="pr_item'+data.id+'" name="pr_item[]" readonly required></td>'+
                                        ' <td> <p id="fecha_abono'+data.id+'" name="abono_id[]">'+ data.fecha_abono+' </p></td>'  +
                                        ' <td style="text-align:right;"> <p  id="monto'+data.id+'"  name="monto[]"> '+ formatter.format(numFinal.toFixed(2)) +'</p></td>'+
                                        ' <td> <p  id="medio_pago'+data.id+'"  name="medio_pago[]">'+data.medio_pago+'</p></td>'+

                                        ' <td id="items'+data.id+'"  name="encargado[]"> '+data.encargado+'</td>'+

                                        ' <td class="custom-tbl"><!-- <button type="button" id="" class="btn-info btn-sm btn_add" name="add"><span class="fas fa-sync-alt"></span></button> -->'+
                                                        
                                        '     <button type="button" name="remove" id="'+data.id+'" class="btn-danger btn-sm btn_remove_abono"><span class="fas fa-times"></span></button>  </td></tr>'
                    ); 

                    var total_abono = data.abonos;
                    var abonoFinal = parseFloat(total_abono);

                    var total_saldo = data.saldos;
                    var saldoFinal = parseFloat(total_saldo);

                    $("#abonos").val(formatter.format(abonoFinal.toFixed(0)));
                    $("#saldos").val(formatter.format(saldoFinal.toFixed(0)));
                    $('#monto').val('');

                    if(data.estado_pago == '3'){
                              $("#statusPagoOt").html('<span class="badge btn-info" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> Pagado </p>  </span>');
                              //$("#estado").val('7');
                      }   

                    if(data.estado_pago == '2'){
                            $("#statusPagoOt").html('<span class="badge btn-warning" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> Abonado </p>  </span>');
                            //$("#estado").val('7');
                    } 
           
            },

            error: function() {
                console.log("No se ha podido obtener la información");
            }

            });
      


        }



        $(document).on('click', '.btn_remove_abono', function(){  
            var button_id = $(this).attr("id");

            $.ajax({
            type:'POST',
            url:'{{route("admin.pago_ot.destroy")}}',
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            data:{item:button_id},
            success:function(data){
                
                $('#row2'+button_id+'').remove(); 


                if(data.estado_pago == 2){
                    $("#statusPagoOt").html('<span class="badge btn-warning" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> Abonada </p>  </span>');
                }   
                if(data.estado_pago == 1){
                    $("#statusPagoOt").html('<span class="badge btn-danger" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> Pendiente </p>  </span>');
                } 

                var total_abono = data.abonos;
                var abonoFinal = parseFloat(total_abono);

                var total_saldo = data.saldos;
                var saldoFinal = parseFloat(total_saldo);

                $("#abonos").val(formatter.format(abonoFinal.toFixed(0)));
                $("#saldos").val(formatter.format(saldoFinal.toFixed(0)));                   
                     
            },
            error: function() {
                console.log("No se ha podido obtener la información");
            }

            });                      
            
        }); 
    </script>




@endsection