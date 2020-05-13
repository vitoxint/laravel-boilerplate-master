@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Contacto clientes')

@section('breadcrumb-links')
    @include('backend.contacto_clientes.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Registro de contactos de clientes <small class="text-muted">Todos los contactos</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Cliente</th>
                            <th>Cargo</th>                            
                            <th>Telefono/Celular</th>
                            <th>Email</th>
                            
                            
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clienteRepresentantes as $contacto)
                            <tr>
                                <td>{{ $contacto->nombre }}</td>
                                <td> <a href="{{route('admin.clientes.edit',$contacto->cliente)}}">  {{ $contacto->cliente->razon_social }} </a></td>
                                <td>{{ $contacto->funcion_representante}}</td>                               
                                <td>{{ $contacto->telefono}}</td>
                                <td>{{ $contacto->email }} </td>
                                <td class="btn-td">@include('backend.contacto_clientes.includes.actions', ['contacto' => $contacto, 'cliente' => $contacto->cliente])</td>
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
                    {!! $clienteRepresentantes->count() !!} 
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $clienteRepresentantes->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
