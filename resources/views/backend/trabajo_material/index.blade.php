@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Solicitudes de material')




@section('content')
<div class="card">
    <div class="card-body">
 
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Solicitudes de material <small class="text-muted">Solicitudes activas</small>
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
                             
                             <!-- <th>Material</th>   -->
                             <th>Trabajo</th>
                             <th>Material</th>                                  
                             <th>Dimensiones</th>
                             <th>Encargado</th>
                             <th>Fecha/hora</th>
                             <th>Estado</th>
                             <th style="width:45px;">@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($solicitudes as $solicitud)
                            <tr>                        
                                
                                
                                <td data-title="Trabajo">  
                                     {{$solicitud->materialOt->folio}}                         
                                </td>
                                <td data-title="Material">  {{ $solicitud->material->material }}   </td>
                                <td data-title="Medida/s" align="center"> 
                                    @switch($solicitud->material->perfil)
                                        @case(1)
                                           {{$solicitud->dimension_largo}} mm
                                        @break;
                                        @case(2)
                                            {{$solicitud->dimension_largo}} mm
                                        @break
                                        @case(3)
                                            {{$solicitud->dimension_ancho}}  {{ ' x '. $solicitud->dimension_ancho}} mm

                                    @endswitch

                                </td>
                                <td>{{$solicitud->materialOt->ordenTrabajo->usuario->first_name . ' ' .$solicitud->materialOt->ordenTrabajo->usuario->last_name }}</td>
                                <td>{{$solicitud->created_at}}
                                <td data-title="Estado" style="text-align:center;">                                    
                                    @switch($solicitud->estado)
                                            @case(1)
                                            <span class="badge btn-secondary" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> En espera </p>  </span>
                                            @break
                                            @case(2)
                                            <span class="badge btn-success" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Asignado </p>  </span>
                                            @break

                                    @endswitch 
                                    </td>
                                
                                <td data-title="Acciones" class="btn-td">@include('backend.trabajo_material.includes.actions', ['solicitud' => $solicitud])</td>
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
                    {!! $solicitudes->count() !!} 
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $solicitudes->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->




@endsection
