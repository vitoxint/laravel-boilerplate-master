@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Trabajos (ítems)')

@section('breadcrumb-links')
    @include('backend.item_ots.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Trabajos <small class="text-muted">Todos los trabajos</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
               
            </div><!--col-->
        </div><!--row-->

        {{ html()->form('POST', route('admin.item_ots.opencode'))->class('form-horizontal')->open() }}

        <div class="row mt-4 mb-4">
            <div class="col">
            <div class="form-group row has-search">                      
                <div class="col-md-3">    
                <span class="fa fa-search form-control-feedback"></span>                   
                    <input id="codigo_id" name="codigo_id" class="form-control" placeholder="Buscar por código" >                                                                                
                </div><!--col-->
            
            <div class="col text">
                {{ form_submit('Abrir') }}
            </div><!--col-->
            </div><!--row-->
    
        {{ html()->form()->close() }}
        </row>

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive" id="no-more-tables">
                    <table class="table col-sm-12 table-bordered table-striped table-condensed cf">
                        <thead class="cf">
                        <tr>
                             <th style="width:15px;">Folio</th>
                             <th style="width:18px;">O.T
                             <th style="width:10px;">Ctd.</th>
                             <th>Descripción</th>
                             <th>Avance</th>
                             <th style="width:28px;">F.Entrega comprometida</th>
                             <th style="width:28px;">Estado</th>  
                             <th style="width:18px;">@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($itemOts as $item_ot)
                            <tr>
                                <td data-toggle="collapse" data-target="#data{{$item_ot->id}}" class="accordion-toggle" data-title="Folio:">{{ $item_ot->folio }}</td>
                                <td data-toggle="collapse" data-target="#data{{$item_ot->id}}" class="accordion-toggle" data-title="OT:">{{ $item_ot->ordenTrabajo->folio }}</td>
                                <td data-toggle="collapse" data-target="#data{{$item_ot->id}}" class="accordion-toggle" data-title="Cantidad:">{{ $item_ot->cantidad }}</td>
                                <td data-toggle="collapse" data-target="#data{{$item_ot->id}}" class="accordion-toggle" data-title="Descripción:">{{ $item_ot->descripcion }}</td>
                                
                                <td data-toggle="collapse" data-target="#data{{$item_ot->id}}" class="accordion-toggle" align="center" data-title="Avance:">{{$item_ot->porcentajeAvanceItemOt()}}%

                                    @if($item_ot->porcentajeAvanceItemOt() < 100)
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped" role="progressbar" text="sskjksj" style="width: {{$item_ot->porcentajeAvanceItemOt()}}%" aria-valuenow="{{$item_ot->porcentajeAvanceItemOt()}}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    @endif

                                    @if($item_ot->porcentajeAvanceItemOt() == 100)
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{$item_ot->porcentajeAvanceItemOt()}}%" aria-valuenow="{{$item_ot->porcentajeAvanceItemOt()}}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    @endif  


                                </td>                              
                                <?php   $entrega_estimada = new Carbon\Carbon($item_ot->ordenTrabajo->entrega_estimada); ?>
                                <td data-toggle="collapse" data-target="#data{{$item_ot->id}}" class="accordion-toggle" data-title="Entrega comprometida:">{{ $entrega_estimada->format('d/m/Y') }}</td>


                                <td data-toggle="collapse" data-target="#data{{$item_ot->id}}" class="accordion-toggle" data-title="Estado:">
                                    @switch($item_ot->estado) 
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
                                                <span class="badge btn-success" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Terminada </p></span>
                                            @break;
                                            @case ('5') 
                                                <span class="badge btn-dark" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Entregada </p></span>
                                            @break;
                                            @case ('6') 
                                                <span class="badge btn-warning" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> En Pausa </p></span>
                                            @break;

                                            @default
                                                {{$item_ot->trabajo->estado}}
                                            @break;                   
                                    @endSwitch   
            
                                </td>
                                
                                <td class="btn-td" data-title="Acción:">@include('backend.item_ots.includes.actionsTaller',  ['item_ot' => $item_ot , 'trabajo' => $item_ot->ordenTrabajo])</td>
                            </tr>

                            <tr class="p">
                                <td colspan="8" class="hiddenRow">
                                    <div class="accordian-body collapse p-1" id="data{{$item_ot->id}}">
                                    <div class="table-responsive" id="no-more-tables">
                                        <table class="table table-condensed cf">
                                            <thead class="cf">
                                                <tr>
                                                    <th style="width:35px;">Código</th>
                                                    <th>Proceso</th>
                                                    <th>Máquina</th>
                                                    <!-- <th>Operador</th> -->
                                                    <th>Hora planificada termino</th>
                                                    <th>Recurso proceso</th>
                                                    <th>Hora inicio</th>
                                                    <th>Estado</th>
                                                    
                                                    <th>Hora termino </th>

                                                    <th style="width:45px;">@lang('labels.general.actions')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                            @foreach($item_ot->procesosOt as $etapaItemOt)
                                                    <tr>
                                                        <td data-title="Codigo:">{{ $etapaItemOt->codigo }}</td>
                                                        <td data-title="Proceso:">{{ $etapaItemOt->proceso->descripcion }}</td>
                                                        <td data-title="Maquina:">{{ $etapaItemOt->maquina->codigo }}</td>
                                                        <!-- <td data-title="Operador:"></td> -->
                                                                <?php $flimite= new Carbon\Carbon($etapaItemOt->fh_limite);
                                                                    $flimite = $flimite->format('d-m-Y h:i'); ?>
                                                        <td date-title="Hora límite">{{$flimite}}</td>
                                                                <?php $finicio= new Carbon\Carbon($etapaItemOt->fh_inicio);
                                                                    $finicio = $finicio->format('d-m-Y h:i'); ?>
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
                                                        <td data-title="Hora Inicio">{{$finicio}}</td>

                                                        <td data-title="Estado" style="text-align:center;">
                                                            @switch($etapaItemOt->estado_avance) 
                                                            @case (1) 
                                                            <span class="badge btn-secondary" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Sin Iniciar </p></span>
                                                            @break;
                                                            @case (2) 
                                                                <span class="badge btn-primary" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> En Proceso </p></span>
                                                            @break;
                                                            @case (3)
                                                                <span class="badge btn-danger" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Atrasada </p></span>
                                                            @break;
                                                            @case (4) 
                                                                <span class="badge btn-success" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Terminada </p> </span>
                                                            @break;
                                                         
                                                            @case (5) 
                                                                <span class="badge btn-warning" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> En Pausa </p></span>
                                                            @break;

                                                            @default
                                                                {{$etapaItemOt->estado_avance}}
                                                            @break;                     
                                                            @endSwitch 
                                                        </td>
                                                                <?php $ftermino= new Carbon\Carbon($etapaItemOt->fh_termino);
                                                                    $ftermino = $ftermino->format('d-m-Y h:i'); ?>                                       
                                                        <td data-title="Hora Termino">{{$ftermino}}</td>

                                                        <td data-title="Acciones" class="btn-td">@include('backend.etapa_itemots.includes.actionsTaller', ['etapaItemOt' => $etapaItemOt])</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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
                    {!! $itemOts->count() !!} 
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $itemOts->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
