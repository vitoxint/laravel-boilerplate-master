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
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                             <th>Folio</th>
                             <th>Cliente</th>
                             <th>Contacto</th>
                             <th>Digitador</th>
                             <th>Avance</th>
                             <th>Entrega Comprometida</th>
                             <th>Estado OT</th>  
                             <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ordenTrabajos as $trabajo)
                            <tr>
                                <td>{{ $trabajo->folio }}</td>
                                <td>{{ $trabajo->cliente->razon_social }}</td>
                                <td>
                                    @if($trabajo->representante)
                                        {{ $trabajo->representante->nombre }}
                                    @endif
                                </td>
                                <td>{{ $trabajo->usuario->last_name }} {{ $trabajo->usuario->first_name }} </td>                               
                                <td>avance</td>
                                <?php   $entrega_estimada = new Carbon\Carbon($trabajo->entrega_estimada); ?>
                                <td>{{ $entrega_estimada->format('d/m/Y') }}</td>


                                <td>
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
                                
                                <td class="btn-td">@include('backend.orden_trabajos.includes.actions', ['trabajo' => $trabajo])</td>
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
