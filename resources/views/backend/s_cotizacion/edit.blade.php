@extends('backend.layouts.app')


@section('title','Solicitudes de cotización' . ' | ' . 'Responder solicitud: '. $cotizacion->id)

@section('breadcrumb-links')
   

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>




{{ html()->modelForm($cotizacion, 'PATCH', route('admin.s_cotizaciones.update', $cotizacion))->class('form-horizontal')->acceptsFiles()->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Solicitudes de cotización
                            <small class="text-muted">Responder solicitud: {{$cotizacion->id}}</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">

                    <div class="form-group row">
                        {{ html()->label(__('Solicitante * :'))->class('col-md-2 form-control-label')->for('nombre_solicitante') }}

                        <div class="col-md-3">                       
                                {{ html()->text('nombre_solicitante')
                                    ->class('form-control')
                                    ->disabled()
                                    ->attribute('maxlength', 191)                                   
                                }}
                    
                        </div><!--col-->

                        {{ html()->label(__('Email:'))->class('col-md-1 form-control-label')->for('email_solicitante') }}

                        <div class="col-md-3">
                                                
                        {{ html()->text('email_solicitante')
                                    ->class('form-control')  
                                    ->attribute('maxlength', 191)
                                    ->disabled()                                   
                        }}
                                                    
                        </div>   

                    </div><!--form-group-->


                    <div class="form-group row">

                        {{ html()->label('Teléfono : ')->class('col-md-2 form-control-label')->for('telefono_solicitante') }}

                        <div class="col-md-3">
                            {{ html()->text('telefono_solicitante')
                                ->class('form-control')
                                ->attribute('maxlength', 12)    
                                ->disabled()                               
                                }}
                        </div><!--col--> 

                        {{ html()->label('Fecha : ')->class('col-md-1 form-control-label')->for('fecha') }}
                        <?php   $fecha_solicitud = new Carbon\Carbon($cotizacion->created_at); ?>
                        <div class="col-md-3">
                            {{ html()->text('fecha')
                                ->class('form-control')
                                ->value($fecha_solicitud->format('d/m/Y H:i'))
                                ->attribute('maxlength', 12)    
                                ->disabled()                               
                                }}
                        </div><!--col--> 

                    </div>

                   
                    <div class="form-group row">
                        {{ html()->label('Validez * (días) : ')->class('col-md-2 form-control-label')->for('validez') }}

                        <div class="col-md-1">
                            {{ html()->number('validez')
                                ->class('form-control')
                                ->attribute('maxlength', 191)      
                                ->autofocus()    
                                ->required() }}
                        </div><!--col-->

                        <div class="col-md-1">
                            
                        </div><!--col-->

                        {{ html()->label('Estado solicitud : ')->class('col-md-1 form-control-label')->for('estado') }}

                        <div class="col-md-2">
                            {{ html()->select('estado',array('1' => 'En espera', '2' => 'Resuelta', '3' =>'Enviada', '4' => 'Vencida'), $cotizacion->estado)
                                ->class('form-control')
                                ->attribute('maxlength', 191) 
                                ->required()
                                
                            }}
                        </div><!--col-->  

                        @if($cotizacion->fecha_envio != null)

                            {{ html()->label('Enviada el: ')->class('col-md-1 form-control-label')->for('fecha_envio') }}
                                <?php   $fecha_envio = new Carbon\Carbon($cotizacion->fecha_envio); ?>
                                <div class="col-md-2">
                                    {{ html()->text('fecha_envio')
                                        ->class('form-control')
                                        ->value($fecha_envio->format('d/m/Y'))
                                        ->attribute('maxlength', 12)    
                                        ->disabled()                               
                                    }}
                            </div><!--col--> 

                        @endif



                    </div><!--form-group-->  


                    <div class="form-group row">
                        {{ html()->label('Valor Neto :')->class('col-md-2 form-control-label')->for('valor_total') }}

                        <div class="col-md-2">
                            {{ html()->text('valor_total')
                                ->class('form-control')
                                ->value('$  '. number_format($cotizacion->valor_total,0, ',' , '.'  ))                                   
                                ->attribute('maxlength', 191)
                                ->disabled()      
                                ->autofocus()
                                
                                ->required() }}
                        </div><!--col-->

                        {{ html()->label('IVA (19%) :')->class('col-md-1 form-control-label')->for('iva') }}

                        <div class="col-md-2">
                            {{ html()->text('iva')
                                ->class('form-control')
                                ->value('$  '.number_format(($cotizacion->valor_total * 0.19),0, ',' , '.'  ))      
                                ->attribute('maxlength', 191)  
                                ->disabled()      
                                ->autofocus()
                                
                                    }}
                        </div><!--col-->

                        {{ html()->label('valor Total :')->class('col-md-1 form-control-label')->for('valor_incluido') }}

                        <div class="col-md-2">
                            {{ html()->text('valor_incluido')
                                ->class('form-control')
                                ->attribute('maxlength', 191)
                                ->value('$  '.number_format(($cotizacion->valor_total * 1.19),0, ',' , '.'  ))   
                                ->disabled()        
                                ->autofocus()
                                
                                    }}
                        </div><!--col-->

                    </div><!--form-group-->
 
                    <div class="form-group row">
                            
                        {{ html()->label('Mensaje solicitud :')->class('col-md-2 form-control-label')->for('mensaje') }}

                        <div class="col-md-10">
                            {{ html()->textarea('mensaje')
                                ->class('form-control')                                   
                                ->attribute('maxlength', 512)
                                ->autofocus() }}
                        </div><!--col-->

                    </div> 
                                                           

                    <div class="form-group row">
                        {{ html()->label('Mensaje respuesta :')->class('col-md-2 form-control-label')->for('mensaje_respuesta') }}

                        <div class="col-md-10">
                            {{ html()->textarea('mensaje_respuesta')
                                ->class('form-control')
                                ->placeholder('Mensaje respuesta')
                                ->attribute('maxlength', 512)
                                ->autofocus() }}
                        </div><!--col-->
                    </div><!--form-group-->                                                 
    

                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                    <a href="{{ route('admin.s_cotizaciones.print', $cotizacion) }}" target="_blank" class="btn btn-default btn-sm btn-bordered" data-toggle="tooltip" data-placement="top" title="Imprimir PDF">
                        <i class="fas fa-file-pdf" style="color:red;"></i> Exportar PDF
                    </a>

                    <a href="{{ route('admin.s_cotizaciones.send', $cotizacion) }}" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Enviar cotización">
                        <i class="fas fa-envelope" style="color:green;"></i> Enviar 
                    </a> 

                        {{ form_cancel(route('admin.s_cotizaciones.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}




    <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Ítems solicitados
                        </h4>
                    </div><!--col-->

                </div><!--row-->
                <br>
             
                <div class="row">
              
                    <div class="table-responsive">
                        <table class='table table-bordered table-hover' id="tab_logic">
                            <thead>
                                <tr class='info'>
                                    <th style='width:12%;'>Cod.</th>
                                    <th style='width:7%;'>Cantidad</th>                                   
                                    <th style='width:40%;'>Descripción</th>
                                    <th style='width:10%;'>Valor Unitario</th>
                                    <th style='width:10%;'>% Descuento</th>
                                    <th style='width:10%;'>Valor ítem</th>
                                    <th style='width:10%;'>Acción</th>
                                </tr>
                            </thead>
                            <thead>

                            @foreach($cotizacion->itemsSolicitud as $item)
                                <tr id="row{{$item->id}}">
                                    <td class="custom-tbl"><input class='form-control input-sm'style='width:100%;' type="text" value="{{$item->producto->codigo}}" id="pr_item{{$item->id}}" name="pr_item[]" readonly required></td>
                                    <td class="custom-tbl"><input class='form-control input-sm' style='width:100%;' type="text" value="{{$item->cantidad}}" id="pr_qty{{$item->id}}" oninput='multiply("{{$item->id}}");' name="pr_qty[]" readonly></td>                                    
                                    <td class="custom-tbl"><input class='form-control input-sm' style='width:100%;' type="text" value="{{$item->producto->descripcion}}" id="pr_desc{{$item->id}}" name="pr_desc[]"></td>
                                    <td><input class='form-control input-sm' style='width:100%;' type="text" id="pr_cpu{{$item->id}}" value="{{$item->valor_unitario}}" placeholder="{{$item->producto->precio_lista}}" oninput='multiply("{{$item->id}}");' name="pr_cpu[]"></td>
                                    <td><input class='form-control input-sm' style='width:100%;' type="text" id="pr_des{{$item->id}}" value="{{$item->descuento}}" oninput='multiply("{{$item->id}}");' name="pr_des[]"></td>
                                    <td class="custom-tbl"><input class='estimated_cost form-control input-sm' id="pr_cpi{{$item->id}}" value="{{$item->valor_total}}" style='width:100%;' type="text" name="pr_cpi[]" readonly></td>
                                    <td class="custom-tbl"><button type="button" id="{{$item->id}}" class="btn-info btn-sm btn_update" name="update"><span class="fas fa-sync"></span></button>
                                                          <!--  <button type="button" name="remove" id="{{$item->id}}" class="btn-danger btn-sm btn_remove"><span class="fas fa-times"></span></button> -->
                                    </td>
                                </tr>
                            @endforeach


                            </thead>
<!--                             <tbody id="dynamic_field">

                            <tbody> -->
                            <!-- <tfoot>
                                <tr class='info'>
                                    <td style='width:65%;text-align:right;padding:4px;' colspan='5'>Total Neto: $</td>
                                    <td style='padding:0px;'>

                                            <input style='width:100%;' type='text' class='form-control input-sm' id='valor_total' name='super_total' value='0' readonly required>

                                    </td>

                            </tfoot> -->

                        </table>
                    </div>              
          
                </div>
  
          </div><!--card-body-->
        </div><!--card-->






<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" type="text/javascript"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.0.11/purify.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.7.7/xlsx.core.min.js"></script>


  
 
    
    <script type="text/javascript">

        var formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
        });



    $(document).ready(function(){      
          
        $(document).on('click', '.btn_update',function(){

            var add_id = $(this).attr("id"); 

                var item = add_id;
                var qty =  $("#pr_qty"  + add_id).val();
                //var desc = $('#pr_desc' + add_id).val();
                var cpu =  $("#pr_cpu" + add_id).val();
                var des =  $("#pr_des" + add_id).val();
                var cpi =  $("#pr_cpi" + add_id).val();


                $.ajax({
                type:'POST',
                url:'{{route("admin.item_scotizacion.update")}}?id='+ "<?php echo $cotizacion->id; ?>",
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                data:{item:item, qty:qty , cpu:cpu , des:des , cpi:cpi},
                success:function(data){
                   // i++;  
                   //$('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td class="custom-tbl"><input id="pr_item'+i+'" class="form-control input-sm"style="width:100%;" type="text" value="'+i+'" name="pr_item[]" readonly required></td>               <td class="custom-tbl"><input id="pr_qty'+i+'"class="form-control input-sm" style="width:100%;" type="text" oninput="multiply('+i+');" name="pr_qty[]"></td>               <td class="custom-tbl"><input id="pr_desc'+i+'" class="form-control input-sm" style="width:100%;" type="text" name="pr_desc[]"></td>               <td class="custom-tbl"><input id="pr_cpu'+i+'" class="form-control input-sm" style="width:100%;" type="text" oninput="multiply('+i+');" name="pr_cpu[]"></td>               <td class="custom-tbl"><input id="pr_des'+i+'" class="form-control input-sm" style="width:100%;" type="text" oninput="multiply('+i+');" name="pr_des[]"></td>               <td class="custom-tbl"><input id="pr_cpi'+i+'" class="estimated_cost form-control input-sm" style="width:100%;" type="text" name="pr_cpi[]" readonly></td>       <td class="custom-tbl"><button type="button" id="'+i+'" class="btn-info btn-sm btn_add" name="add"><span class="fas fa-plus"></span></button> <button type="button" name="remove" id="'+i+'" class="btn-danger btn-sm btn_remove"><span class="fas fa-times"></span></button></td></tr>');            
                    //alert(data.success);
                    //$('valor_neto').val(data.valor_neto);

                    var neto = data.valor_neto;
                    var iva  = data.iva;
                    var total= data.total;

                    var netoFinal = parseFloat(neto);
                    var ivaFinal = parseFloat(iva);
                    var totalFinal = parseFloat(total);

                    document.getElementById('valor_total').value = formatter.format(netoFinal.toFixed(0));
                    document.getElementById('iva').value = formatter.format(ivaFinal.toFixed(0));
                    document.getElementById('valor_incluido').value = formatter.format(totalFinal.toFixed(0));
                    // $('iva').val(data.iva);
                    // $('valor_incluido').val(data.total);
                    //grandTotal();

                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }

                });           
                    
            });  





          $(document).on('click', '.btn_add',function(){

            var add_id = $(this).attr("id"); 

                var item = $("#pr_item" + add_id).val();
                var qty =  $("#pr_qty"  + add_id).val();
                var desc = $('#pr_desc' + add_id).val();
                var cpu =  $("#pr_cpu" + add_id).val();
                var des =  $("#pr_des" + add_id).val();
                var cpi =  $("#pr_cpi" + add_id).val();


                $.ajax({
                type:'POST',
                url:'{{route("admin.item_cotizacions.store")}}?id='+ "<?php echo $cotizacion->id; ?>",
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                data:{item:item, qty:qty, desc:desc , cpu:cpu , des:des , cpi:cpi},
                success:function(data){
                    i++;  
                     $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td class="custom-tbl"><input id="pr_item'+i+'" class="form-control input-sm"style="width:100%;" type="text" value="'+i+'" name="pr_item[]" readonly required></td>               <td class="custom-tbl"><input id="pr_qty'+i+'"class="form-control input-sm" style="width:100%;" type="text" oninput="multiply('+i+');" name="pr_qty[]"></td>               <td class="custom-tbl"><input id="pr_desc'+i+'" class="form-control input-sm" style="width:100%;" type="text" name="pr_desc[]"></td>               <td class="custom-tbl"><input id="pr_cpu'+i+'" class="form-control input-sm" style="width:100%;" type="text" oninput="multiply('+i+');" name="pr_cpu[]"></td>               <td class="custom-tbl"><input id="pr_des'+i+'" class="form-control input-sm" style="width:100%;" type="text" oninput="multiply('+i+');" name="pr_des[]"></td>               <td class="custom-tbl"><input id="pr_cpi'+i+'" class="estimated_cost form-control input-sm" style="width:100%;" type="text" name="pr_cpi[]" readonly></td>       <td class="custom-tbl"><button type="button" id="'+i+'" class="btn-info btn-sm btn_add" name="add"><span class="fas fa-plus"></span></button> <button type="button" name="remove" id="'+i+'" class="btn-danger btn-sm btn_remove"><span class="fas fa-times"></span></button></td></tr>');            
                    //alert(data.success);
                     //$('valor_neto').val(data.valor_neto);

                    var neto = data.valor_neto;
                    var iva  = data.iva;
                    var total= data.total;

                    var netoFinal = parseFloat(neto);
                    var ivaFinal = parseFloat(iva);
                    var totalFinal = parseFloat(total);

                     document.getElementById('valor_total').value = formatter.format(netoFinal.toFixed(0));
                     document.getElementById('iva').value = formatter.format(ivaFinal.toFixed(0));
                     document.getElementById('valor_incluido').value = formatter.format(totalFinal.toFixed(0));

                     alert('valor actualizado')
                    // $('iva').val(data.iva);
                    // $('valor_incluido').val(data.total);
                    //grandTotal();

                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }

                });           
                       
            });  

/*           $(document).on('click', '.btn_remove', function(){  
               var button_id = $(this).attr("id");
               
                var item = $("#pr_item" + button_id).val();
                var qty  = $("#pr_qty"  + button_id).val();
                var desc = $('#pr_desc' + button_id).val();
                var cpu  = $("#pr_cpu"  + button_id).val();
                var des  = $("#pr_des"  + button_id).val();
                var cpi  = $("#pr_cpi"  + button_id).val();

               $.ajax({
                type:'POST',
                url:'{{route("admin.item_cotizacions.destroy")}}?id='+ "<?php echo $cotizacion->id; ?>",
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                data:{item:item, qty:qty, desc:desc , cpu:cpu , des:des , cpi:cpi },
                success:function(data){
                    
                    $('#row'+button_id+'').remove();  
                    
                     document.getElementById('valor_neto').value = data.valor_neto;
                     document.getElementById('iva').value = data.iva;
                     document.getElementById('valor_incluido').value = data.total;
                     
                    grandTotal();       
                 
                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }

                });                      
               

          }); */

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
 

        });




    </script>
    
    
    <script type="text/javascript">
        function multiply(id)
            {
                var total1 = parseFloat( parseFloat($('#pr_qty'+id).val()) - ( parseFloat($('#pr_qty'+id).val()) * ( parseFloat($('#pr_des'+id).val()) /100 ) ) ) * parseFloat($('#pr_cpu'+id).val());
                $("input[id=pr_cpi" + id + "]").val(total1);
                grandTotal();
            }
        function grandTotal()
            {
                var items = document.getElementsByClassName("estimated_cost");
                var itemCount = items.length;
                var total = 0;
                for(var i = 0; i < itemCount; i++)
                {
                    total = total +  parseFloat(items[i].value);
                }
                //document.getElementById('super_total').value = total;
            }
    </script>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js" ></script>

<script>


    $('#telefono_solicitante').mask('+56 99 999 99 99');
    
</script>

@endsection
