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

        {{ html()->form('POST', route('admin.orden_trabajos.opencode'))->class('form-horizontal')->open() }}
        
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row has-search">
                        

                            <div class="col-md-3">    
                                <span class="fa fa-search form-control-feedback"></span>                   
                                <input id="codigo_id" name="codigo_id" class="form-control" placeholder="Buscar por código" >                                                                                
                            </div><!--col-->
                        
                            <div class="col text">
                                {{ form_submit('Abrir')}}
                            </div><!--col-->
                            {{ html()->form()->close() }}

                           <div class="col-md-8">
                                <a href="{{ route('admin.orden_trabajos.index') }}">  <span class="badge btn-default" style="border-radius:10px; border: 1px solid black;"><p style="color:black; margin:2px; font-size:12px;"> Todas : {{$ot_count}} </p></span> </a>
                                <a href="{{ route('admin.orden_trabajos.sin_iniciar') }}">  <span class="badge btn-secondary" style="border-radius:10px; "><p style="  color:white; margin:2px; font-size:12px;"> Sin Iniciar : {{$count_si}} </p></span> </a>
                                <a href="{{ route('admin.orden_trabajos.en_proceso') }}">  <span class="badge btn-primary" style="border-radius:10px; "><p style="  color:white; margin:2px; font-size:12px;"> En Proceso : {{$count_ep}} </p></span> </a>
                                <a href="{{ route('admin.orden_trabajos.atrasadas') }}">  <span class="badge btn-danger" style="border-radius:10px; "><p style="  color:white; margin:2px; font-size:12px;"> Atrasada : {{$count_at}} </p></span> </a>
                                <a href="{{ route('admin.orden_trabajos.terminadas') }}">  <span class="badge btn-success" style="border-radius:10px; "><p style="  color:white; margin:2px; font-size:12px;"> Terminada : {{$count_te}} </p></span> </a>
                                <a href="{{ route('admin.orden_trabajos.entregadas') }}">  <span class="badge btn-dark" style="border-radius:10px; "><p style="  color:white; margin:2px; font-size:12px;"> Entregada : {{$count_en}} </p></span> </a>
                           </div><!--col-->
                        </div><!--row-->
                       
                </row>
        

        <div class="row">
            <div class="col-7">
                <div class="float-left">
                   Mostrando  {!! $ordenTrabajos->count() !!} de {{$ot_count}}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $ordenTrabajos->render() !!}
                </div>
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
                            <tr data-toggle="collapse" data-target="#data{{$trabajo->id}}" class="accordion-toggle">
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


                                <td style="text-align:center" data-title="Estado OT:">
                                    @switch($trabajo->estado) 
                                            @case ('1') 
                                               <span class="badge btn-secondary" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Sin Iniciar </p></span>
                                            @break;
                                            @case ('2') 
                                                <span class="badge btn-primary" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> En Proceso </p></span>
                                            @break;
                                            @case ('3')
                                                <span class="badge btn-danger" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Atrasada </p></span>
                                            @break;
                                            @case ('4') 
                                                <span class="badge btn-success" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Terminada </p></span>
                                            @break;
                                            @case ('5') 
                                                <span class="badge btn-dark" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Entregada </p></span>
                                            @break;
                                            @case ('6') 
                                                <span class="badge btn-warning" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Anulada </p></span>
                                            @break;

                                            @default
                                                {{$trabajo->estado}}
                                            @break;                   
                                    @endSwitch   
            
                                </td>
                                
                                <td class="btn-td" data-title="Acción:">@include('backend.orden_trabajos.includes.actions', ['trabajo' => $trabajo])</td>
                            </tr>

                            <tr class="p">
                                <td colspan="7" class="hiddenRow">
                                    <div class="accordian-body collapse p-1" id="data{{$trabajo->id}}">
                                    <div class="table-responsive" id="no-more-tables">
                                        <table class="table table-condensed cf">
                                            <thead class="cf">
                                                    <tr>
                                                        <th>Item</th>
                                                        <th>Ctd</th>
                                                        <th>Descripcion</th>                                   
                                                        <th>Val. Unitario</th>
                                                        <th>Val. Parcial</th>
                                                        <th>Avance</th>
                                                        <th>Estado</th>       
                                                        <th>@lang('labels.general.actions')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($trabajo->items_ot as $item_ot)
                                                        <tr>
                                                            <td data-title="Folio:">{{ $item_ot->folio }}</td>
                                                            <td data-title="Cantidad:">{{ $item_ot->cantidad }}</td>
                                                            <td data-title="Descripción:">{{ $item_ot->descripcion }}</td>
                                                            <td align="right" data-title="Valor Unitario:">@money($item_ot->valor_unitario )</td>
                                                            <td align="right" data-title="Valor Parcial:"> @money($item_ot->valor_parcial ) </td>
                                                            
                                                            <td align="center">{{$item_ot->avanceItemOt()}}</td>
                                                            <td style="text-align:center;" data-title="Estado ítem OT:">
                                                                @switch($item_ot->estado)
                                                                    @case(1)
                                                                        <span class="badge btn-secondary" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Sin Iniciar </p></span>
                                                                        @break
                                                                        
                                                                    @case(2)
                                                                        <span class="badge btn-primary" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> En Proceso </p></span>
                                                                        @break
                                                                    @case(3)
                                                                        <span class="badge btn-danger" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Atrasada </p></span>
                                                                        @break
                                                                    @case(4)
                                                                        <span class="badge btn-success" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Terminada </p></span>
                                                                        @break  
                                                                    @case(5)
                                                                        <span class="badge btn-dark" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Entregada </p></span>
                                                                        @break                                  
                                                                
                                                                    @case(6)
                                                                        <span class="badge btn-warning" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> En Pausa </p></span>
                                                                        @break   
                                                                    @default
                                                                    <span>Something went wrong, please try again</span>
                                                                
                                                                        
                                                                @endswitch
                                                            
                                                            </td>                               
                                                        
                                                            <td class="btn-td" data-title="Acciones:">@include('backend.item_ots.includes.actions', ['item_ot' => $item_ot , 'trabajo' => $trabajo])</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                    </div> 
                                </td> 
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
                   Mostrando  {!! $ordenTrabajos->count() !!} òrdenes
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


<script>

    $('.accordion-toggle').click(function(){
        $('.hiddenRow').hide();
        $(this).next('tr').find('.hiddenRow').show();
    });



</script>





@endsection
