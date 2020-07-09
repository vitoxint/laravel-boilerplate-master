@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Cuentas internas de clientes')


@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Cuentas internas de clientes <small class="text-muted">(Crédito)</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.cuenta_clientes.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
            <div class="table-responsive" id="no-more-tables">
                    <table class="table col-sm-12 table-bordered table-striped table-condensed cf">
                        <thead class="cf">
                        <tr>
                             <th style="width:40%;">Cliente</th>
                             <th>Nombre cuenta</th>
                             <th>Saldo deuda</th>
                             <th>Activa</th>                            
                             <th>Estado cuenta</th>
                             <th style="width:45px;">@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cuentaClientes as $cuenta)
                            <tr>
                                <td data-title="Cliente"> <a href="{{route('admin.clientes.edit',$cuenta->cliente)}}"> [{{ $cuenta->cliente->rut_cliente }}] - {{$cuenta->cliente->razon_social }}</a></td>
                                <td data-title="Nombre/descripción:">{{$cuenta->nombre}}</td> 
                                <td style="text-align:right;" data-title="Saldo deuda:">@money( $cuenta->pagosOt->sum('monto') )</td>                                 
                               
                                <td style="text-align:center;" data-title="Activa">

                                    @if($cuenta->estado_activa == '1')
                                        <span class="badge btn-success" style="border-radius:12px;"><p style="margin:4px; font-size:14px;"> SI </p>  </span>
                                    @else
                                        <span class="badge btn-danger" style="border-radius:12px;"><p style="margin:4px; font-size:14px;"> NO </p>  </span>
                                    @endif
                                
                                 </td>

                                <td style="text-align:center;" data-title="Estado">    
                                    @switch($cuenta->estado_cuenta)
                                        @case(1)
                                        <span class="badge btn-success" style="border-radius:12px;"><p style="margin:4px; font-size:14px;"> Al día </p>  </span>
                                        @break
                                        @case(2)
                                        <span class="badge btn-danger" style="border-radius:12px;"><p style="margin:4px; font-size:14px;"> Deudor </p>  </span>
                                        @break
                                    @endswitch
                                </td>                                
                                
                                </td>                                                             
                                <td data-title="Acciones" class="btn-td">@include('backend.cuenta_clientes.includes.actions', ['cuenta' => $cuenta])</td>
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
                   Total {!! $cuentaClientes->count() !!} cuentas
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $cuentaClientes->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
