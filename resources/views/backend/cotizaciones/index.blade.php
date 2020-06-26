@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Cotizaciones')

@section('breadcrumb-links')
    @include('backend.cotizaciones.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Cotizaciones <small class="text-muted">Todas las cotizaciones</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.cotizaciones.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
            <div class="table-responsive" id="no-more-tables">
                    <table class="table col-sm-12 table-bordered table-striped table-condensed cf">
                        <thead class="cf">
                        <tr>
                             <th>Folio</th>
                             <th>Cliente</th>
                             <th>Contacto</th>
                             <th>Fecha</th>
                             <th>Validez</th>
                             <th>Valor Neto</th>
                             <th>Estado</th>  
                             <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cotizaciones as $cotizacion)
                            <tr>
                                <td>{{ $cotizacion->folio }}</td>
                                <td>{{ $cotizacion->empresa }}</td>
                                <td>
                                    @if($cotizacion->contacto)
                                        {{ $cotizacion->contacto }}
                                        
                                    @else
                                        {{ '(No disponible)'}}
                                    @endif
                                </td>
                                <?php   $fecha_cotizacion = new Carbon\Carbon($cotizacion->created_at); ?>
                                <td>{{ $fecha_cotizacion->format('d/m/Y') }}</td>
                                <td>{{ $cotizacion->dias_validez}} día(s)</td>
                                <td style="text-align:right;">  @money($cotizacion->valor_neto) </td>

                                <td style="text-align:center;">
                                    @switch($cotizacion->estado) 
                                            @case ('1') 
                                               <span class="badge btn-success" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Vigente </p></span>
                                            @break;
                                            @case ('2') 
                                                <span class="badge btn-primary" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Aceptada </p></span>
                                            @break;
                                            @case ('3')
                                                <span class="badge btn-danger" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Vencida </p></span>
                                            @break;
                                            @case ('4') 
                                                <span class="badge btn-secondary" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;">  Anulada </p></span>
                                            @break;
                                            @default
                                                {{$cotizacion->estado}}
                                            @break;                   
                                    @endSwitch   
            
                                </td>
                                
                                <td class="btn-td">@include('backend.cotizaciones.includes.actions', ['cotizacion' => $cotizacion])</td>
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
                    {!! $cotizaciones->count() !!} 
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $cotizaciones->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
