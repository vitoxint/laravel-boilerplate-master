@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Clientes')

@section('breadcrumb-links')
    @include('backend.clientes.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Administración de clientes <small class="text-muted">Todos los clientes</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.clientes.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Razón social</th>
                            <th>RUT</th>
                            
                            <th>Dirección</th>
                            <th>Ciudad</th>
                            <th>Teléfono</th>
                            
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->razon_social }}</td>
                                <td>{{ $cliente->rut_cliente }}</td>
                                <td>{{ $cliente->direccion }}</td>                               
                                <td>{{ $cliente->commune->name}}</td>
                                <td>{{ $cliente->telefono }} - {{ $cliente->celular }} </td>
                                <td class="btn-td">@include('backend.clientes.includes.actions', ['cliente' => $cliente])</td>
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
                    {!! $clientes->count() !!} 
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $clientes->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
