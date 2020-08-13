@extends('backend.layouts.app')


@section('title','Item OT: '.$trabajo->folio . ' | ' . $item_ot->folio)

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>



<style type="text/css">
    .fileinput-remove,
    .fileinput-upload{
        display: none;

    },
    

</style>

        <?php 

        if( '\App\TrabajoUseMaterial'::all()->count() == 0){
            $max_id = 1;
            
        }else{
            $max_id = '\App\TrabajoUseMaterial'::all()->max('id') + 1;
        } ?>  



        <div class="card">
        {{ html()->modelForm($item_ot, 'PATCH', route('admin.item_ots.update', ['item_ot' => $item_ot, 'trabajo' =>  $trabajo]))->class('form-horizontal')->acceptsFiles()->open() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            
                            <small class="text-muted">Editar item: {{$item_ot->folio}}</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                        <div class="col">
                        <div class="form-group row">
                            {{ html()->label('Descripción *')->class('col-md-2 form-control-label')->for('descripcion') }}

                            <div class="col-md-10">
                                {{ html()->textarea('descripcion')
                                    ->class('form-control')
                                    ->placeholder('Descripción principal')
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label('Valor :')->class('col-md-2 form-control-label')->for('') }}
                        
                        {{ html()->label('Cantidad:')->class('col-md-1 form-control-label')->for('cantidad') }}
                            <div class="col-md-1">
                                {{ html()->text('cantidad')
                                    ->class('form-control')
                                    ->value($item_ot->cantidad)
                                    ->attribute('maxlength', 191)                          
                                    ->required() }}
                            </div><!--col-->
                            {{ html()->label('Valor Unitario:')->class('col-md-1 form-control-label')->for('valor_unitario') }}
                            <div class="col-md-2">
                                {{ html()->text('valor_unitario')
                                    ->class('form-control')
                                    ->value($item_ot->valor_unitario)
                                    ->attribute('maxlength', 191)                                   
                                    ->required() }}
                            </div><!--col-->
                            {{ html()->label('Valor Parcial:')->class('col-md-1 form-control-label')->for('valor_parcial') }}
                            <div class="col-md-2">
                                {{ html()->text('valor_parcial')
                                    ->class('form-control')
                                    ->value($item_ot->valor_parcial)
                                    ->attribute('maxlength', 191)                                   
                                     }}
                            </div><!--col-->
                        </div><!--form-group-->


                        <div class="form-group row">
                            {{ html()->label('Detalle y especificaciones')->class('col-md-2 form-control-label')->for('descripcion') }}

                            <div class="col-md-10">
                                {{ html()->textarea('especificaciones')
                                    ->class('form-control')
                                    ->placeholder('información adicional')
                                    ->attribute('maxlength', 191)
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label('Cumplimiento ')->class('col-md-2 form-control-label')->for('') }}

                        {{ html()->label('Estado  :')->class('col-md-1 form-control-label')->for('estado') }}
                            <div class="col-md-2">

                                {{ html()->select('estado',array('1' => 'Sin iniciar', '2' => 'En proceso', '3' =>'Atrasada', '4' => 'Terminada', '5' => 'Entregada',  '6' => 'Anulada'), $item_ot->estado)
                                    ->class('form-control')
                                    ->attribute('maxlength', 191) 
                                    ->required()
                                    
                                }}                           

                                @switch($item_ot->estado) 
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
                                  

                            </div><!--col-->

                            {{ html()->label('Fecha inicio :')->class('col-md-1 form-control-label')->for('fecha_inicio') }}

                            <div class="col-md-2">
                                {{ html()->date('fecha_inicio')
                                    ->class('form-control')
                                    ->value($item_ot->fecha_inicio) 
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

                        {{ html()->label('Costos ')->class('col-md-2 form-control-label')->for('') }}   

                            {{ html()->label('C. Procesos :')->class('col-md-1 form-control-label')->for('cprocesos') }}

                            <div class="col-md-2">
                                {{ html()->text('cprocesos')
                                    ->class('form-control')
                                    ->value('$  '. number_format($item_ot->procesosOt->sum('valor_proceso'),0, ',' , '.'  ))                                   
                                    ->attribute('maxlength', 191)
                                    ->disabled()      
                                    ->autofocus()
                                    
                                    ->required() }}
                            </div><!--col-->

                            {{ html()->label('C. Materiales :')->class('col-md-1 form-control-label')->for('cmateriales') }}

                            <div class="col-md-2">
                                {{ html()->text('cmateriales')
                                    ->class('form-control')
                                    ->value('$  '.number_format( ($item_ot->materialOt->sum('valor_total') + $item_ot->solicitudMaterialOt->sum('valor_total')),0, ',' , '.'  ))            
                                    ->attribute('maxlength', 191)  
                                    ->disabled()      
                                    ->autofocus()
                                    
                                     }}
                            </div><!--col-->

                            {{ html()->label('Δ Margen:')->class('col-md-1 form-control-label')->for('cdelta') }}

                            <div class="col-md-2">
                                {{ html()->text('cdelta')
                                    ->class('form-control')
                                    ->attribute('maxlength', 191)
                                    ->value('$  '.number_format( $item_ot->valor_parcial - ( $item_ot->procesosOt->sum('valor_proceso') + $item_ot->materialOt->sum('valor_total') + $item_ot->solicitudMaterialOt->sum('valor_total'))  ,0, ',' , '.'  ))    
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
                    <a style="color:white;" href="{{ route('admin.item_ots.print_etq', [$item_ot,$item_ot->ordenTrabajo]) }}" target="_blank" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Imprimir PDF">
                        <i class="fas fa-print" style="color:white;"></i> Etiqueta
                    </a>                    
                        {{ form_cancel(route('admin.orden_trabajos.edit',$item_ot->ordenTrabajo), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
                    </div><!--row-->
                </div><!--row-->
            </div><!--card-footer-->

            {{ html()->closeModelForm() }}    
        </div><!--card-->

<nav>
    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
        <a class="nav-item nav-link" id="nav-adjuntos-tab" data-toggle="tab" href="#nav-adjuntos" role="tab" aria-controls="nav-adjuntos" aria-selected="true"><i class="fas fa-photo-video"> </i> Archivos adjuntos</a>
        <!-- <a class="nav-item nav-link" id="nav-rubros-tab" data-toggle="tab" href="#nav-rubros" role="tab" aria-controls="nav-rubros" aria-selected="false">Rubros e ítems</a> -->
        <a class="nav-item nav-link active" id="nav-procesos-tab" data-toggle="tab" href="#nav-procesos" role="tab" aria-controls="nav-procesos" aria-selected="false"><i class="fas fa-tasks"></i> Procesos y tareas</a>
        <a class="nav-item nav-link" id="nav-materiales-tab" data-toggle="tab" href="#nav-materiales" role="tab" aria-controls="nav-materiales" aria-selected="false"><i class="fas fa-pallet"></i> Utilización de materiales</a>
    </div>
</nav>

<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
    <div class="tab-pane fade" id="nav-materiales" role="tabpanel" aria-labelledby="nav-materiales-tab">
        <div class="card">
            <div class="card-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <h4 class="card-title mb-0">
                                
                                <small class="text-muted">Utilización de materiales</small>
                            </h4>
                        </div><!--col-->
                    </div><!--row-->
                    <hr>


                <div class="row mt-0 mb-4">

                        <div class="col border border-secondary">


                        <hr/>

                        <div class="form-group row">
                            {{ html()->label(__('Seleccionar material *'))->class('col-md-2 form-control-label')->for('material_id') }}

                            <div class="col-md-4">                       
                                <select id="material_id" name="material_id" style="width:100%;" class="form-control" >                                       
                                </select>

                                
                        
                            </div><!--col-->
                            <div class="col col-sm-2"><button class="btn btn-success btn-sm" onclick="calcular()"><i class="fas fa-calculator"></i> Calcular </button>
                            <button class="btn btn-primary btn-sm" onclick="editar()"><i class="fas fa-edit"></i> Editar </button></div>
                        </div><!--form-group-->

                        <div class="form-group row" style="padding-top:10px;">

                                {{ html()->label('Ingresar dimensiones :')->class('col-md-2 form-control-label')->for('') }}

                                {{ html()->label('Largo (mm):')->class('col-md-1 form-control-label')->for('largo') }}

                                <div class="col-md-1">
                                    {{ html()->text('largo')
                                        ->class('form-control')
                                                                    
                                        ->attribute('maxlength', 191)                                          
                                        ->autofocus()                                   
                                        }}
                                </div><!--col-->

                                {{ html()->label('Ancho (mm):')->class('col-md-1 form-control-label')->for('ancho') }}

                                <div class="col-md-1">
                                    {{ html()->text('ancho')
                                        ->class('form-control')
                                        
                                        ->attribute('maxlength', 191)                                            
                                        ->autofocus()

                                        }}
                                </div><!--col-->

                                <div class="col col-sm-2"><button id="agregar" class="btn btn-dark btn-sm" onclick="agregar()"><i class="fas fa-arrow-down"></i> Agregar </button>
                                </div>

                        </div><!--form-group-->    

                        <div class="form-group row" style="padding-top:10px;">
                                {{ html()->label('Resultados :')->class('col-md-2 form-control-label')->for('') }}

                                {{ html()->label('Volumen (Lts):')->class('col-md-1 form-control-label')->for('volumen') }}

                                <div class="col-md-2">
                                    {{ html()->text('volumen')
                                        ->class('form-control')
                                        ->disabled()                          
                                        ->attribute('maxlength', 191)                                          
                                        ->autofocus()                                   
                                        }}
                                </div><!--col-->

                                {{ html()->label('Masa (Kg):')->class('col-md-1 form-control-label')->for('masa') }}

                                <div class="col-md-2">
                                    {{ html()->text('masa')
                                        ->class('form-control')
                                        ->value(0)
                                        ->disabled()
                                        ->attribute('maxlength', 191)                                            
                                        ->autofocus()

                                        }}
                                </div><!--col-->

                                {{ html()->label('Valor total:')->class('col-md-1 form-control-label')->for('valor') }}
                                <div class="col-md-2">
                                    {{ html()->text('valor')
                                        ->class('form-control')
                                        ->value(0)
                                        ->disabled()
                                        ->attribute('maxlength',
                                            191)                                            
                                        ->autofocus()

                                        }}
                                </div><!--col-->

                                <input type="text" id="valor2" hidden="true" />

                        </div><!--form-group-->  

                                                

                        </div><!--col-->
                    </div><!--row-->



                    <div class="row">

                    <div id="materiales" class="table-responsive">
                        <table class='table table-bordered table-hover' id="tab_logic">
                            <thead>
                                <tr class='info'>
                                    <th style='width:7%;'hidden="true">Item NO.</th>
                                    <th style='width:41%;'>Material</th>
                                    
                                    <th style='width:9%;'>Largo</th>
                                    <th style='width:9%;'>Ancho</th>
                                    <th style='width:12%;'>V.unitario</th>
                                    <th style='width:12%;'>V.parcial</th>
                                    <th style='width:9%; align-text:center'>Estado</td>
                                    <th style='width:10%;'>Acción</th>
                                </tr>
                            </thead>
                            <thead id="dynamic_field">
                           
                            @foreach($item_ot->materialOt as $materialA)
                            <tr id="row{{$materialA->id}}">
                                    <td class="custom-tbl" hidden="true"><input class='form-control input-sm'style='width:100%;' type="text"  value="{{$materialA->id}}" id="pr_item{{$materialA->id}}" name="pr_item[]" readonly required></td>
                                    <td class="custom-tbl"><input class='form-control input-sm' style='width:100%;' type="text" value="{{$materialA->material->material}}" id="material_id{{$materialA->id}}" oninput='multiply("{{$materialA->id}}");' name="material_id[]">
                                                           <!--  <select id="material_id{{$materialA->id}}" name="material_id[]" class="form-control" >    </select>  -->
                                    </td>    
                                    <td><input class='form-control input-sm' style='width:100%;' type="text" value="{{$materialA->dimension_largo}}" id="pr_largo{{$materialA->id}}" oninput='multiply(0);' name="pr_largo[]"></td>
                                    <td><input class='form-control input-sm' style='width:100%;' type="text" value="{{$materialA->dimension_ancho}}" id="pr_ancho{{$materialA->id}}" oninput='multiply(0);' name="pr_ancho[]"></td>
                                    <td><input class='form-control input-sm' style='width:100%;' type="text" value="{{$materialA->valor_unit}}" id="pr_unit{{$materialA->id}}" oninput='multiply(0);' name="pr_unit[]"></td>
                                    <td class="custom-tbl" ><input class='estimated_cost form-control input-sm' style="text-align:right;" value="@money($materialA->valor_total)" id="pr_cpi{{$materialA->id}}" value="{{$materialA->valor_parcial}}" style='width:100%;' type="text" name="pr_cpi[]" readonly></td>
                                    <td id="status{{$materialA->id}}" style="text-align:center;"> 
                                    @switch($materialA->estado)
                                        @case(1)
                                        <span class="badge btn-secondary" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> En espera </p>  </span>
                                        @break
                                        @case(2)
                                        <span class="badge btn-success" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Disponible </p>  </span>
                                        @break
                                        @case(3)
                                        <span class="badge btn-dark" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Utilizado </p>  </span>
                                        @break
                                    @endswitch

                                    </td>
                                    <td class="custom-tbl"><!-- <button type="button" id="{{$materialA->id}}" class="btn-info btn-sm btn_add" name="add"><span class="fas fa-sync-alt"></span></button> -->
                                                           <!--<button type="button" name="remove" id="{{$materialA->id}}" class="btn-danger btn-sm btn_remove"><span class="fas fa-times"></span></button> -->
                                                           <button type="button" title="Consumir" name="consumir" id="{{$materialA->id}}" class="btn-dark btn-sm btn_use"><span class="fas fa-arrow-down"></span></button>
                                    </td>
                                </tr>
                            @endforeach


                            @foreach($item_ot->solicitudMaterialOt as $materialP)
                            <tr id="row{{$materialP->id}}">
                                    <td class="custom-tbl" hidden="true"><input class='form-control input-sm'style='width:100%;' type="text"  value="{{$materialP->id}}" id="pr_item{{$materialP->id}}" name="pr_item[]" readonly required></td>
                                    <td class="custom-tbl"><input class='form-control input-sm' style='width:100%;' type="text" value="{{$materialP->material->material}}" id="material_id{{$materialP->material->id}}" oninput='multiply("{{$materialP->id}}");' name="material_id[]">
                                                           <!--  <select id="material_id{{$materialP->id}}" name="material_id[]" class="form-control" >    </select>  -->
                                    </td>    
                                    <td><input class='form-control input-sm' style='width:100%;' type="text" value="{{$materialP->dimension_largo}}" id="pr_largo{{$materialP->id}}" oninput='multiply(0);' name="pr_largo[]"></td>
                                    <td><input class='form-control input-sm' style='width:100%;' type="text" value="{{$materialP->dimension_ancho}}" id="pr_ancho{{$materialP->id}}" oninput='multiply(0);' name="pr_ancho[]"></td>
                                    <td><input class='form-control input-sm' style='width:100%;' type="text" value="{{$materialP->valor_unit}}" id="pr_unit{{$materialP->id}}" oninput='multiply(0);' name="pr_unit[]"></td>
                                    <td class="custom-tbl" ><input class='estimated_cost form-control input-sm' style="text-align:right;" value="@money($materialP->valor_total)" id="pr_cpi{{$materialP->id}}" value="{{$materialP->valor_parcial}}" style='width:100%;' type="text" name="pr_cpi[]" readonly></td>
                                    <td> 
                                    @switch($materialP->estado)
                                        @case(1)
                                        <span class="badge btn-secondary" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> En espera </p>  </span>
                                        @break
                                        @case(2)
                                        <span class="badge btn-success" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Disponible </p>  </span>
                                        @break
                                        @case(3)
                                        <span class="badge btn-dark" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Utilizado </p>  </span>
                                        @break
                                    @endswitch

                                    </td>
                                    <td class="custom-tbl"><!-- <button type="button" id="{{$materialP->id}}" class="btn-info btn-sm btn_add" name="add"><span class="fas fa-sync-alt"></span></button> -->
                                                           <button type="button" name="remove" id="{{$materialP->id}}" class="btn-danger btn-sm btn_remove"><span class="fas fa-times"></span></button>
                                    </td>
                                </tr>
                            @endforeach

                            </thead>
                            <tbody >

                            </tbody>
                            <tfoot>
                                <tr class='info'>
                                    <td style='width:60%;text-align:right;padding:4px;' colspan='4'>Total Neto: $</td>
                                    <td style='padding-right:0px;'>

                                            <input style='width:100%; text-align:right;' type='text' class='form-control input-sm'  id='valor_total' name='valor_total' value="@money($item_ot->materialOt->sum('valor_total'))" readonly required>

                                    </td></tr>

                            </tfoot>

                        </table>
         
                    </div>  </div>                

            </div><!--card-body-->
            <div class="card-footer clearfix">                 
            </div><!--card-footer-->                
        </div><!--card-->
    </div>

    <div class="tab-pane fade show active" id="nav-procesos" role="tabpanel" aria-labelledby="nav-procesos-tab">

        <div class="card">
                <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            <small class="text-muted"> Etapas del trabajo</small>
                        </h4>
                    </div><!--col-->
                    <div class="col-sm-7">
                        @include('backend.etapa_itemots.includes.header-buttons')
                    </div><!--col-->
                </div><!--row-->

                <div class="row mt-4">
                    <div class="col">
              
                    <div class="table-responsive" id="no-more-tables">
                            <table class="table col-sm-12 table-bordered table-striped table-condensed cf">
                                <thead class="cf">
                                <tr>
                                    <th style="width:35px;">Código</th>
                                    <th>Proceso</th>
                                    <th>Máquina</th>
                                    <!-- <th>Operador</th> -->
                                    <th>Hora estimada termino</th>
                                    <th>Cantidad/Tiempo</th>
                                    <!-- <th>Hora inicio</th> -->
                                    <th>Valor proceso</th>
                                    <th>Estado</th>
                                    
                                    <!-- <th>Hora termino </th> -->

                                    <th style="width:45px;">@lang('labels.general.actions')</th>
                                </tr>
                                </thead>
                                <tbody id="table-procesos">


                                @foreach($item_ot->procesosOt as $etapaItemOt)
                                    <tr>
                                        <td data-title="Codigo:">{{ $etapaItemOt->codigo }}</td>
                                        <td data-title="Proceso:">{{ $etapaItemOt->proceso->descripcion }}</td>
                                        <td data-title="Maquina:">{{ $etapaItemOt->maquina->codigo }}</td>
                                        <!-- <td data-title="Operador:"></td> -->
                                                <?php $flimite= new Carbon\Carbon($etapaItemOt->fh_limite);
                                                    $flimite = $flimite->format('d-m-Y h:i'); ?>
                                        <td date-title="Hora planificada">{{$flimite}}</td>
                                        <td date-tittle="Cantidad/Tiempo">
                                        @switch($etapaItemOt->proceso->tipo_valorizacion)
                                            @case('1')
                                               {{$etapaItemOt->tiempo_asignado}} hora/s
                                            @break
                                            @case('2')
                                               {{$etapaItemOt->cantidad}} Kg
                                            @break
                                            @case('3')
                                            {{$etapaItemOt->cantidad}} operacion/es
                                            @break
                                        @endswitch                                        
                                        
                                        </td>

                                                <?php $finicio= new Carbon\Carbon($etapaItemOt->fh_inicio);
                                                    $finicio = $finicio->format('d-m-Y h:i'); ?>
                                        <!-- <td data-title="Hora Inicio">{{$finicio}}</td> -->
                                        <td data-title="Valor proceso" style="text-align:right;">@money($etapaItemOt->valor_proceso)</th>
                                        <td data-title="Estado" style="text-align:center;">
                                            @switch($etapaItemOt->estado_avance) 
                                            @case ('1') 
                                               <span class="badge btn-secondary" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Sin Iniciar </p></span>
                                            @break;
                                            @case ('2') 
                                                <span class="badge btn-primary" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> En Proceso </p></span>
                                            @break;
                                            @case ('3')
                                                <span class="badge btn-danger" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Atrasada </p></span>
                                            @break;
                                            @case ('4') 
                                                <span class="badge btn-success" style="border-radius:10px;"> <p style="color:white; margin:3px; font-size:12px;"> Terminada </p></span>
                                            @break;
                                            @case ('5') 
                                                <span class="badge btn-dark" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Detenida </p></span>
                                            @break;
                                            @case ('6') 
                                                <span class="badge btn-warning" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Anulada </p></span>
                                            @break;

                                            @default
                                                {{$etapaItemOt->estado_avance}}
                                            @break;                     
                                            @endSwitch 
                                        </td>
                                         <!--        <?php $ftermino= new Carbon\Carbon($etapaItemOt->fh_termino);
                                                      $ftermino = $ftermino->format('d-m-Y h:i'); ?>                                       
                                        <td data-title="Hora Termino">{{$ftermino}}</td> -->

                                        <td data-title="Acciones" class="btn-td">@include('backend.etapa_itemots.includes.actions', ['etapaItemOt' => $etapaItemOt])</td>
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
                            {!! $item_ot->procesosOt->count() !!} 
                        </div>
                    </div><!--col-->

                    <div class="col-5">
                        <div class="float-right">
                        </div>
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">                        
                </div><!--card-footer-->   
        </div><!--card-->  

    </div> 

    
    
    <div class="tab-pane fade" id="nav-adjuntos" role="tabpanel" aria-labelledby="nav-adjuntos-tab">

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            
                            <small class="text-muted">Galería de Archivos Adjuntos</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->
                <hr>

                    <div class="row">

                        <div class="col-lg-12 col-sm-12 col-12 ">
                           
                                {!! csrf_field() !!}
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">

                                    <div class="file-loading">
                                        <input id="file-1" type="file" name="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="2">
                                    </div>

                                </div>                            
                        </div>
              
                    </div>                  

            </div><!--card-body-->

            <div class="card-footer clearfix">                 
            </div><!--card-footer-->  

        </div><!--card-->
    </div>

</div>

</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

$('#cantidad').on('change', function() {
 
  var total = parseFloat($('#valor_unitario').val())*parseFloat(this.value);
  $('#valor_parcial').val(total);
  
});

$('#valor_unitario').on('change', function() {
  
  var total = parseFloat($('#cantidad').val())*parseFloat(this.value);
  $('#valor_parcial').val(total);
  
});


</script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/locales/es.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" type="text/javascript"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.0.11/purify.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.7.7/xlsx.core.min.js"></script>

<!-- JS, Popper.js, and jQuery -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>




<script type="text/javascript">

var urls = [];
    <?php foreach($item_ot->imagenes as $imagen){ ?>
          urls.push("<?php echo asset('storage/' . $imagen->url);?>");
                   
    <?php } ?>

    $("#file-1").fileinput({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        theme: 'fa',
        showCaption: true,
        showPreview: true,
        showUpload: true,
        showRemove: false,
        
        initialPreview: urls,
        initialPreviewFileType: 'image', // image is the default and can be overridden in config below
        initialPreviewAsData: true,
       
        initialPreviewConfig: [

            <?php foreach($item_ot->imagenes as $imagen){ ?>
             <?php 
                $infoPath = pathinfo(asset('storage/'. $imagen->url));
                $extension = $infoPath['extension']; 
             ?>

             { type: "<?php echo $imagen->extension;?>" , size: "<?php echo $imagen->size;?>",  caption: "<?php echo $imagen->image_name;?>", url: "{{route('admin.imagen_itemot.destroy')}}?key="+"<?php echo $imagen->id;?>"  , downloadUrl:"<?php echo asset('storage/'. $imagen->url);?>" , key: "<?php echo $imagen->id;?>" ,extra: {id:"<?php echo $imagen->id;?>"} },
            
            <?php } ?>
        ],
        uploadUrl: "{{route('admin.imagen_itemot.store')}}?itemot_id=" + "<?php echo $item_ot->id; ?>" ,
        uploadExtraData: function() {
            return {
                _token: $("input[name='_token']").val(),

            };
        },
        
       
         initialPreviewShowDelete:true,
         deleteUrl: "{{route('admin.imagen_itemot.destroy')}}",


        allowedFileExtensions: ['jpg','jpeg','svg','png', 'gif','txt','sql','pdf','xlsx','docx','pptx','dxf','dwg'],
        overwriteInitial: false,
        maxFileSize:10000000000,
        maxFilesNum: 100,
        language : 'es',
        fileType: "any",

        slugCallback: function (filename) {

        return filename.replace('(', '_').replace(']', '_');

        },
        purifyHtml: true,

        


         preferIconicPreview: true, // this will force thumbnails to display icons for following file extensions
        previewFileIconSettings: { // configure your icon file extensions
            'doc': '<i class="fas fa-file-word text-primary"></i>',
            'xls': '<i class="fas fa-file-excel text-success"></i>',
            'ppt': '<i class="fas fa-file-powerpoint text-danger"></i>',
            //'pdf': '<i class="fas fa-file-pdf text-danger"></i>',
            'zip': '<i class="fas fa-file-archive text-muted"></i>',
            'htm': '<i class="fas fa-file-code text-info"></i>',
            //'txt': '<i class="fas fa-file-alt text-info"></i>',
            'mov': '<i class="fas fa-file-video text-warning"></i>',
            'mp3': '<i class="fas fa-file-audio text-warning"></i>',
            'dwg': '<i class="fas fa-pencil-ruler text-secondary"></i>'
            // note for these file types below no extension determination logic 
            // has been configured (the keys itself will be used as extensions)
            //'jpg': '<i class="fas fa-file-image text-danger"></i>', 
            //'gif': '<i class="fas fa-file-image text-muted"></i>', 
            //'png': '<i class="fas fa-file-image text-primary"></i>'    
        },
        previewFileExtSettings: { // configure the logic for determining icon file extensions
            'image': function(ext) {
                return ext.match(/(png|jpg|jpeg|gif)$/i);
            },         
         
            'doc': function(ext) {
                return ext.match(/(doc|docx)$/i);
            },
            'xls': function(ext) {
                return ext.match(/(xls|xlsx)$/i);
            },
            'ppt': function(ext) {
                return ext.match(/(ppt|pptx)$/i);
            },
            'zip': function(ext) {
                return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
            },
            'htm': function(ext) {
                return ext.match(/(htm|html)$/i);
            },
            'txt': function(ext) {
                return ext.match(/(txt|ini|csv|java|php|js|css)$/i);
            },
            'mov': function(ext) {
                return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
            },
            'mp3': function(ext) {
                return ext.match(/(mp3|wav)$/i);
            },
            'dwg': function(ext) {
                return ext.match(/(dwg|dxf)$/i);
            }
        } 

    }).on('filebeforedelete', function() {
        var aborted = !window.confirm('¿ Está seguro que desea eliminar este elemento ?');
        if (aborted) {
            window.alert('Operacion abortada! ' + krajeeGetCount('file-5'));
        };
        return aborted;
    }).on('filedeleted', function() {
        setTimeout(function() {


            window.alert('¿Se ha eliminado el elemento! ' + krajeeGetCount('file-5'));
        }, 900);
    });



    

</script>




<script type="text/javascript">


var postURL = "<?php echo url('addmore'); ?>";
        var i= "{{$max_id}}";


        $('tr').on('DOMNodeInserted','select',function(){
            $(this).select2();
        });


//variables tabla calculo
        var perfil ;
        var densidad;
        var valor_kg;
        var diam_exterior;
        var diam_interior;
        var espesor;
        var sistema_medida;
        var dimensionado = '';
 
        

    $('.select-material').select2({
            placeholder: "Seleccionar...",
            minimumInputLength: 3,
            ajax: {
                url: "{{route('admin.materiales.dataAjax')}}",
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
                    let perfil ;
                   
                },
                cache: true
            },           
        });

    

        $('.select-material').on('change', function() {
      
            var materialID = this.value; 
            var row = getNumbersInString(this.id)
           
            perfil = 0  ;
            densidad = 0;
            valor_kg = 0 ;
            diam_exterior = '';
            diam_interior = '';
            espesor = '';
            sistema_medida = 0;
            dimensionado = '';


            
            if(materialID){
                $.ajax({

                    url: "{{ route('admin.get-datos-material') }}?material_id=" + materialID,
                    method: 'GET',
                    success:function(res){               
                    if(res){
                        perfil = res.perfil;
                        densidad = res.densidad;
                        valor_kg = res.valor_kg;
                        diam_exterior = res.diam_exterior;
                        diam_interior = res.diam_interior;
                        espesor = res.espesor;
                        sistema_medida = res.sistema_medida;
                        dimensionado = res.dimensionado;

                        if(dimensionado != '') {
                            var res = dimensionado.split("x");
                            $("#pr_largo"+row).val(res[0]);
                            $("#pr_ancho"+row).val(res[1]);                            
                                                        
                        }else{
                            $("#pr_largo"+row).val(0);
                            $("#pr_ancho"+row).val(0);
                        }

                        $("#pr_unit"+row).val(valor_kg);
                        $("#volumen").val(0);
                        $("#masa").val(0);
                        $("#valor").val(0);

                    }else{
                        // $("#representante_id").empty();
                    }
                    }
                });
            }else{
                //$("#commune_id").empty();
                
            }      
        }
      );

  


      $(document).on('click', '.btn_add',function(){

            var add_id = $(this).attr("id"); 

            var item = $("#pr_item" + add_id).val();
            var material_id =  $("#material_id"  + add_id).val();
            var largo = $('#pr_largo' + add_id).val();
            var ancho =  $("#pr_ancho" + add_id).val();
            var cpu =  $("#pr_unit" + add_id).val();
            var cpi =  $("#pr_cpi" + add_id).val();


            $.ajax({
            type:'POST',
            url:'{{route("admin.solicitud_material.store")}}?id='+ "<?php echo $item_ot->id; ?>",
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            data:{item:item, material_id:material_id, largo:largo , ancho:ancho , unitario:cpu , parcial:cpi},
            success:function(data){
                i++;  
                $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td class="custom-tbl"><input id="pr_item'+i+'" class="form-control input-sm"style="width:100%;" type="text" value="'+i+'" name="pr_item[]" readonly required></td> <td id="material_tr'+i+'" class="custom-tbl"> <select id="material_id'+i+'"  name="material_id[]" class="form-control select-material" >    </select> </td>         <td class="custom-tbl"><input id="pr_largo'+i+'" class="form-control input-sm" style="width:100%;" type="text" name="pr_largo[]"></td>   <td class="custom-tbl"><input id="pr_ancho'+i+'" class="form-control input-sm" style="width:100%;" type="text" oninput="multiply('+i+');" name="pr_ancho[]"></td>               <td class="custom-tbl"><input id="pr_unit'+i+'" class="form-control input-sm" style="width:100%;" type="text" oninput="multiply('+i+');" name="pr_unit[]"></td>               <td class="custom-tbl"><input id="pr_cpi'+i+'" class="estimated_cost form-control input-sm" style="width:100%;" type="text" name="pr_cpi[]" readonly></td>   <td><span class="badge btn-secondary" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> En espera </p></span></td>    <td class="custom-tbl"><button type="button" id="'+i+'" class="btn-info btn-sm btn_add" name="add"><span class="fas fa-plus"></span></button> <button type="button" name="remove" id="'+i+'" class="btn-danger btn-sm btn_remove"><span class="fas fa-times"></span></button></td></tr>');            
                //$('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td class="custom-tbl"><input id="pr_item'+i+'" class="form-control input-sm"style="width:100%;" type="text" value="'+i+'" name="pr_item[]" readonly required></td> <td id="material_tr'+i+'" class="custom-tbl">  </td>         <td class="custom-tbl"><input id="pr_largo'+i+'" class="form-control input-sm" style="width:100%;" type="text" name="pr_largo[]"></td>   <td class="custom-tbl"><input id="pr_ancho'+i+'" class="form-control input-sm" style="width:100%;" type="text" oninput="multiply('+i+');" name="pr_ancho[]"></td>               <td class="custom-tbl"><input id="pr_unit'+i+'" class="form-control input-sm" style="width:100%;" type="text" oninput="multiply('+i+');" name="pr_unit[]"></td>               <td class="custom-tbl"><input id="pr_cpi'+i+'" class="estimated_cost form-control input-sm" style="width:100%;" type="text" name="pr_cpi[]" readonly></td>       <td class="custom-tbl"><button type="button" id="'+i+'" class="btn-info btn-sm btn_add" name="add"><span class="fas fa-plus"></span></button> <button type="button" name="remove" id="'+i+'" class="btn-danger btn-sm btn_remove"><span class="fas fa-times"></span></button></td></tr>');  
                //$('#material_id'+i).select2();                
                   // $('.select-material').select2();

                   alert( 'DataTables has redrawn the table' );
               
            },
            error: function() {
                console.log("No se ha podido obtener la información");
            }

            });           
              
        }); 


        $(document).on('click', '.btn_remove', function(){  
            var button_id = $(this).attr("id");
            
            var item = $("#pr_item" + button_id).val();
            var material_id = $("#material_id"  + button_id).val();
            var largo = $('#pr_largo' + button_id).val();
            var ancho =  $("#pr_ancho" + button_id).val();
            var cpu =  $("#pr_unit" + button_id).val();
            var cpi =  $("#pr_cpi" + button_id).val();

            $.ajax({
            type:'POST',
            url:'{{route("admin.solicitud_material.destroy")}}?id='+ "<?php echo $item_ot->id; ?>",
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            data:{item:button_id, material_id:material_id, largo:largo , ancho:ancho , unitario:cpu , parcial:cpi },
            success:function(data){
                
                $('#row'+button_id+'').remove();  

                var valor_material = parseFloat(data.valor_material);
                var valor_delta    = parseFloat(data.valor_delta);
              

                $("#cmateriales").val(formatter.format(valor_material.toFixed(2) ));
                $("#cdelta").val(formatter.format( valor_delta.toFixed(2) ));

                console.log(data.success);      
                
            },
            error: function() {
                console.log("No se ha podido obtener la información");
            }

            });                      
            

        }); 



      function getNumbersInString(string) {
        var tmp = string.split("");
        var map = tmp.map(function(current) {
            if (!isNaN(parseInt(current))) {
            return current;
            }
        });

        var numbers = map.filter(function(value) {
            return value != undefined;
        });

        return numbers.join("");
     }


     $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });



</script>







<!--   CALCULO FORMULARIO INSERT MATERIAL  -->

<script>
        $.fn.select2.defaults.set('language', 'es');

        var formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
            });



//variables tabla calculo
        var perfil ;
        var densidad;
        var valor_kg;
        var diam_exterior;
        var diam_interior;
        var espesor;
        var sistema_medida;
        var dimensionado = '';
 
        $('#material_id').select2({
            placeholder: "Seleccionar...",
            minimumInputLength: 3,
            ajax: {
                url: "{{route('admin.materiales.dataAjax')}}",
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
                    let perfil ;
                   
                },
                cache: true
            },           
        });

        function calcular(){
            var volumen ;
            
            if(perfil == 1){
                volumen = volumen_barra();
                
            }

            if(perfil == 2){
                volumen = volumen_bocina();
            }

            if(perfil == 3){
                volumen = volumen_plancha();
            }

            volumenLt = volumen/1000;

            $('#volumen').val(volumenLt.toFixed(3));

            var masa = parseFloat(densidad) * volumen;
            var masaKg = masa/1000
            var precio = masa *( parseFloat( valor_kg  )  / 1000);

            $("#masa").val(masaKg.toFixed(3));
            $("#valor").val(  formatter.format(precio.toFixed(2)));
            $("#valor2").val( precio.toFixed(2));
        }


        function editar() {
      
            var materialID = $("#material_id").val(); 
  
            
            if(materialID){
                $.ajax({
                //    type:"GET",
                //    url:"{{url('admin.get-commune-list')}}?region_id="+regionID,
                    url: "{{ route('admin.edit-material') }}?material_id=" + materialID,
                    method: 'GET',
                    success:function(res){               
                    if(res){
                        console.log('success');
                        window.location.replace("{{route('admin.materiales.abrir')}}?material_id="+materialID);


                    }else{
                        // $("#representante_id").empty();
                    }
                    }
                });
            }else{
                //$("#commune_id").empty();
                
            }      
      }


        $('#material_id').on('change', function() {
      
            var materialID = this.value; 
            //alert(materialID) ;

             perfil = 0  ;
             densidad = 0;
             valor_kg = 0 ;
             diam_exterior = '';
             diam_interior = '';
             espesor = '';
             sistema_medida = 0;
             dimensionado = '';
            
            if(materialID){
                $.ajax({

                    url: "{{ route('admin.get-datos-material') }}?material_id=" + materialID,
                    method: 'GET',
                    success:function(res){               
                    if(res){
                        perfil = res.perfil;
                        densidad = res.densidad;
                        valor_kg = res.valor_kg;
                        diam_exterior = res.diam_exterior;
                        diam_interior = res.diam_interior;
                        espesor = res.espesor;
                        sistema_medida = res.sistema_medida;
                        dimensionado = res.dimensionado;

                        if(dimensionado != '') {
                            var res = dimensionado.split("x");
                            $("#largo").val(res[0]);
                            $("#ancho").val(res[1]);                            
                                                        
                        }else{
                            $("#largo").val(0);
                            $("#ancho").val(0);
                        }
                        
                      /*   
                        $("#largo").val(0);
                        $("#ancho").val(0); */
                        $("#volumen").val(0);
                        $("#masa").val(0);
                        $("#valor").val(0);

                    }else{
                       // $("#representante_id").empty();
                    }
                    }
                });
            }else{
                //$("#commune_id").empty();
                
            }      
            }
            );




        $('#largo').on('change', function () {

            var volumen ;
            
            if(perfil == 1){
                volumen = volumen_barra();
                
            }

            if(perfil == 2){
                volumen = volumen_bocina();
            }

            if(perfil == 3){
                volumen = volumen_plancha();
            }

            volumenLt = volumen/1000;

            $('#volumen').val(volumenLt.toFixed(3));

            var masa = parseFloat(densidad) * volumen;
            var masaKg = masa/1000
            var precio = masa *( parseFloat( valor_kg  )  / 1000);

            $("#masa").val(masaKg.toFixed(3));
            $("#valor").val( formatter.format(precio.toFixed(2)));
            $("#valor2").val( precio.toFixed(2));
            
        });

        $('#ancho').on('change', function() {
            
            var volumen ;
 
            if(perfil == 3){
                volumen = volumen_plancha();

                volumenLt = volumen/1000;

                $('#volumen').val(volumenLt.toFixed(3));

                var masa = parseFloat(densidad) * (volumen);
                var masaKg = masa/1000;
                var precio = masa * ( parseFloat(   valor_kg  )  / 1000);

                $("#masa").val(masaKg.toFixed(3));
                $("#valor").val( formatter.format(precio.toFixed(2)));
                $("#valor2").val( precio.toFixed(2));

            }



            
        });

        //alert(toDeci("1-1/4"));

            function toDeci(fraction) {
                var result, wholeNum = 0, frac, deci = 0;
                if(fraction.search('/') >= 0){
                    if(fraction.search('-') >= 0){
                        var wholeNum = fraction.split('-');
                        frac = wholeNum[1];
                        wholeNum = parseInt(wholeNum, 10);
                    }else{
                        frac = fraction;
                    }
                    if(fraction.search('/') >=0){
                        frac =  frac.split('/');
                        deci = parseInt(frac[0], 10) / parseInt(frac[1], 10);
                    }
                    result = wholeNum + deci;
                }else{
                    result = +fraction;
                }
                return result.toFixed(2);
            }


            function volumen_bocina(){
                    if(sistema_medida == 2) //si es en pulgadas
                    { 
                        var radioExt = (parseFloat(   toDeci(diam_exterior)    ) / parseFloat(2)) *25.4;
                        var radioInt = (parseFloat(   toDeci(diam_interior)    ) / parseFloat(2)) *25.4;
                    }else{   // si es en milimetros

                        var radioExt = parseFloat( diam_exterior ) / parseFloat(2);
                        var radioInt = parseFloat( diam_interior ) / parseFloat(2);
                    }
                    var areaExt = Math.PI * Math.pow(radioExt,2);
                    var areaInt = Math.PI * Math.pow(radioInt,2);

                    var areaTotal = (areaExt - areaInt)/1000;
                    var volumen = areaTotal * parseFloat( $('#largo').val() )
                    return volumen;
            }

            function volumen_barra(){
                
                if(sistema_medida == 2) //si es en pulgadas
                    { 
                        console.log(diam_exterior);
                        var radioExt =  ( parseFloat(   toDeci(diam_exterior)    ) / parseFloat(2) ) * 25.4;
                        
                        //var radioInt = parseFloat(   toDeci($('#diam_interior').val())    ) / parseFloat(2);
                    }else{   // si es en milimetros

                        var radioExt = parseFloat( diam_exterior ) / parseFloat(2);
                        //var radioInt = parseFloat( $('#diam_interior').val() ) / parseFloat(2);
                    }
                    var areaExt = Math.PI * Math.pow(radioExt,2);
                    //var areaInt = Math.PI * Math.pow(radioInt,2);

                    var areaTotal = areaExt/1000 ;
                    var volumen = areaTotal * parseFloat( $('#largo').val() )
                    return volumen;
                   //return radioExt;
            }

            function volumen_plancha(){

                //console.log('plancha');

                if(sistema_medida == 2) //si es en pulgadas
                    { 
                        var mespesor =   parseFloat( toDeci(espesor) ) * 25.4;

                    }else{   // si es en milimetros

                        var mespesor = parseFloat( espesor);
                       
                    }
                    var areaTotal = parseFloat( $('#largo').val() ) * parseFloat( $('#ancho').val() );

                    areaTotal = areaTotal / 1000;

                    var volumen = areaTotal * parseFloat( mespesor )
                    return volumen;
                
            }


            function agregar(){

                var material_id =  $("#material_id").val();
                var largo = $('#largo').val();
                var ancho =  $("#ancho").val();
                var valor =  $("#valor2").val();

                
                $.ajax({
                type:'POST',
                url:'{{route("admin.solicitud_material.store")}}?id='+ "<?php echo $item_ot->id; ?>",
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                data:{ material_id:material_id, largo:largo , ancho:ancho , valor:valor},
                success:function(data){
                    //i++;  
                    $('#dynamic_field').append('<tr id="row'+data.id+'" class="dynamic-added"><td class="custom-tbl" hidden="true"><input id="pr_item'+data.id+'" class="form-control input-sm"style="width:100%;" type="text" value="'+data.id+'" name="pr_item[]" readonly required></td> <td id="material_tr'+data.id+'" class="custom-tbl"> <input id="material_id'+data.id+'"  name="material_id[]" class="form-control" value="'+data.material+'" / >     </td>         <td class="custom-tbl"><input id="pr_largo'+data.id+'" class="form-control input-sm" style="width:100%;" type="text" name="pr_largo[]" value="'+data.dimension_largo+'"></td>   <td class="custom-tbl"><input id="pr_ancho'+data.id+'" class="form-control input-sm" style="width:100%;" type="text" oninput="multiply('+data.id+');" name="pr_ancho[]" value="'+data.dimension_ancho+'"></td>               <td class="custom-tbl"><input id="pr_unit'+data.id+'" class="form-control input-sm" style="width:100%;" type="text" oninput="multiply('+data.id+');" name="pr_unit[]" value="'+data.valor_unit+'"></td>               <td class="custom-tbl"><input id="pr_cpi'+data.id+'" class="estimated_cost form-control input-sm" style="width:100%; text-align:right;" type="text" name="pr_cpi[]" value="'+data.valor_total+'" readonly></td>      <td><span class="badge btn-secondary" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> En espera </p></span></td>     <td class="custom-tbl"><!--<button type="button" id="'+data.id+'" class="btn-info btn-sm btn_add" hidden="true" name="add"><span class="fas fa-plus"></span></button> --><button type="button" name="remove" id="'+data.id+'" class="btn-danger btn-sm btn_remove"><span class="fas fa-times"></span></button></td></tr>');            
                  
                    var format_total = parseFloat(data.total);
                    var format_parcial = parseFloat(data.valor_total);

                    $("#pr_cpi"+data.id).val(formatter.format( format_parcial.toFixed(2) )   );
                    $("#valor_total").val(formatter.format( format_total.toFixed(2) ) );


                    var valor_material = parseFloat(data.valor_material);
                    var valor_delta    = parseFloat(data.valor_delta   );
                    

                    $("#cmateriales").val(formatter.format( valor_material.toFixed(2) ));
                    $("#cdelta").val(formatter.format( valor_delta.toFixed(2) ));
                   
                   
                
                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }

                }); 
            }


            $(document).on('click', '.btn_use', function(){  
                var button_id = $(this).attr("id");

                //alert('consumir ' + button_id);
                
                var item = $("#pr_item" + button_id).val();
                var material_id = $("#material_id"  + button_id).val();

                $.ajax({
                type:'POST',
                url:'{{route("admin.trabajo_material.consumir")}}?id='+ "<?php echo $item_ot->id; ?>",
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                data:{ item:button_id },
                success:function(data){
                    
                   // $('#row'+button_id+'').remove(); 
                  // $('#dynamic_field').append('<tr id="row'+data.id+'" class="dynamic-added"><td class="custom-tbl" hidden="true"><input id="pr_item'+data.id+'" class="form-control input-sm"style="width:100%;" type="text" value="'+data.id+'" name="pr_item[]" readonly required></td> <td id="material_tr'+data.id+'" class="custom-tbl"> <input id="material_id'+data.id+'"  name="material_id[]" class="form-control" value="'+data.material+'" / >     </td>         <td class="custom-tbl"><input id="pr_largo'+data.id+'" class="form-control input-sm" style="width:100%;" type="text" name="pr_largo[]" value="'+data.dimension_largo+'"></td>   <td class="custom-tbl"><input id="pr_ancho'+data.id+'" class="form-control input-sm" style="width:100%;" type="text" oninput="multiply('+data.id+');" name="pr_ancho[]" value="'+data.dimension_ancho+'"></td>               <td class="custom-tbl"><input id="pr_unit'+data.id+'" class="form-control input-sm" style="width:100%;" type="text" oninput="multiply('+data.id+');" name="pr_unit[]" value="'+data.valor_unit+'"></td>               <td class="custom-tbl"><input id="pr_cpi'+data.id+'" class="estimated_cost form-control input-sm" style="width:100%; text-align:right;" type="text" name="pr_cpi[]" value="'+data.valor_total+'" readonly></td>      <td><span class="badge btn-secondary" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> En espera </p></span></td>     <td class="custom-tbl"><!--<button type="button" id="'+data.id+'" class="btn-info btn-sm btn_add" hidden="true" name="add"><span class="fas fa-plus"></span></button> --><button type="button" name="remove" id="'+data.id+'" class="btn-danger btn-sm btn_remove"><span class="fas fa-times"></span></button></td></tr>'); 
                    $("#status"+button_id).html('<span class="badge btn-dark" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Utilizado </p>  </span>');
                    $(this).remove();
                        //alert(data.success);      
                    }
                ,
                error: function() {
                    console.log("No se ha podido obtener la información");
                }

                });                       
            

        }); 


        
    </script>





@endsection