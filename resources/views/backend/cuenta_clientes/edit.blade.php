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

                        <div class="col-md-6">
                            <select name="cliente_id" id="cliente_id" class="form-control" style="width:100%; height:45px;" >
                            <option value="{{$cuenta->cliente->id}}" selected>{{$cuenta->cliente->razon_social}}    </option>
                            </select>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('Nombre/Encargado:'))->class('col-md-2 form-control-label')->for('nombre') }}

                        <div class="col-md-6">
                                                
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

                        
                            <div id="statusCuenta">

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
                                ->value('$  '. number_format($cuenta->saldo,0, ',' , '.'  ))   
                                                                  
                                ->attribute('maxlength', 191)
                                ->disabled()      
      
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


<nav>
    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-cargos-tab" data-toggle="tab" href="#nav-cargos" role="tab" aria-controls="nav-cargos" aria-selected="true"><i class="fas fa-credit_card"> </i> Cargos</a>
        <!-- <a class="nav-item nav-link" id="nav-rubros-tab" data-toggle="tab" href="#nav-rubros" role="tab" aria-controls="nav-rubros" aria-selected="false">Rubros e ítems</a> -->
        <a class="nav-item nav-link" id="nav-abonos-tab" data-toggle="tab" href="#nav-abonos" role="tab" aria-controls="nav-abonos" aria-selected="false"><i class="fas fa-coins"></i> Abonos</a>
        <!-- <a class="nav-item nav-link" id="nav-materiales-tab" data-toggle="tab" href="#nav-materiales" role="tab" aria-controls="nav-materiales" aria-selected="false"><i class="fas fa-pallet"></i> Utilización de materiales</a> -->
    </div>
</nav>

<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-cargos" role="tabpanel" aria-labelledby="nav-cargos-tab">

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
                                                           
                                                <!-- <button type="button" name="remove" id="{{$abono->id}}" class="btn-danger btn-sm btn_remove_abono"><span class="fas fa-times"></span></button> -->
                                                           
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

    <div class="tab-pane fade" id="nav-abonos" role="tabpanel" aria-labelledby="nav-abonos-tab">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Abonos a la cuenta
                        </h4>
                    </div><!--col-->

                </div><!--row-->

                <div class="row mt-4 mb-4">
                    <div class="col">

                    <div class="form-group row">

                    <div class="col-md-12">
                        <a style="color:black;" class="btn-btn-default"  data-toggle="collapse" href="#formAbono" role="button" aria-expanded="false" aria-controls="#formAbono">
                            Agregar pago
                        </a>   
                    </div>  
                        

                    </div>

                    <div id="formAbono" class="collapse" >
                    <div class="card card-body">

                        <div class="form-group row" >

                            {{ html()->label('Método pago:')->class('col-md-1 form-control-label')->for('medio_pago') }}

                            <div class="col-md-2">
                                {{ html()->select('medio_pago',array('1' => 'Efectivo', '2' => 'Tarjeta (Transbank)', '3' =>'Transferencia bancaria', '4' => 'Documento'),null)
                                    ->class('form-control')
                                    ->attribute('maxlength', 191) 
                                    ->required()
                                    
                                }}
                            </div><!--col-->                        

                            {{ html()->label('Monto $:')->class('col-md-1 form-control-label')->for('monto') }}

                            <div class="col-md-2">
                                {{ html()->text('monto')
                                    ->class('form-control')  
                                    ->value(0)                                                              
                                    ->attribute('maxlength', 191)                                          
                                    ->autofocus()
                                    ->required()                                   
                                    }}
                            </div><!--col-->


                            {{ html()->label('Observación:')->class('col-md-1 form-control-label')->for('observacion') }}

                            <div class="col-md-3">
                                {{ html()->text('observacion')
                                    ->class('form-control')                                                               
                                    ->attribute('maxlength', 512)                                          
                                    ->autofocus()                                
                                    }}
                            </div><!--col-->

                            <div class="col col-md-2">
                                <button class="btn btn-dark btn-xs" onclick="añadir_abono()"><i class="fas fa-check"></i> Confirmar Registro </button>
                            </div>

                        </div>

                    </div>

                    </div>
                    <div class="col">

                    </div><!--form-group--> 

                    <div class="form-group row" style="">

                        <div class="col-md-12">
                            <div id="abonos" class="table-responsive">
                                <table class='table table-bordered table-hover' id="tab_logic">
                                    <thead>
                                        <tr class='info'>
                                            <th style='width:7%;'hidden="true">ID abono.</th>
                                            <th style='width:16%;'>Fecha Registro</th>        
                                            <th style='width:24%;'>Monto</th>
                                            <th style='width:17%;'>Medio Pago </th>
                                            <th style='width:40%;'>Digitador</th>                                          
                                            <th style='width:13%;'>Acción</th>
                                        </tr>
                                    </thead>
                                    <thead id="dynamic_field3">

                                    @foreach($cuenta->abonosCuenta as $abono)
                                    <tr id="row3{{$abono->id}}">
                                            <td class="custom-tbl" hidden="true"><input class='form-control input-sm'style='width:100%;' type="text"  value="{{$abono->id}}" id="pr_item{{$abono->id}}" name="pr_item[]" readonly required></td>
                                            <?php $fecha_re = new Carbon\Carbon($abono->fecha_registro); $fecha_re = $fecha_re->format('d-m-Y H:i'); ?>
                                            <td> <p id="fecha_registro{{$abono->id}}" name="abono_id[]"> {{$fecha_re}} </p></td>  
                                            <td style="text-align:right;"><p  id="monto{{$abono->id}}"  name="monto[]">@money($abono->monto)</p></td>
                                            <td><p  id="medio_pago{{$abono->id}}"  name="medio_pago[]">
                                                @switch($abono->medio_pago)
                                                    @case(1)
                                                        Efectivo
                                                    @break
                                                    @case(2)
                                                        Tarjeta (Transbank)
                                                    @break
                                                    @case(3)
                                                        Transferencia bancaria
                                                    @break
                                                    @case(4)
                                                        Documento (cheque)
                                                    @break

                                                @endswitch
                                            
                                            </p></td>

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
</div>
  
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


    <script type="text/javascript">

        var formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
        });


        function añadir_abono(){

        var cuenta_id =  <?php echo $cuenta->id; ?>;
        var valor = $('#monto').val();
        var medio_pago = $("#medio_pago").val();
        var observacion = $("#observacion").val();
            
            $.ajax({
            type:'POST',
            url:'{{route("admin.abono_cuenta.store")}}',
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            data:{ cuenta_id:cuenta_id, valor:valor, medio_pago:medio_pago ,observaciones:observacion  },
            success:function(data){
                //alert(data.success);

                var monto_abono = data.monto;
                var numFinal = parseFloat(monto_abono);
                $('#dynamic_field3').append(
                    '<tr id="row3'+data.id+'">'+
                                        ' <td class="custom-tbl" hidden="true"><input class="form-control input-sm" style="width:100%;" type="text"  value="'+data.id+'" id="pr_item'+data.id+'" name="pr_item[]" readonly required></td>'+
                                        ' <td> <p id="fecha_abono'+data.id+'" name="abono_id[]">'+ data.fecha_registro+' </p></td>'  +
                                        ' <td style="text-align:right;"> <p  id="monto'+data.id+'"  name="monto[]"> '+ formatter.format(numFinal.toFixed(2)) +'</p></td>'+
                                        ' <td> <p  id="medio_pago'+data.id+'"  name="medio_pago[]">'+data.medio_pago+'</p></td>'+

                                        ' <td id="items'+data.id+'"  name="encargado[]"> '+data.encargado+'</td>'+

                                        ' <td class="custom-tbl"><!-- <button type="button" id="" class="btn-info btn-sm btn_add" name="add"><span class="fas fa-sync-alt"></span></button> -->'+
                                                        
                                        '     <button type="button" name="remove" id="'+data.id+'" class="btn-danger btn-sm btn_remove_abono"><span class="fas fa-times"></span></button>  </td></tr>'
                    ); 

                   /*  var total_abono = data.abonos;
                    var abonoFinal = parseFloat(total_abono); */

                    var total_saldo = data.saldos;
                    var saldoFinal = parseFloat(total_saldo);

                   // $("#abonos").val(formatter.format(abonoFinal.toFixed(0)));
                    $("#saldo").val(formatter.format(saldoFinal.toFixed(0)));
                    $('#monto').val('');

                    if(data.estado_cuenta == '1'){
                            $("#statusCuenta").html('<span class="badge btn-success" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> Al día </p>  </span>');
                            //$("#estado").val('7');
                    }   

                    if(data.estado_cuenta == '2'){
                            $("#statusCuenta").html('<span class="badge btn-warning" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> Deudor </p>  </span>');
                            //$("#estado").val('7');
                    } 
        
            },

            error: function() {
                console.log("No se ha podido obtener la información");
            }

            });



        }



        $(document).on('click', '.btn_remove_abono', function(){  
            var button_id = $(this).attr("id");

            $.ajax({
            type:'POST',
            url:'{{route("admin.abono_cuenta.destroy")}}',
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            data:{item:button_id},
            success:function(data){
                
                $('#row3'+button_id+'').remove(); 


                if(data.estado_cuenta == 1){
                    $("#statusCuenta").html('<span class="badge btn-success" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> Al día </p>  </span>');
                }   
                if(data.estado_cuenta == 2){
                    $("#statusCuenta").html('<span class="badge btn-warning" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> Deudor </p>  </span>');
                } 

                /* var total_abono = data.abonos;
                var abonoFinal = parseFloat(total_abono);
 */
                var total_saldo = data.saldos;
                var saldoFinal = parseFloat(total_saldo);

               // $("#abonos").val(formatter.format(abonoFinal.toFixed(0)));
                $("#saldo").val(formatter.format(saldoFinal.toFixed(0)));                   
                    
            },
            error: function() {
                console.log("No se ha podido obtener la información");
            }

            });                      
            
        }); 

    </script>


@endsection