@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Solicitudes de cotizacion')

@section('breadcrumb-links')
    @include('backend.s_cotizacion.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Solicitudes de Cotizacion <small class="text-muted">Todas las solicitudes</small>
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
                             <th>#</th>
                            
                             <th>Fecha</th>
                             <th>Solicitante</th>
                             <th>Validez</td>
                             <th>Responsable</th>
                             <th>Estado</th>  
                             <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($solicitudCotizacions as $cotizacion)
                            <tr>
                                <td> {{$cotizacion->id}} </td>
                                <?php   $fecha_solicitud = new Carbon\Carbon($cotizacion->created_at); ?>
                                <td> {{ $fecha_solicitud->format('d/m/Y H:i') }} </td>
                                <td> {{ $cotizacion->nombre_solicitante}}</td>
                                <td> @if($cotizacion->validez) {{ $cotizacion->validez}} día/s @endif</td>
                                <td> @if($cotizacion->usuario) {{ $cotizacion->usuario->first_name. ' ' .$cotizacion->usuario->last_name}} @endif</td>
                                
                                <td style="text-align:center;">
                                    @switch($cotizacion->estado) 
                                            @case ('1') 
                                               <span class="badge btn-secondary" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> En espera </p></span>
                                            @break;
                                            @case ('2') 
                                                <span class="badge btn-primary" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Resuelta </p></span>
                                            @break;
                                            @case ('4')
                                                <span class="badge btn-danger" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Vencida </p></span>
                                            @break;
                                            @case ('3') 
                                                <span class="badge btn-dark" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;">  Enviada </p></span>
                                            @break;
                                            @default
                                                {{$cotizacion->estado}}
                                            @break;                   
                                    @endSwitch   
            
                                </td>
                                
                                <td class="btn-td">@include('backend.s_cotizacion.includes.actions', ['cotizacion' => $cotizacion])</td>
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
                   Hay  {!! $solicitudCotizacions->count() !!} solicitudes
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $solicitudCotizacions->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
