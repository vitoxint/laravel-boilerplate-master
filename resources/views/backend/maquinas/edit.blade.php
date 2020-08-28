@extends('backend.layouts.app')

@section('title','Disponibilidad de máquinas' . ' | ' . 'Editar máquina')

@section('content')


        <div class="card">
        {{ html()->modelForm($maquina, 'PATCH', route('admin.maquinas.update', $maquina))->class('form-horizontal')->acceptsFiles()->open() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Disponibilidad de máquinas
                            <small class="text-muted">Editar máquina: {{$maquina->codigo}}</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                        <div class="col">
                        <div class="form-group row">
                        {{ html()->label(__('Código *'))->class('col-md-2 form-control-label')->for('codigo') }}

                        <div class="col-md-2">                       
                                {{ html()->text('codigo')
                                    ->class('form-control')
                                    ->placeholder('Asignar un código')
                                    ->attribute('maxlength', 14)                                   
                                }}
                    
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('Nombre *'))->class('col-md-2 form-control-label')->for('nombre') }}

                        <div class="col-md-5">
                                                
                                {{ html()->text('nombre')
                                        ->class('form-control')
                                        ->placeholder('Nombre de la máquina ,marca,etc')
                                        ->attribute('maxlength', 191)                                   
                                }}
                                                    
                        </div>
                    </div><!--form-group--> 

<!--                     <div class="form-group row">
                        {{ html()->label(__('Valor hora HHMM'))->class('col-md-2 form-control-label')->for('valor_hora') }}

                        <div class="col-md-1">
                                                
                                {{ html()->number('valor_hora')
                                        ->class('form-control')
                                        ->placeholder('valor HHMM')
                                        ->attribute('maxlength', 191)
                                                                          
                                }}                                                    
                        </div>
                    </div> --><!--form-group-->                     

<!--                     <div class="form-group row">
                        {{ html()->label('Detalle y especificaciones')->class('col-md-2 form-control-label')->for('especificaciones') }}

                        <div class="col-md-10">
                            {{ html()->textarea('especificaciones')
                                ->class('form-control')
                                ->placeholder('información adicional')
                                ->attribute('maxlength', 191)
                                ->autofocus() }}
                        </div>
                    </div> --><!--form-group-->

                    <div class="form-group row">

                        {{ html()->label('Estado  ')->class('col-md-2 form-control-label')->for('estado') }}
                            <div class="col-md-2">

                            {{ html()->select('estado',array('1' => 'Disponible', '2' => 'Inhabilitada', '3' =>'En uso', '4' => 'En mantención'), $maquina->estado)
                                ->class('form-control')
                                ->attribute('maxlength', 191) 
                                ->required()                                
                            }}
                            </div><!--col-->
                        </div><!--form-group--> 

                    <div class="form-group row">

                        {{ html()->label('Observaciones  ')->class('col-md-2 form-control-label')->for('') }}
                            <div class="col-md-10">

                                @if($maquina->etapaItemOt->whereIn('estado_avance',[2,3])->where('fh_inicio', '!=' ,null)->count() > 0)
                                    <?php $f_limit = new Carbon\Carbon($maquina->etapaItemOt->whereIn('estado_avance',[2,3])->where('fh_inicio', '!=' ,null)->max('fh_limite'));?>

                                    Disponible a partir del {{$f_limit->format('d/m/Y H:i') }}

                                @endif

                            </div><!--col-->
                    </div><!--form-group--> 

<!--                     <div class="form-group row">                    
                        {{ html()->label('Operadores')->class('col-md-2 form-control-label')->for('operadores') }}
                            <div class="col-md-5">
                                <select name="operadores[]" id="operadores" class="form-control" multiple="multiple" >
                                @foreach($maquina->maquina_has_operador as $operadores)
                                <option value="{{$operadores->operador->id}}" selected>{{$operadores->operador->nombres. ' '.$operadores->operador->apellidos}}    </option>

                                @endforeach
                                </select>
                            </div>
                        </div> --><!--form-group-->             

                        </div><!--col-->
                    </div><!--row-->
                </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.maquinas.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
                    </div><!--row-->
                </div><!--row-->
            </div><!--card-footer-->

            {{ html()->closeModelForm() }}    
        </div><!--card-->    


<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    <small class="text-muted">Procesos y tareas en proceso</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
              
            </div><!--col-->
        </div><!--row-->


        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive" id="no-more-tables">
                    <table class="table col-sm-12 table-bordered table-striped table-condensed cf">
                        <thead class="cf">
                        <tr>
                             <th>Folio</th>
                             <th>Item</th>
                             <th>Proceso</th>
                             <th>Máquina</th>
                             <th>Plazo termino</th>  
                             <th>Recurso</th>
                             <th>Estado</th>
                             <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($maquina->etapaItemOt->whereIn('estado_avance',[2,3])->where('fh_inicio', '!=', null) as $etapaItemOt)
                            <tr data-toggle="collapse" data-target="#data{{$etapaItemOt->id}}" class="accordion-toggle">

                                <td data-title="Folio:">  {{ $etapaItemOt->codigo }}            </td>
                                <td data-title="Item:">    <a href="{{route('admin.item_ots.editTaller', [$etapaItemOt->itemOt ,$etapaItemOt->itemOt->ordenTrabajo ])}}"> {{ $etapaItemOt->itemOt->folio }} </a>    </td>
                                <td data-title="Proceso:">{{ $etapaItemOt->proceso->descripcion}}    </td>
                                <td data-title="Máquinar:"> {{ $etapaItemOt->maquina->nombre }} </td>                               
                                    <!-- <td>avance</td> -->
                                    <?php $flimite= new Carbon\Carbon($etapaItemOt->fh_limite);
                                    $flimite = $flimite->format('d-m-Y H:i'); ?>
                                <td date-title="Plazo termino">{{$flimite}}</td>

                                <td date-tittle="Recurso proceso">
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
                                        <span class="badge btn-success" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Terminada </p> </span>
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
                                
                                <td class="btn-td" data-title="Acción:">@include('backend.etapa_itemots.includes.actionsTaller', ['etapaItemOt' => $etapaItemOt])</td>

                            </tr>

                            <tr class="p">
                                <td colspan="8" class="hiddenRow">
                                    <div class="accordian-body collapse p-1" id="data{{$etapaItemOt->id}}">

                                    <?php $flimite= new Carbon\Carbon($etapaItemOt->fh_limite);
                                    $flimite = $flimite->format('d-m-Y H:i'); ?>
                                     <?php $finicio= new Carbon\Carbon($etapaItemOt->fh_inicio);
                                    $finicio = $finicio->format('d-m-Y H:i'); ?>
                                     <?php $ftermino= new Carbon\Carbon($etapaItemOt->fh_termino);
                                    $ftermino = $ftermino->format('d-m-Y H:i'); ?>
                                    <?php $fentrega= new Carbon\Carbon($etapaItemOt->itemOt->ordenTrabajo->entrega_estimada);
                                    $fentrega = $fentrega->format('d-m-Y'); ?>                                    

                                    <p><b>Cliente :      </b> {{$etapaItemOt->itemOt->ordenTrabajo->cliente->razon_social}}</p>
                                   
                                    <p><b>Ítem :         </b> {{$etapaItemOt->itemOt->descripcion}}</p>
                                    <p><b>Fecha de entrega :  </b> {{$fentrega}}             </p>
                                    <p><b>Detalle :      </b> {{$etapaItemOt->detalle}}</p>
                                    <p><b>Hora inicio :  </b> {{$finicio}}             </p>
                                    <p><b>Hora termino : </b> {{$ftermino}}            </p>
                                    <p><b>Plazo termino :</b> {{$flimite}}             </p>

                                    </div>  
                                </td> 
                            </tr>


                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->

    </div><!--card-body-->
</div><!--card-->

















  
</div>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" /> -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>
   
  <script>
        $.fn.select2.defaults.set('language', 'es');
        
        $('#operadores').select2({
            placeholder: "Seleccionar...",
            minimumInputLength: 3,
            ajax: {
                url: "{{route('admin.empleados.dataAjax')}}",
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
        })/* .on("select2:unselecting", function(e){
            var op = $('#operadores option:selected').val();
alert(op);
            $.ajax({
                type:'POST',
                url:'{{route("admin.maquinahasoperador.destroy")}}?id='+ "<?php echo $maquina->id ?>",
                data:{op:op},
                success:function(data){
                    alert('Operador eliminado de la máquina');                
                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }

                })     
        }).trigger('change') */;      
        
    </script>



@endsection