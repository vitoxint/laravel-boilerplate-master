@extends('backend.layouts.app')

@section('title','Cuentas cliente (crédito)' . ' | ' . 'Editar cuenta')

@section('content')


        <div class="card">
        {{ html()->modelForm($cuenta, 'PATCH', route('admin.cuenta_clientes.update', $cuenta))->class('form-horizontal')->acceptsFiles()->open() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Cuentas cliente (crédito)
                            <small class="text-muted">Editar cuenta </small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">

                    <div class="form-group row">
                        {{ html()->label(__('Cliente: '))->class('col-md-2 form-control-label')->for('cliente_id') }}

                        <div class="col-md-4">
                            <select name="cliente_id" id="cliente_id" class="form-control" style="width:100%; height:45px;" >
                            <option value="{{$cuenta->cliente->id}}" selected>{{$cuenta->cliente->razon_social}}    </option>
                            </select>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('Nombre/Encargado:'))->class('col-md-2 form-control-label')->for('nombre') }}

                        <div class="col-md-4">
                                                
                                {{ html()->text('nombre')
                                        ->class('form-control')
                                        ->placeholder('Nombre o encargado de la cuenta (opcional)')
                                        ->attribute('maxlength', 255)                                   
                                }}
                                                    
                        </div>
                    </div><!--form-group--> 

                    <div class="form-group row">
                        
                        {{ html()->label('Activa:')->class('col-md-2 form-control-label')->for('estado_activa') }}

                        <div class="col-md-1">                       
                                <label class="switch switch-label switch-pill switch-success">
                                @if($cuenta->estado_activa == 1)
                                    {{ html()->checkbox('estado_activa', true)->class('switch-input') }}
                                    <span class="switch-slider" data-checked="SI" data-unchecked="NO"></span>
                                @else
                                    {{ html()->checkbox('estado_activa', false)->class('switch-input') }}
                                    <span class="switch-slider" data-checked="SI" data-unchecked="NO"></span>
                                @endif                               
                                </label>
                    
                        </div><!--col-->


                        {{ html()->label('Estado:')->class('col-md-1 form-control-label')->for('statusCuenta') }}
                        <div class="col-md-1">

                        
                            <div id="statusPagoOt">

                            @switch($cuenta->estado_cuenta) 
                                    
                                    @case ('3')
                                        <span class="badge btn-danger" style="border-radius:11px;"><p style="margin:3px; font-size:14px;"> Moroso </p>  </span>
                                    @break;
                                    @case ('2') 
                                        <span class="badge btn-warning" style="border-radius:11px;"><p style="margin:3px; font-size:14px;"> Deudor </p> </span>
                                    @break;
                                    @case ('1') 
                                        <span class="badge btn-success" style="border-radius:11px;"><p style="margin:3px; font-size:14px;"> Al día </p>  </span>
                                    @break;
                                    
                                    @default
                                        {{$cuenta->estado_cuenta}}
                                    @break;                   
                            @endSwitch  
                            </div>
                        </div>

                        {{ html()->label('Saldo :')->class('col-md-1 form-control-label')->for('saldo') }}

                        <div class="col-md-2">
                            {{ html()->text('saldo')
                                ->class('form-control')
                                ->value('$  '. number_format($cuenta->pagosOt->sum('monto'),0, ',' , '.'  ))                                   
                                ->attribute('maxlength', 191)
                                ->disabled()      
                                ->autofocus()
                                
                                ->required() }}
                        </div><!--col-->

                                       
                    </div><!--form-group-->    

                        </div><!--col-->
                    </div><!--row-->
                </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.cuenta_clientes.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
                    </div><!--row-->
                </div><!--row-->
            </div><!--card-footer-->

            {{ html()->closeModelForm() }}    
        </div><!--card-->


        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Cargos a la cuenta
                        </h4>
                    </div><!--col-->

                </div><!--row-->

                <div class="row mt-4 mb-4">
                    <div class="col">

                    <div class="form-group row"> 
                        
                    </div>

                    <div class="form-group row" style="">

                        <div class="col-md-12">
                            <div id="abonos" class="table-responsive">
                                <table class='table table-bordered table-hover' id="tab_logic">
                                    <thead>
                                        <tr class='info'>
                                            <th style='width:7%;'hidden="true">ID cargo.</th>
                                            <th style='width:16%;'>Fecha</th> 
                                            <th style='width:17%;'>Orden Trabajo/Factura</th>       
                                            <th style='width:24%;'>Monto</th>
                                           
                                            <th style='width:40%;'>Digitador</th>                                          
                                            <th style='width:13%;'>Acción</th>
                                        </tr>
                                    </thead>
                                    <thead id="dynamic_field2">

                                    @foreach($cuenta->pagosOt as $abono)
                                    <tr id="row2{{$abono->id}}">
                                            <td class="custom-tbl" hidden="true"><input class='form-control input-sm'style='width:100%;' type="text"  value="{{$abono->id}}" id="pr_item{{$abono->id}}" name="pr_item[]" readonly required></td>
                                            <?php $fecha_ab = new Carbon\Carbon($abono->fecha_abono); $fecha_ab = $fecha_ab->format('d-m-Y H:i'); ?>
                                            <td> <p id="fecha_abono{{$abono->id}}" name="abono_id[]"> {{$fecha_ab}} </p></td>  
                                            <td> <p id="ot{{$abono->id}}" name="ot_id[]"> {{$abono->ordenTrabajo->folio}} <?php echo $abono->ordenTrabajo->factura ? 'Factura:'.$abono->ordenTrabajo->factura : '' ?>  </p></td>  
                                            <td style="text-align:right;"><p  id="monto{{$abono->id}}"  name="monto[]">@money($abono->monto)</p></td>
                                
                                            <td><p  id="digitador{{$abono->id}}"  name="digitador[]">{{$abono->encargado->first_name}} {{$abono->encargado->last_name}}</p></td>
                                         
                                            <td class="custom-tbl"><!-- <button type="button" id="{{$abono->id}}" class="btn-info btn-sm btn_add" name="add"><span class="fas fa-sync-alt"></span></button> -->
                                                           
                                                <button type="button" name="remove" id="{{$abono->id}}" class="btn-danger btn-sm btn_remove_abono"><span class="fas fa-times"></span></button>
                                                           
                                            </td>
                                        </tr>
                                    @endforeach
                                                                   
                                    </thead>
                                </table>
                        </div><!--col--></div>

                        </div><!--form-group-->  
                                
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->
        </div><!--card-->
    
  
</div>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" /> -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>
   
  <script>
        $.fn.select2.defaults.set('language', 'es');
        
        $('#cliente_id').select2({
            placeholder: "Seleccionar cliente...",
            minimumInputLength: 3,
            ajax: {
                url: "{{route('admin.clientes.dataAjax')}}",
                dataType: 'json',
                language: "es",
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };                   
                },
                cache: true
            },           
        });      
        
    </script>


@endsection