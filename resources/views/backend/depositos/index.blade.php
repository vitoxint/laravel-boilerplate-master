@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Lugares de deposito materiales')


@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Lugares de depósito de material <small class="text-muted">Lugares de almacenamiento</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.depositos.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
            <div class="table-responsive" id="no-more-tables">
                    <table class="table col-sm-12 table-bordered table-striped table-condensed cf">
                        <thead class="cf">
                        <tr>
                             <th>Nombre</th>
                             <th>Ubicación</th>
                             <th>Habilitada</th>
                             <th>Utilizada</th>                            
                             <th>Cantidad existencias</th>
                             <th style="width:45px;">@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($depositos as $deposito)
                            <tr>
                                <td data-title="Nombre">{{ $deposito->nombre }}</td>
                                <td data-title="Ubicación:">{{ $deposito->ubicacion }}</td>                                 
                                <td data-title="Habilitada" align="center"> 
                                    @if($deposito->estado_habilitada == '1')
                                    <span class="badge btn-success" style="border-radius:12px;"><p style="margin:4px; font-size:14px;"> SI </p>  </span>
                                    @else
                                    <span class="badge btn-danger" style="border-radius:12px;"><p style="margin:4px; font-size:14px;"> NO </p>  </span>
                                    @endif
                                </td>
                                <td data-title="Utilizada" align="center">
                                    @if($deposito->estado_utilizada == '1')
                                    <span class="badge btn-success" style="border-radius:12px;"><p style="margin:4px; font-size:14px;"> SI </p>  </span>
                                    @else
                                    <span class="badge btn-danger" style="border-radius:12px;"><p style="margin:4px; font-size:14px;"> NO </p>  </span>
                                    @endif                                    
                                 </td>
                                <td data-title="Cantidad existencias">    
                                   
                                </td>                                
                                
                                </td>                                                             
                                <td data-title="Acciones" class="btn-td">@include('backend.depositos.includes.actions', ['deposito' => $deposito])</td>
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
                    {!! $depositos->count() !!} 
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $depositos->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
