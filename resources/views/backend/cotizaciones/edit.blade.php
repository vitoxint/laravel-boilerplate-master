@extends('backend.layouts.app')


@section('title','Cotizaciones' . ' | ' . 'Editar Cotización: '. $cotizacion->folio)

@section('breadcrumb-links')
   

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>

<style type="text/css">
    .fileinput-remove,
    .fileinput-upload{
        display: none;

    },
    

</style>


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
                                    ->attribute('maxlength', 191)      
                                    ->autofocus()    
                                    ->required() }}
                            </div><!--col-->

                            <div class="col-md-1">
                               
                            </div><!--col-->

                            {{ html()->label('Estado cotización : ')->class('col-md-1 form-control-label')->for('estado') }}

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
                            {{ html()->label('Forma de pago :')->class('col-md-2 form-control-label')->for('forma_pago') }}

                            <div class="col-md-3">
                                {{ html()->text('forma_pago')
                                    ->class('form-control')
                                    ->placeholder('ej: al contado, crédito, cheque nominativo , transferencia ,etc (opcional)')
                                    ->attribute('maxlength', 191)      
                                    ->autofocus() }}
                            </div><!--col-->

                            {{ html()->label('Condiciones de compra :')->class('col-md-2 form-control-label')->for('condicion_pago') }}

                            <div class="col-md-3">
                                {{ html()->text('condicion_pago')
                                    ->class('form-control')
                                    ->placeholder('Agregar condiciones de compra o pago (opcional)')
                                    ->attribute('maxlength', 191)      
                                    ->autofocus() }}
                            </div><!--col-->

                        </div><!--form-group-->

                                                           

                        <div class="form-group row">
                            {{ html()->label('Observaciones :')->class('col-md-2 form-control-label')->for('observaciones') }}

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

                    <a href="{{ route('admin.cotizaciones.send', $cotizacion) }}" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Enviar cotización">
                        <i class="fas fa-envelope" style="color:green;"></i> Enviar 
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



        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            
                            <small class="text-muted">Galería de Archivos Adjuntos</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->
                <hr>

                    <div class="row">

                        <div class="col-lg-12 col-sm-12 col-12 ">
                           
                                {!! csrf_field() !!}
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">

                                    <div class="file-loading">
                                        <input id="file-1" type="file" name="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="2">
                                    </div>

                                </div>                            
                        </div>
              
                    </div>                  

            </div><!--card-body-->

            <div class="card-footer clearfix">                 
            </div><!--card-footer-->  

        </div><!--card-->       





  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" /> -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/locales/es.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" type="text/javascript"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.0.11/purify.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.7.7/xlsx.core.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  
 

    
    <script type="text/javascript">

        var formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
        });



    $(document).ready(function(){      
          var postURL = "<?php echo url('addmore'); ?>";
          var i= "{{$max_folio}}";

          
/*           $(document).on('click', '.btn_update',function(){
 
                   var up_id = $(this).attr("id"); 
 
                   var item = add_id;
                   var qty =  $("#pr_qty" + up_id).val();
                   var desc=  $('#pr_desc'+ up_id).val();
                   var cpu =  $("#pr_cpu" + up_id).val();
                   var des =  $("#pr_des" + up_id).val();
                   var cpi =  $("#pr_cpi" + up_id).val();
   
   
                   $.ajax({
                   type:'POST',
                   url:'{{route("admin.item_cotizacions.update")}}?id='+ "<?php echo $cotizacion->id; ?>",
                   headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       },
                   data:{item:item, qty:qty , decs:desc cpu:cpu , des:des , cpi:cpi},
                   success:function(data){
   
                       var neto = data.valor_neto;
                       var iva  = data.iva;
                       var total= data.total;
   
                       var netoFinal = parseFloat(neto);
                       var ivaFinal = parseFloat(iva);
                       var totalFinal = parseFloat(total);
   
                       document.getElementById('valor_neto').value = formatter.format(netoFinal.toFixed(0));
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
                       
               });  */


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

                     document.getElementById('valor_neto').value = formatter.format(netoFinal.toFixed(0));
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
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
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


<script type="text/javascript">

var urls = [];
    <?php foreach($cotizacion->imagenes as $imagen){ ?>
          urls.push("<?php echo asset('storage/' . $imagen->url);?>");
                   
    <?php } ?>

    $("#file-1").fileinput({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        theme: 'fa',
        showCaption: true,
        showPreview: true,
        showUpload: true,
        showRemove: false,
        
        initialPreview: urls,
        initialPreviewFileType: 'image', // image is the default and can be overridden in config below
        initialPreviewAsData: true,
       
        initialPreviewConfig: [

            <?php foreach($cotizacion->imagenes as $imagen){ ?>
             <?php 
                $infoPath = pathinfo(asset('storage/'. $imagen->url));
                $extension = $infoPath['extension']; 
             ?>

             { type: "<?php echo $imagen->extension;?>" , size: "<?php echo $imagen->size;?>",  caption: "<?php echo $imagen->image_name;?>", url: "{{route('admin.file_cotizacion.destroy')}}?key="+"<?php echo $imagen->id;?>" , downloadUrl:"<?php echo asset('storage/'. $imagen->url);?>" , key: "<?php echo $imagen->id;?>" ,extra: {id:"<?php echo $imagen->id;?>" ,_token: $("input[name='_token']").val() } },
            
            <?php } ?>
        ],
        uploadUrl: "{{route('admin.file_cotizacion.store')}}?cotizacion_id=" + "<?php echo $cotizacion->id; ?>" ,
        uploadExtraData: function() {
            return {
                _token: $("input[name='_token']").val(),

            };
        },
        
       
         initialPreviewShowDelete:true,
         deleteUrl: "{{route('admin.file_cotizacion.destroy')}}",


        allowedFileExtensions: ['jpg','jpeg','svg','png', 'gif','txt','sql','pdf','xlsx','docx','pptx','dxf','dwg'],
        overwriteInitial: false,
        maxFileSize:10000000000,
        maxFilesNum: 100,
        language : 'es',
        fileType: "any",

        slugCallback: function (filename) {

        return filename.replace('(', '_').replace(']', '_');

        },
        purifyHtml: true,

        


         preferIconicPreview: true, // this will force thumbnails to display icons for following file extensions
        previewFileIconSettings: { // configure your icon file extensions
            'doc': '<i class="fas fa-file-word text-primary"></i>',
            'xls': '<i class="fas fa-file-excel text-success"></i>',
            'ppt': '<i class="fas fa-file-powerpoint text-danger"></i>',
            //'pdf': '<i class="fas fa-file-pdf text-danger"></i>',
            'zip': '<i class="fas fa-file-archive text-muted"></i>',
            'htm': '<i class="fas fa-file-code text-info"></i>',
            //'txt': '<i class="fas fa-file-alt text-info"></i>',
            'mov': '<i class="fas fa-file-video text-warning"></i>',
            'mp3': '<i class="fas fa-file-audio text-warning"></i>',
            'dwg': '<i class="fas fa-pencil-ruler text-secondary"></i>'
            // note for these file types below no extension determination logic 
            // has been configured (the keys itself will be used as extensions)
            //'jpg': '<i class="fas fa-file-image text-danger"></i>', 
            //'gif': '<i class="fas fa-file-image text-muted"></i>', 
            //'png': '<i class="fas fa-file-image text-primary"></i>'    
        },
        previewFileExtSettings: { // configure the logic for determining icon file extensions
            'image': function(ext) {
                return ext.match(/(png|jpg|jpeg|gif)$/i);
            },         
         
            'doc': function(ext) {
                return ext.match(/(doc|docx)$/i);
            },
            'xls': function(ext) {
                return ext.match(/(xls|xlsx)$/i);
            },
            'ppt': function(ext) {
                return ext.match(/(ppt|pptx)$/i);
            },
            'zip': function(ext) {
                return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
            },
            'htm': function(ext) {
                return ext.match(/(htm|html)$/i);
            },
            'txt': function(ext) {
                return ext.match(/(txt|ini|csv|java|php|js|css)$/i);
            },
            'mov': function(ext) {
                return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
            },
            'mp3': function(ext) {
                return ext.match(/(mp3|wav)$/i);
            },
            'dwg': function(ext) {
                return ext.match(/(dwg|dxf)$/i);
            }
        } 

    }).on('filebeforedelete', function() {
        var aborted = !window.confirm('¿ Está seguro que desea eliminar este elemento ?');
        if (aborted) {
            window.alert('Operacion abortada! ' + krajeeGetCount('file-5'));
        };
        return aborted;
    }).on('filedeleted', function() {
        setTimeout(function() {


            window.alert('¿Se ha eliminado el elemento! ' + krajeeGetCount('file-5'));
        }, 900);
    });



    

</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js" ></script>

<script>


    $('#telefono_contacto').mask('+56 99 999 99 99');
    
</script>

@endsection
