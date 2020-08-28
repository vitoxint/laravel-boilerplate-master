@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Disponibilidad de máquinas')


@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Disponibilidad de máquinas <small class="text-muted">Todas las máquinas</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.maquinas.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
            <div class="table-responsive" id="no-more-tables">
                    <table class="table col-sm-12 table-bordered table-striped table-condensed cf">
                        <thead class="cf">
                        <tr>
                             <th style="width:35px;">Código</th>
                             <th>Máquina</th>
                             <th>Procesos en ejecución
                             <th>Observación </th>
                         <!--    <th style="width:60px;">Valor HH.MM</th> -->
                             <th style="width:35px; text-align:center;">Estado</th>

                             <th style="width:45px;">@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($maquinas as $maquina)
                            <tr>
                                <td data-title="Código">{{ $maquina->codigo }}</td>
                                <td data-title="Nombre:">{{ $maquina->nombre }}</td>
                                <td data-title="Procesos en ejecución">  
                                     @foreach($maquina->etapaItemOt->whereIn('estado_avance',[2,3])->where('fh_inicio', '!=' ,null) as $etapaItemOt)
                                     <h6> <a href="{{route('admin.item_ots.edit', [$etapaItemOt->itemOt ,$etapaItemOt->itemOt->ordenTrabajo ])}}"> {{ $etapaItemOt->itemOt->folio }} </a> &rarr;  
                                          <a href="{{route('admin.etapa_itemots.edit', [$etapaItemOt])}}"> {{ $etapaItemOt->codigo }} </a>: {{$etapaItemOt->proceso->descripcion}} </h6><br>    
                                         
                                    @endforeach
                                   
                                </td>
                                
                                <td data-title="Observaciones">

                                @if($maquina->etapaItemOt->whereIn('estado_avance',[2,3])->where('fh_inicio', '!=' ,null)->count() > 0)
                                    <?php $f_limit = new Carbon\Carbon($maquina->etapaItemOt->whereIn('estado_avance',[2,3])->where('fh_inicio', '!=' ,null)->max('fh_limite'));?>

                                    Disponible a partir del {{$f_limit->format('d/m/Y H:i') }}

                                @endif

                                </td>
                                <!-- <td data-title="Valor hora" style="text-align:right;">@money($maquina->valor_hora) </td> -->

                                <td data-title="Estado disponibilidad:" style="text-align:center;">
                                    @switch($maquina->estado) 
                                            @case ('1') 
                                               <span class="badge btn-success" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Disponible </p></span>
                                            @break;
                                            @case ('2') 
                                                <span class="badge btn-danger" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Inhabilitada </p></span>
                                            @break;
                                            @case ('3')
                                                <span class="badge btn-primary" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> En uso </p></span>
                                            @break;
                                            @case ('4') 
                                                <span class="badge btn-warning" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> En mantención </p></span>
                                            @break;
                                            @default
                                                {{$maquina->estado}}
                                            @break;                   
                                    @endSwitch </td>

                                <td data-title="Acciones" class="btn-td">@include('backend.maquinas.includes.actions', ['maquina' => $maquina])</td>
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
                    {!! $maquinas->count() !!} 
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $maquinas->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
