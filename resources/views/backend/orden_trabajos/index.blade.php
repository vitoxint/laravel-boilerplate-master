@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Ordenes de Trabajo')

@section('breadcrumb-links')
    @include('backend.orden_trabajos.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Ordenes de Trabajo <small class="text-muted">Todas las órdenes de trabajo</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.orden_trabajos.includes.header-buttons')
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
                             <th>Digitador</th>
                             <!-- <th>Avance</th> -->
                             <th>Entrega Comprometida</th>
                             <th>Estado OT</th>  
                             <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ordenTrabajos as $trabajo)
                            <tr>
                                <td data-title="Folio:">{{ $trabajo->folio }}</td>
                                <td data-title="Cliente:">{{ $trabajo->cliente->razon_social }}</td>
                                <td data-title="Contacto:">
                                    @if($trabajo->representante)
                                        {{ $trabajo->representante->nombre }}
                                        @else
                                        {{ '( no definido ) '}}
                                    @endif
                                </td>
                                <td data-title="Digitador:"> {{ $trabajo->usuario->first_name }} {{ $trabajo->usuario->last_name }}</td>                               
                                <!-- <td>avance</td> -->
                                <?php   $entrega_estimada = new Carbon\Carbon($trabajo->entrega_estimada); ?>
                                <td data-title="Entrega comprometida:">{{ $entrega_estimada->format('d/m/Y') }}</td>


                                <td data-title="Estado OT:">
                                    @switch($trabajo->estado) 
                                            @case ('1') 
                                               <span class="badge btn-secondary"> Sin Iniciar </span>
                                            @break;
                                            @case ('2') 
                                                <span class="badge btn-primary"> En Proceso </span>
                                            @break;
                                            @case ('3')
                                                <span class="badge btn-danger"> Atrasada </span>
                                            @break;
                                            @case ('4') 
                                                <span class="badge btn-success"> Terminada </span>
                                            @break;
                                            @case ('5') 
                                                <span class="badge btn-dark"> Entregada </span>
                                            @break;
                                            @case ('6') 
                                                <span class="badge btn-warning"> Anulada </span>
                                            @break;

                                            @default
                                                {{$trabajo->estado}}
                                            @break;                   
                                    @endSwitch   
            
                                </td>
                                
                                <td class="btn-td" data-title="Acción:">@include('backend.orden_trabajos.includes.actions', ['trabajo' => $trabajo])</td>
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
                    {!! $ordenTrabajos->count() !!} 
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $ordenTrabajos->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
