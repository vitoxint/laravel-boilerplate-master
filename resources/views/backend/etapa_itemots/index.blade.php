@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Procesos y tareas')

@section('breadcrumb-links')

@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    <small class="text-muted">Procesos y tareas de las órdenes de trabajo</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">

                @include('backend.etapa_itemots.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->
        
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row has-search">
                        
                           <div class="col-md-8">
                                <a href="{{ route('admin.etapa_itemots.index') }}">  <span class="badge btn-default" style="border-radius:10px; border: 1px solid black;"><p style="color:black; margin:2px; font-size:12px;"> Todas : {{$et_count}} </p></span> </a>
                                <a href="{{ route('admin.etapa_itemots.sin_iniciar') }}">  <span class="badge btn-secondary" style="border-radius:10px; "><p style="  color:white; margin:2px; font-size:12px;"> Sin Iniciar : {{$count_si}} </p></span> </a>
                                <a href="{{ route('admin.etapa_itemots.en_proceso') }}">  <span class="badge btn-primary" style="border-radius:10px; "><p style="  color:white; margin:2px; font-size:12px;"> En Proceso : {{$count_ep}} </p></span> </a>
                                <a href="{{ route('admin.etapa_itemots.en_pausa') }}">  <span class="badge btn-warning" style="border-radius:10px; "><p style="  color:white; margin:2px; font-size:12px;"> En Pausa : {{$count_de}} </p></span> </a>
                                <a href="{{ route('admin.etapa_itemots.atrasadas') }}">  <span class="badge btn-danger" style="border-radius:10px; "><p style="  color:white; margin:2px; font-size:12px;"> Atrasada : {{$count_at}} </p></span> </a>
                                <a href="{{ route('admin.etapa_itemots.terminadas') }}">  <span class="badge btn-success" style="border-radius:10px; "><p style="  color:white; margin:2px; font-size:12px;"> Terminada : {{$count_te}} </p></span> </a>
                               
                           </div><!--col-->
                        </div><!--row-->
                       
                   </div>
                </div>
        

        <div class="row">
            <div class="col-7">
                <div class="float-left">
                   Mostrando  {!! $etapaOts->count() !!} de {{$et_count}}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $etapaOts->render() !!}
                </div>
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
                        @foreach($etapaOts as $etapaItemOt)
                            <tr>

                                <td data-toggle="collapse" data-target="#data{{$etapaItemOt->id}}" class="accordion-toggle" data-title="Folio:">  {{ $etapaItemOt->codigo }}            </td>
                                <td data-toggle="collapse" data-target="#data{{$etapaItemOt->id}}" class="accordion-toggle" data-title="Item:">    <a href="{{route('admin.item_ots.editTaller', [$etapaItemOt->itemOt ,$etapaItemOt->itemOt->ordenTrabajo ])}}"> {{ $etapaItemOt->itemOt->folio }} </a>    </td>
                                <td data-toggle="collapse" data-target="#data{{$etapaItemOt->id}}" class="accordion-toggle" data-title="Proceso:">{{ $etapaItemOt->proceso->descripcion}}    </td>
                                <td data-toggle="collapse" data-target="#data{{$etapaItemOt->id}}" class="accordion-toggle" data-title="Máquina:"> {{ $etapaItemOt->maquina->nombre }} </td>                               
                                    <!-- <td>avance</td> -->
                                    <?php $flimite= new Carbon\Carbon($etapaItemOt->fh_limite);
                                    $flimite = $flimite->format('d-m-Y H:i'); ?>
                                <td data-toggle="collapse" data-target="#data{{$etapaItemOt->id}}" class="accordion-toggle" date-title="Plazo termino">{{$flimite}}</td>

                                <td data-toggle="collapse" data-target="#data{{$etapaItemOt->id}}" class="accordion-toggle" date-tittle="Recurso proceso">
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

                                <td data-toggle="collapse" data-target="#data{{$etapaItemOt->id}}" class="accordion-toggle" data-title="Estado" style="text-align:center;">
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
                                        <span class="badge btn-warning" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> En Pausa </p></span>
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
                                    <p><b>Fecha de entrega :  </b> {{$fentrega}}       </p>
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
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                   Mostrando  {!! $etapaOts->count() !!} procesos y tareas
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $etapaOts->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->


<script>

    $('.accordion-toggle').click(function(){
        $('.hiddenRow').hide();
        $(this).next('tr').find('.hiddenRow').show();
    });



</script>





@endsection