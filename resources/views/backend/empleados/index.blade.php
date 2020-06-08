@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Registro de operadores')

@section('breadcrumb-links')
    @include('backend.empleados.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Registro de operadores <small class="text-muted">Todos los operadores</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.empleados.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
            <div class="table-responsive" id="no-more-tables">
                    <table class="table col-sm-12 table-bordered table-striped table-condensed cf">
                        <thead class="cf">
                        <tr>
                             <th style="width:35px;">Código</th>
                             <th>Nombres</th>
                             <th>Apellidos</th>
                             <th>Ocupación</th>
                             <th>Activo</td>

                             <th style="width:45px;">@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($empleados as $empleado)
                            <tr>
                                <td data-title="Codigo:">{{ $empleado->codigo }}</td>
                                <td data-title="Nombres:">{{ $empleado->nombres }}</td>
                                <td data-title="Apellidos:">{{ $empleado->apellidos }}</td>
                                <td data-title="Ocupación:">{{ $empleado->ocupacion }}</td>
                                <td data-title="Activo" style="text-align:center;">
                                    @switch($empleado->estado_activo) 
                                            @case ('1') 
                                               <span class="badge btn-success"> SÍ </span>
                                            @break;
                                            @case ('0') 
                                                <span class="badge btn-danger"> NO </span>
                                            @break;
                                          
                                            @default
                                                {{$empleado->estado_activo}}
                                            @break;                   
                                    @endSwitch </td>

                                <td data-title="Acciones" class="btn-td">@include('backend.empleados.includes.actions', ['empleado' => $empleado])</td>
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
                    {!! $empleados->count() !!} 
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $empleados->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
