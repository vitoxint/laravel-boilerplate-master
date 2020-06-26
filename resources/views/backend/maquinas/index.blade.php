@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Registro de máquinas')


@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Registro de máquinas <small class="text-muted">Todas las máquinas</small>
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
                             <th>Nombre máquina</th>
                  
                         <!--     <th> Operadores asignados </th>
                             <th style="width:60px;">Valor HH.MM</th> -->
                             <th style="width:35px; text-align:center;">Estado</th>

                             <th style="width:45px;">@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($maquinas as $maquina)
                            <tr>
                                <td data-title="Código">{{ $maquina->codigo }}</td>
                                <td data-title="Nombre:">{{ $maquina->nombre }}</td>
<!--                                 <td data-title="Operadores asignados">  
                                    @foreach($maquina->maquina_has_operador as $operador)
                                     <h6> <span class="badge badge-default">{{$operador->operador->nombres.' '.$operador->operador->apellidos}}</span>
                                         
                                    @endforeach
                                    </h6>
                                </td> -->
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
