@extends('backend.layouts.app')


@section('title', 'Registro de productos' . ' | ' .'Registrar nuevo producto')

@section('breadcrumb-links')
   

@section('content')
    {{ html()->form('POST', route('admin.productos-venta.store'))->class('form-horizontal')->acceptsFiles()->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Catálogo de productos de venta
                            <small class="text-muted">Registrar nuevo producto</small>
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
                            <select id="marca_id" name="marca_id" class="form-control" ></select>
                        </div><!--col-->  

                        {{ html()->label('Tipo de producto:')->class('col-md-1 form-control-label')->for('familia_producto_id') }}
                        <div class="col-md-2">
                            <select id="familia_producto_id" name="familia_producto_id" class="form-control" ></select>
                        </div><!--col-->  

                    </div><!--form-group-->


                    <div class="form-group row" style="padding-top:10px;">

                            {{ html()->label('Precio lista:')->class('col-md-1 form-control-label')->for('precio_lista') }}

                            <div class="col-md-1">
                                {{ html()->text('precio_lista')
                                    ->class('form-control')
                                    ->value(0)                                   
                                    ->attribute('maxlength', 191)                                          
                                    ->autofocus()
                                    ->required()                                   
                                     }}
                            </div><!--col-->

                            {{ html()->label('Stock mínimo:')->class('col-md-1 form-control-label')->for('stock_seguridad') }}

                            <div class="col-md-1">
                                {{ html()->text('stock_seguridad')
                                    ->class('form-control')
                                    ->value(0)      
                                    ->attribute('maxlength', 191)                                            
                                    ->autofocus()
                                    ->required()
                                }}
                            </div><!--col-->


                    </div><!--form-group-->  

                    
                    <div class="form-group row">

                            {{ html()->label('Foto referencial:')->class('col-md-1 form-control-label')->for('imagen_url') }}                      

                            <div class="col-md-10">

                            <img id="output" src="" alt="Imagen referencial" height="180" width="auto">

                            <input name="imagen_url" class="btn btn-primary" id="imagen_url" type="file" accept="image/*"  onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">

                            
                            </div><!--col-->
                            
                    </div><!--form-group-->                                   

                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.productos-venta.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.save')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}




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
