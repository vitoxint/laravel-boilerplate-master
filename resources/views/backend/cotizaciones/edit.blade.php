@extends('backend.layouts.app')


@section('title','Cotizaciones' . ' | ' . 'Editar Cotización: '. $cotizacion->folio)

@section('breadcrumb-links')
   

@section('content')
{{ html()->modelForm($cotizacion, 'PATCH', route('admin.cotizaciones.update', $cotizacion))->class('form-horizontal')->acceptsFiles()->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Cotizaciones
                            <small class="text-muted">Editar cotizacion: {{$cotizacion->folio}}</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('Cliente * :'))->class('col-md-2 form-control-label')->for('empresa') }}

                        <div class="col-md-3">                       
                                {{ html()->text('empresa')
                                    ->class('form-control')
                                    ->placeholder('Cliente o empresa')
                                    ->attribute('maxlength', 191)                                   
                                        }}
                    
                        </div><!--col-->

                        {{ html()->label(__('Contacto cliente (opcional):'))->class('col-md-2 form-control-label')->for('contacto') }}

                        <div class="col-md-3">
                                                
                        {{ html()->text('contacto')
                                    ->class('form-control')
                                    ->placeholder('Contacto o persona encargada (opcional)')
                                    ->attribute('maxlength', 191)                                   
                                        }}
                                                    
                        </div>                        

                    </div><!--form-group-->

                 

                    <div class="form-group row">
                        {{ html()->label('Teléfono contacto : ')->class('col-md-2 form-control-label')->for('telefono_contacto') }}

                            <div class="col-md-3">
                                {{ html()->text('telefono_contacto')
                                    ->class('form-control')
                                    ->placeholder('Teléfono contacto(opcional)')
                                    ->attribute('maxlength', 12)                                   
                                     }}
                            </div><!--col-->

                            {{ html()->label('Email (opcional) :')->class('col-md-2 form-control-label')->for('email_contacto') }}

                            <div class="col-md-3">
                                {{ html()->text('email_contacto')
                                    ->class('form-control')
                                    ->placeholder('Email contacto (opcional)')
                                    ->attribute('maxlength', 191)      
                                    ->autofocus() }}
                            </div><!--col-->                            
                        </div><!--form-group-->


                        <div class="form-group row">
                            {{ html()->label('Validez * (días) : ')->class('col-md-2 form-control-label')->for('dias_validez') }}

                            <div class="col-md-1">
                                {{ html()->number('dias_validez')
                                    ->class('form-control')
                                    ->value(30)
                                    ->attribute('maxlength', 191)      
                                    ->autofocus()
                                    
                                    ->required() }}
                            </div><!--col-->

                            {{ html()->label('Estado cotización : ')->class('col-md-2 form-control-label')->for('estado') }}

                            <div class="col-md-2">
                                {{ html()->select('estado',array('1' => 'Vigente', '2' => 'Aceptada', '3' =>'Vencida', '4' => 'Anulada'), $cotizacion->estado)
                                    ->class('form-control')
                                    ->attribute('maxlength', 191) 
                                    ->required()
                                    
                                }}
                            </div><!--col-->                            
                        </div><!--form-group-->  

                        <div class="form-group row">
                            {{ html()->label('Valor Neto :')->class('col-md-2 form-control-label')->for('valor_neto') }}

                            <div class="col-md-2">
                                {{ html()->text('valor_neto')
                                    ->class('form-control')
                                    ->value('$  '. number_format($cotizacion->valor_neto,0, ',' , '.'  ))                                   
                                    ->attribute('maxlength', 191)
                                    ->disabled()      
                                    ->autofocus()
                                    
                                    ->required() }}
                            </div><!--col-->

                            {{ html()->label('IVA (19%) :')->class('col-md-1 form-control-label')->for('iva') }}

                            <div class="col-md-2">
                                {{ html()->text('iva')
                                    ->class('form-control')
                                    ->value('$  '.number_format(($cotizacion->valor_neto * 0.19),0, ',' , '.'  ))      
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
                                    ->value('$  '.number_format(($cotizacion->valor_neto * 1.19),0, ',' , '.'  ))   
                                    ->disabled()        
                                    ->autofocus()
                                    
                                     }}
                            </div><!--col-->

                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Forma de pago')->class('col-md-2 form-control-label')->for('forma_pago') }}

                            <div class="col-md-4">
                                {{ html()->text('forma_pago')
                                    ->class('form-control')
                                    ->placeholder('ej: al contado, crédito, cheque nominativo , transferencia ,etc (opcional)')
                                    ->attribute('maxlength', 191)      
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Condiciones de pago')->class('col-md-2 form-control-label')->for('condicion_pago') }}

                            <div class="col-md-4">
                                {{ html()->text('condicion_pago')
                                    ->class('form-control')
                                    ->placeholder('Agregar condiciones de compra o pago (opcional)')
                                    ->attribute('maxlength', 191)      
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->                                                        

                        <div class="form-group row">
                            {{ html()->label('Observaciones')->class('col-md-2 form-control-label')->for('observaciones') }}

                            <div class="col-md-10">
                                {{ html()->textarea('observaciones (opcional)')
                                    ->class('form-control')
                                    ->placeholder('Observaciones')
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
                    <a href="{{ route('admin.cotizaciones.print', $cotizacion) }}" target="_blank" class="btn btn-default btn-sm btn-bordered" data-toggle="tooltip" data-placement="top" title="Imprimir PDF">
                        <i class="fas fa-file-pdf" style="color:red;"></i> Exportar PDF
                    </a>
                        {{ form_cancel(route('admin.cotizaciones.index'), __('buttons.general.cancel')) }}
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
                            Ítems  <small class="text-muted">Todos los ítems</small>
                        </h4>
                    </div><!--col-->

                </div><!--row-->
                <br>
                <?php 

                if($cotizacion->items_cotizacion->count() == 0){
                    $max_folio = 1;
                }else{
                    $max_folio = $cotizacion->items_cotizacion->max('folio') + 1;
                 } ?>               
                <div class="row">
              
                    <div class="table-responsive">
                        <table class='table table-bordered table-hover' id="tab_logic">
                            <thead>
                                <tr class='info'>
                                    <th style='width:7%;'>Item NO.</th>
                                    <th style='width:7%;'>Cantidad</th>
                                    
                                    <th style='width:40%;'>Descripción</th>
                                    <th style='width:10%;'>Valor Unitario</th>
                                    <th style='width:10%;'>% Descuento</th>
                                    <th style='width:10%;'>Valor ítem</th>
                                    <th style='width:10%;'>Acción</th>
                                </tr>
                            </thead>
                            <thead>
                            @if($cotizacion->items_cotizacion->count() == 0)
                                <tr id="addr0">
                                    <td class="custom-tbl"><input class='form-control input-sm'style='width:100%;' type="text" value="1" id="pr_item0" name="pr_item[]" readonly required></td>
                                    <td class="custom-tbl"><input class='form-control input-sm' style='width:100%;' type="text" id="pr_qty0" oninput='multiply(0);' name="pr_qty[]"></td>                                    
                                    <td class="custom-tbl"><input class='form-control input-sm' style='width:100%;' type="text" id="pr_desc0" name="pr_desc[]"></td>
                                    <td><input class='form-control input-sm' style='width:100%;' type="text" id="pr_cpu0" oninput='multiply(0);' name="pr_cpu[]"></td>
                                    <td><input class='form-control input-sm' style='width:100%;' type="text" id="pr_des0" oninput='multiply(0);' name="pr_des[]"></td>
                                    <td class="custom-tbl"><input class='estimated_cost form-control input-sm' id="pr_cpi0" style='width:100%;' type="text" name="pr_cpi[]" readonly></td>
                                    <td class="custom-tbl"><button type="button" id="0" class="btn-info btn-sm btn_add" name="add"><span class="fas fa-plus"></span></button></td>
                                </tr>
                            @else
                            @foreach($cotizacion->items_cotizacion as $item)
                            <tr id="row{{$item->folio}}">
                                    <td class="custom-tbl"><input class='form-control input-sm'style='width:100%;' type="text" value="{{$item->folio}}" id="pr_item{{$item->folio}}" name="pr_item[]" readonly required></td>
                                    <td class="custom-tbl"><input class='form-control input-sm' style='width:100%;' type="text" value="{{$item->cantidad}}" id="pr_qty{{$item->folio}}" oninput='multiply("{{$item->folio}}");' name="pr_qty[]"></td>                                    
                                    <td class="custom-tbl"><input class='form-control input-sm' style='width:100%;' type="text" value="{{$item->descripcion}}" id="pr_desc{{$item->folio}}" name="pr_desc[]"></td>
                                    <td><input class='form-control input-sm' style='width:100%;' type="text" id="pr_cpu{{$item->folio}}" value="{{$item->valor_unitario}}" oninput='multiply("{{$item->folio}}");' name="pr_cpu[]"></td>
                                    <td><input class='form-control input-sm' style='width:100%;' type="text" id="pr_des{{$item->folio}}" value="{{$item->descuento}}" oninput='multiply("{{$item->folio}}");' name="pr_des[]"></td>
                                    <td class="custom-tbl"><input class='estimated_cost form-control input-sm' id="pr_cpi{{$item->folio}}" value="{{$item->valor_parcial}}" style='width:100%;' type="text" name="pr_cpi[]" readonly></td>
                                    <td class="custom-tbl"><button type="button" id="{{$item->folio}}" class="btn-info btn-sm btn_add" name="add"><span class="fas fa-plus"></span></button>
                                                           <button type="button" name="remove" id="{{$item->folio}}" class="btn-danger btn-sm btn_remove"><span class="fas fa-times"></span></button>
                                    </td>
                                </tr>
                            @endforeach

                            

                            <tr id="addr0">
                                    <td class="custom-tbl"><input class='form-control input-sm'style='width:100%;' type="text" value="{{$max_folio}}" id="pr_item{{$max_folio}}" name="pr_item[]" readonly required></td>
                                    <td class="custom-tbl"><input class='form-control input-sm' style='width:100%;' type="text" id="pr_qty{{$max_folio}}" oninput='multiply("{{$max_folio}}");' name="pr_qty[]"></td>                                    
                                    <td class="custom-tbl"><input class='form-control input-sm' style='width:100%;' type="text" id="pr_desc{{$max_folio}}" name="pr_desc[]"></td>
                                    <td><input class='form-control input-sm' style='width:100%;' type="text" id="pr_cpu{{$max_folio}}" oninput='multiply("{{$max_folio}}");' name="pr_cpu[]"></td>
                                    <td><input class='form-control input-sm' style='width:100%;' type="text" id="pr_des{{$max_folio}}" oninput='multiply("{{$max_folio}}");' name="pr_des[]"></td>
                                    <td class="custom-tbl"><input class='estimated_cost form-control input-sm' id="pr_cpi{{$max_folio}}" style='width:100%;' type="text" name="pr_cpi[]" readonly></td>
                                    <td class="custom-tbl"><button type="button" id="{{$cotizacion->items_cotizacion->max('folio') + 1}}" class="btn-info btn-sm btn_add" name="add"><span class="fas fa-plus"></span></button>
                                    <button type="button" name="remove" id="{{$cotizacion->items_cotizacion->max('folio') + 1}}" class="btn-danger btn-sm btn_remove"><span class="fas fa-times"></span></button></td>
                                </tr>                            

                            @endif

                            </thead>
                            <tbody id="dynamic_field">

                            <tbody>
                            <tfoot>
                                <tr class='info'>
                                    <td style='width:65%;text-align:right;padding:4px;' colspan='5'>Total Neto: $</td>
                                    <td style='padding:0px;'>

                                            <input style='width:100%;' type='text' class='form-control input-sm' id='valor_total' name='valor_total' value='0' readonly required>

                                    </td>

                            </tfoot>

                        </table>
                    </div>              
          
                </div>
  
          </div><!--card-body-->
        </div><!--card-->





  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" /> -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>
  
 

    
    <script type="text/javascript">



    $(document).ready(function(){      
          var postURL = "<?php echo url('addmore'); ?>";
          var i= "{{$max_folio}}";


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
                data:{item:item, qty:qty, desc:desc , cpu:cpu , des:des , cpi:cpi},
                success:function(data){
                    i++;  
                     $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td class="custom-tbl"><input id="pr_item'+i+'" class="form-control input-sm"style="width:100%;" type="text" value="'+i+'" name="pr_item[]" readonly required></td>               <td class="custom-tbl"><input id="pr_qty'+i+'"class="form-control input-sm" style="width:100%;" type="text" oninput="multiply('+i+');" name="pr_qty[]"></td>               <td class="custom-tbl"><input id="pr_desc'+i+'" class="form-control input-sm" style="width:100%;" type="text" name="pr_desc[]"></td>               <td class="custom-tbl"><input id="pr_cpu'+i+'" class="form-control input-sm" style="width:100%;" type="text" oninput="multiply('+i+');" name="pr_cpu[]"></td>               <td class="custom-tbl"><input id="pr_des'+i+'" class="form-control input-sm" style="width:100%;" type="text" oninput="multiply('+i+');" name="pr_des[]"></td>               <td class="custom-tbl"><input id="pr_cpi'+i+'" class="estimated_cost form-control input-sm" style="width:100%;" type="text" name="pr_cpi[]" readonly></td>       <td class="custom-tbl"><button type="button" id="'+i+'" class="btn-info btn-sm btn_add" name="add"><span class="fas fa-plus"></span></button> <button type="button" name="remove" id="'+i+'" class="btn-danger btn-sm btn_remove"><span class="fas fa-times"></span></button></td></tr>');            
                    //alert(data.success);
                     //$('valor_neto').val(data.valor_neto);
                     document.getElementById('valor_neto').value = data.valor_neto;
                     document.getElementById('iva').value = data.iva;
                     document.getElementById('valor_incluido').value = data.total;
                    // $('iva').val(data.iva);
                    // $('valor_incluido').val(data.total);
                    //grandTotal();

                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }

                });           
                       
            });  

          $(document).on('click', '.btn_remove', function(){  
               var button_id = $(this).attr("id");
               
                var item = $("#pr_item" + button_id).val();
                var qty =  $("#pr_qty"  + button_id).val();
                var desc = $('#pr_desc' + button_id).val();
                var cpu =  $("#pr_cpu" + button_id).val();
                var des =  $("#pr_des" + button_id).val();
                var cpi =  $("#pr_cpi" + button_id).val();

               $.ajax({
                type:'POST',
                url:'{{route("admin.item_cotizacions.destroy")}}?id='+ "<?php echo $cotizacion->id; ?>",
                data:{item:item, qty:qty, desc:desc , cpu:cpu , des:des , cpi:cpi },
                success:function(data){
                    
                    $('#row'+button_id+'').remove();  
                     //console.log(data.success);
                     document.getElementById('valor_neto').value = data.valor_neto;
                     document.getElementById('iva').value = data.iva;
                     document.getElementById('valor_incluido').value = data.total;
                     
                    grandTotal();       
                 
                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }

                });                      
               

          });

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });


//          $('#submit').click(function(){            
//               $.ajax({  
//                    url:"",  
//                    method:"POST",  
//                    data:$('#add_item').serialize(),
//                    type:'json',
//
//               });  
//          });  

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
                document.getElementById('valor_total').value = total;
            }
    </script>

@endsection
