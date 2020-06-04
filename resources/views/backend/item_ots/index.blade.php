@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Trabajos (ítems)')

@section('breadcrumb-links')
    @include('backend.item_ots.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Trabajos <small class="text-muted">Todos los trabajos</small>
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
                             <th style="width:15px;">Folio</th>
                             <th style="width:18px;">O.T
                             <th style="width:10px;">Ctd.</th>
                             <th>Descripción</th>
                             <th style="width:15px;">Avance</th>
                             <th style="width:25px;">F.Entrega</th>
                             <th style="width:15px;">Estado</th>  
                             <th style="width:18px;">@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($itemOts as $item_ot)
                            <tr>
                                <td data-title="Folio:">{{ $item_ot->folio }}</td>
                                <td data-title="OT:">{{ $item_ot->ordenTrabajo->folio }}</td>
                                <td data-title="Cantidad:">{{ $item_ot->cantidad }}</td>
                                <td data-title="Descripción:">{{ $item_ot->descripcion }}</td>
                                <td data-title="Avance:">(no definido)</td>                              
                                <?php   $entrega_estimada = new Carbon\Carbon($item_ot->ordenTrabajo->entrega_estimada); ?>
                                <td data-title="Entrega comprometida:">{{ $entrega_estimada->format('d/m/Y') }}</td>


                                <td data-title="Estado:">
                                    @switch($item_ot->ordenTrabajo->estado) 
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
                                                {{$item_ot->trabajo->estado}}
                                            @break;                   
                                    @endSwitch   
            
                                </td>
                                
                                <td class="btn-td" data-title="Acción:">@include('backend.item_ots.includes.actionsTaller',  ['item_ot' => $item_ot , 'trabajo' => $item_ot->ordenTrabajo])</td>
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
                    {!! $itemOts->count() !!} 
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $itemOts->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
