@extends('backend.layouts.app')

@section('title','Productos de venta' . ' | ' . 'Editar datos del producto')

@section('content')

        <div class="card">
        {{ html()->modelForm($producto, 'PATCH', route('admin.productos-venta.update', $producto))->class('form-horizontal')->acceptsFiles()->open() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Productos de venta
                            <small class="text-muted">Editar producto</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                
                <div class="row mt-4 mb-4">
                    <div class="col">

                    <div class="form-group row">
                        {{ html()->label(__('Código'))->class('col-md-1 form-control-label')->for('codigo') }}

                        <div class="col-md-2">                       
                                {{ html()->text('codigo')
                                    ->class('form-control')
                                    ->placeholder('código interno o del producto')
                                    ->attribute('maxlength', 25)
                                    ->required()                               
                                }}
                    
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('Descripción'))->class('col-md-1 form-control-label')->for('descripcion') }}
                                               
                        <div class="col-md-5">
                            {{ html()->text('descripcion')
                                ->class('form-control')
                                ->placeholder('descripción')                                   
                                ->attribute('maxlength', 191)                                          
                                ->autofocus()
                                ->required()                                   
                            }}
                        </div><!--col-->

                    </div><!--form-group--> 

                    <div class="form-group row">
                        
                        {{ html()->label('Marca:')->class('col-md-1 form-control-label')->for('marca_id') }}
                        <div class="col-md-2">
                            <select id="marca_id" name="marca_id" class="form-control" >
                                <option value="{{$producto->marca_id}}" selected> {{$producto->marca->nombre}} </option>
                            </select>
                        </div><!--col-->  

                        {{ html()->label('Tipo de producto:')->class('col-md-1 form-control-label')->for('familia_producto_id') }}
                        <div class="col-md-2">
                            <select id="familia_producto_id" name="familia_producto_id" class="form-control" >
                                <option value="{{$producto->familia_producto_id}}" selected> {{$producto->familia->nombre}} </option>
                            </select>
                        </div><!--col-->  

                    </div><!--form-group-->


                    <div class="form-group row" style="padding-top:10px;">

                            {{ html()->label('Precio lista:')->class('col-md-1 form-control-label')->for('precio_lista') }}

                            <div class="col-md-1">
                                {{ html()->text('precio_lista')
                                    ->class('form-control')
                                                                    
                                    ->attribute('maxlength', 191)                                          
                                    ->autofocus()
                                    ->required()                                   
                                     }}
                            </div><!--col-->

                            {{ html()->label('Stock mínimo:')->class('col-md-1 form-control-label')->for('stock_seguridad') }}

                            <div class="col-md-1">
                                {{ html()->text('stock_seguridad')
                                    ->class('form-control')
                                       
                                    ->attribute('maxlength', 191)                                            
                                    ->autofocus()
                                    ->required()
                                }}
                            </div><!--col-->


                    </div><!--form-group-->  

                    <div class="form-group row" style="padding-top:10px;">

                            {{ html()->label('Estado stock:')->class('col-md-1 form-control-label')->for('estado_stock') }}

                            <div class="col-md-1" id="status">

                                    @if($producto->stock_seguridad <= $producto->existencias->sum('cantidad') )
                                        <span class="badge btn-success" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Disponible </p>  </span>
                                    
                                    @endif
                                    @if(($producto->stock_seguridad > $producto->existencias->sum('cantidad') ) && ($producto->existencias->sum('cantidad') > 0))
                                        <span class="badge btn-warning" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Crítico </p>  </span>
                                    
                                    @endif
                                    @if($producto->existencias->sum('cantidad') == 0)
                                        <span class="badge btn-danger" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Sin stock </p>  </span>
                                    
                                    @endif

                            </div><!--col-->

                            {{ html()->label('Stock actual:')->class('col-md-1 form-control-label')->for('stock_actual') }}

                            <div class="col-md-1">
                                {{ html()->text('stock_actual')
                                    ->class('form-control')
                                    ->value($producto->existencias->sum('cantidad'))
                                    ->attribute('maxlength', 191)                                            
                                    ->autofocus()
                                    ->required()
                                }}
                            </div><!--col-->


                    </div><!--form-group-->                      

                    
                    <div class="form-group row">

                            {{ html()->label('Foto referencial:')->class('col-md-1 form-control-label')->for('imagen_url') }}                      

                            <div class="col-md-10">

                            <img id="output" src="{{asset('storage/'.$producto->imagen_url)}}" alt="Imagen referencial" height="180" width="auto">

                            <input name="imagen_url" class="btn btn-primary" id="imagen_url" type="file" accept="image/*"  onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">

                            
                            </div><!--col-->
                            
                    </div><!--form-group-->                                   

                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.productos-venta.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
                        <a style="color:white;" href="{{ route('admin.productos-venta.print_etq', $producto) }}" target="_blank" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Imprimir Etiqueta">
                        <i class="fas fa-print" style="color:white;"></i> Etiqueta
                    </a>
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
                            Existencias
                            <small class="text-muted">disponibles</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                
                <div class="row mt-4 mb-4">
                    <div class="col">

                    <div class="form-group row" >

                    {{ html()->label('Añadir depósito:')->class('col-md-1 form-control-label')->for('deposito') }}                      

                    <div class="col-md-3" style="margin-top:20px;">

                        <select id="deposito_id" name="deposito_id" class="form-control" >
                        </select>

                    </div><!--col-->
                    <div style="margin-top:20px;" class="col col-md-3">
                        <button class="btn btn-default btn-sm" onclick="añadir_deposito()"><i class="fas fa-box"></i> Añadir </button>
                    </div>

                    </div><!--form-group--> 
                    <div class="form-group row" style="">

                        <div class="col-md-12">
                            <div id="materiales" class="table-responsive">
                                <table class='table table-bordered table-hover' id="tab_logic">
                                    <thead>
                                        <tr class='info'>
                                            <th style='width:7%;'hidden="true">ID existencia.</th>
                                            <th style='width:41%;'>Depósito</th>        
                                            <th style='width:9%;'>Cantidad</th>
                                            <th style='width:15%;'>Ajustar </th>
                                            <th style='width:9%;'>Estado</th>
                                           
                                            <th style='width:10%;'>Acción</th>
                                        </tr>
                                    </thead>
                                    <thead id="dynamic_field">

                                   

                                    @foreach($producto->existencias as $existencia)
                                    <tr id="row{{$existencia->id}}">
                                            <td class="custom-tbl" hidden="true"><input class='form-control input-sm'style='width:100%;' type="text"  value="{{$existencia->id}}" id="pr_item{{$existencia->id}}" name="pr_item[]" readonly required></td>
                                            <td class="custom-tbl"><input class='form-control input-sm' style='width:100%;' type="text" value="{{$existencia->deposito->nombre}}" id="existencia_id{{$existencia->id}}" oninput='multiply("{{$existencia->id}}");' name="existencia_id[]">
                                                                
                                            </td>  
                                            <td><input class='form-control input-sm' style='width:100%;' type="text" value="{{$existencia->cantidad}}" id="ctd{{$existencia->id}}" oninput='multiply(0);' name="ctd[]"></td>
                                            <td class="custom-tbl" style="text-align:center;"> 

                                              <button type="button" name="restar" id="{{$existencia->id}}" class="btn-default btn-sm btn_restar"><span style="color:red;" class="fas fa-minus"></span></button>
                                              <input class='input-md' style='width:20%; text-align:center;' type="text" value="1" id="num{{$existencia->id}}"  name="num[]">
                                              <button type="button" name="sumar" id="{{$existencia->id}}" class="btn-default btn-sm btn_sumar"><span style="color:green;" class="fas fa-plus"></span></button>

                                            </td>
                                            <td style="text-align:center;" id="estado{{$existencia->id}}"> 
                                            @switch($existencia->cantidad)
                                                @case(0)
                                                <span class="badge btn-danger" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Sin stock </p>  </span>
                                                @break
                                                @default
                                                <span class="badge btn-success" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Disponible </p>  </span>
                                                @break
                                    
                                            @endswitch

                                            </td>
                                            <td class="custom-tbl"><!-- <button type="button" id="{{$existencia->id}}" class="btn-info btn-sm btn_add" name="add"><span class="fas fa-sync-alt"></span></button> -->
                                                            @if($existencia->cantidad == 0)
                                                                <button type="button" name="remove" id="{{$existencia->id}}" class="btn-danger btn-sm btn_remove"><span class="fas fa-times"></span></button>
                                                            @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                    </thead>
                                </table>
                        </div><!--col-->

                        </div><!--form-group-->  
                                

                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                       
                    </div><!--col-->

                    <div class="col text-right">
                        
                    </div><!--row-->
                </div><!--row-->
            </div><!--card-footer-->

           
        </div><!--card-->





  
    </div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" /> -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>
  
 
 
 
<script type="text/javascript">

        $.fn.select2.defaults.set('language', 'es');
        
        $('#marca_id').select2({
            placeholder: "Seleccionar marca...",
            minimumInputLength: 3,
            language :'es',
            tags: true,
            ajax: {
                url: "{{route('admin.marcas.dataAjax')}}",
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


        $('#familia_producto_id').select2({
            placeholder: "Seleccionar tipo...",
            minimumInputLength: 3,
            language :'es',
            tags: true,
            ajax: {
                url: "{{route('admin.familias.dataAjax')}}",
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



        $('#deposito_id').select2({
            placeholder: "Seleccionar depósito...",
            minimumInputLength: 3,
            language :'es',
            //tags: true,
            ajax: {
                url: "{{route('admin.depositos.dataAjax')}}",
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

       
       function añadir_deposito(){

        var deposito_id = $('#deposito_id :selected').val();
           
        var producto_id =  <?php echo $producto->id; ?>;
    
        $.ajax({
        type:'POST',
        url:'{{route("admin.existencia_producto.store")}}?id='+ producto_id,
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        data:{ producto:producto_id, deposito:deposito_id },
        success:function(data){
              
            $('#dynamic_field').append('<tr id="row'+data.id+'" class="dynamic-added"><td class="custom-tbl" hidden="true"><input id="pr_item'+data.id+'" class="form-control input-sm"style="width:100%;" type="text" value="'+data.id+'" name="pr_item[]" readonly required></td>  <td id="existencia_id'+data.id+'" class="custom-tbl"> <input id="existencia_id'+data.id+'"  name="existencia_id[]" class="form-control" value="'+data.deposito+'" / >     </td>         <td class="custom-tbl"><input id="ctd'+data.id+'" class="form-control input-sm" style="width:100%;" type="text" name="ctd[]" value="'+data.cantidad+'"></td>    <td class="custom-tbl" style="text-align:center;"> <button type="button" name="restar" id="'+data.id+'" class="btn-default btn-sm btn_restar"><span style="color:red;" class="fas fa-minus"></span></button><input class="input-md" style="width:20%; text-align:center;" type="text" value="1" id="num'+data.id+'"  name="num[]"><button type="button" name="sumar" id="'+data.id+'" class="btn-default btn-sm btn_sumar"><span style="color:green;" class="fas fa-plus"></span></button></td>      <td style="text-align:center;"><span class="badge btn-danger" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Sin stock </p></span></td>     <td class="custom-tbl"><!--<button type="button" id="'+data.id+'" class="btn-info btn-sm btn_add" hidden="true" name="add"><span class="fas fa-plus"></span></button> --><button type="button" name="remove" id="'+data.id+'" class="btn-danger btn-sm btn_remove"><span class="fas fa-times"></span></button></td></tr>');            
         
        },
        error: function() {
            console.log("No se ha podido obtener la información");
        }

        }); 

       }


       $(document).on('click', '.btn_remove', function(){  
            var button_id = $(this).attr("id");

            $.ajax({
            type:'POST',
            url:'{{route("admin.existencia_producto.destroy")}}',
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            data:{item:button_id},
            success:function(data){
                
                $('#row'+button_id+'').remove();  

                    console.log(data.success);
/*                     document.getElementById('valor_neto').value = data.valor_neto;
                    document.getElementById('iva').value = data.iva;
                    document.getElementById('valor_incluido').value = data.total; */                     
            },
            error: function() {
                console.log("No se ha podido obtener la información");
            }

            });                      
            
        });  


        $(document).on('click', '.btn_sumar', function(){  
           
            var button_id = $(this).attr("id");
            var valor = $("#num"+button_id).val();
           
            $.ajax({
            type:'POST',
            url:'{{route("admin.existencia_producto.sumar")}}',
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            data:{item:button_id, valor:valor},
            success:function(data){
                
                $('#ctd'+button_id).val(data.cantidad);

                if(data.cantidad >=1 ){
                    $("#estado"+button_id).html('<span class="badge btn-success" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Disponible </p>  </span>');
                    $("#stock_actual").val( parseInt( $("#stock_actual").val()) + parseInt(valor)  );
                }  

                if(data.stock_min <= data.stock_actual ){
                    $("#status").html('<span class="badge btn-success" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Disponible </p>  </span>');
                
                }
                if((data.stock_min > data.stock_actual ) && (data.stock_actual > 0)){
                    $("#status").html('<span class="badge btn-warning" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Crítico </p>  </span>');
                
                }
                if(data.stock_actual == 0){
                    $("#status").html('<span class="badge btn-danger" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Sin stock </p>  </span>');
                
                }
                    console.log(data.success);
                    
            },
            error: function() {
                console.log("No se ha podido obtener la información");
            }

            });                      
            
        }); 


        $(document).on('click', '.btn_restar', function(){  
         
            var button_id = $(this).attr("id");
            var valor = $("#num"+button_id).val();

            $.ajax({
            type:'POST',
            url:'{{route("admin.existencia_producto.restar")}}',
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            data:{item:button_id, valor:valor},
            success:function(data){
                
                $('#ctd'+button_id).val(data.cantidad);

                if(data.cantidad == 0 ){
                    $("#estado"+button_id).html('<span class="badge btn-danger" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Sin stock </p>  </span>');
                }  

                var total = parseInt( $("#stock_actual").val()) - parseInt(valor);
                if(total >= 0 ){
                  $("#stock_actual").val( total  );
                }

                if(data.stock_min <= data.stock_actual ){
                    $("#status").html('<span class="badge btn-success" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Disponible </p>  </span>');
                
                }
                if((data.stock_min > data.stock_actual ) && (data.stock_actual > 0)){
                    $("#status").html('<span class="badge btn-warning" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Crítico </p>  </span>');
                
                }
                if(data.stock_actual == 0){
                    $("#status").html('<span class="badge btn-danger" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Sin stock </p>  </span>');
                
                }


                    console.log(data.success);
                    
            },
            error: function() {
                console.log("No se ha podido obtener la información");
            }

            });                      

        }); 



function forceKeyPressUppercase(e)
{
  var charInput = e.keyCode;
  if((charInput >= 97) && (charInput <= 122)) { // lowercase
    if(!e.ctrlKey && !e.metaKey && !e.altKey) { // no modifier key
      var newChar = charInput - 32;
      var start = e.target.selectionStart;
      var end = e.target.selectionEnd;
      e.target.value = e.target.value.substring(0, start) + String.fromCharCode(newChar) + e.target.value.substring(end);
      e.target.setSelectionRange(start+1, start+1);
      e.preventDefault();
    }
  }
}




//document.getElementById("codigo").addEventListener("keypress", forceKeyPressUppercase, false);
//document.getElementById("").addEventListener("keypress", forceKeyPressUppercase, false);

</script>


@endsection