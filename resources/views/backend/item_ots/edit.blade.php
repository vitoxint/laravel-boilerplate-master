@extends('backend.layouts.app')

@section('title','Item OT: '.$trabajo->folio . ' | ' . $item_ot->folio)

@section('content')

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>

<style type="text/css">
    .fileinput-remove,
    .fileinput-upload{
        display: none;
    }

</style>




        <div class="card">
        {{ html()->modelForm($item_ot, 'PATCH', route('admin.item_ots.update', ['item_ot' => $item_ot, 'trabajo' =>  $trabajo]))->class('form-horizontal')->acceptsFiles()->open() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            
                            <small class="text-muted">Editar item: {{$item_ot->folio}}</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                        <div class="col">
                        <div class="form-group row">
                            {{ html()->label('Descripción *')->class('col-md-2 form-control-label')->for('descripcion') }}

                            <div class="col-md-10">
                                {{ html()->textarea('descripcion')
                                    ->class('form-control')
                                    ->placeholder('Descripción principal')
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label('Valor :')->class('col-md-2 form-control-label')->for('') }}
                        
                        {{ html()->label('Cantidad:')->class('col-md-1 form-control-label')->for('cantidad') }}
                            <div class="col-md-1">
                                {{ html()->text('cantidad')
                                    ->class('form-control')
                                    ->value($item_ot->cantidad)
                                    ->attribute('maxlength', 191)                          
                                    ->required() }}
                            </div><!--col-->
                            {{ html()->label('Valor Unitario:')->class('col-md-1 form-control-label')->for('valor_unitario') }}
                            <div class="col-md-2">
                                {{ html()->text('valor_unitario')
                                    ->class('form-control')
                                    ->value($item_ot->valor_unitario)
                                    ->attribute('maxlength', 191)                                   
                                    ->required() }}
                            </div><!--col-->
                            {{ html()->label('Valor Parcial:')->class('col-md-1 form-control-label')->for('valor_parcial') }}
                            <div class="col-md-2">
                                {{ html()->text('valor_parcial')
                                    ->class('form-control')
                                    ->value($item_ot->valor_parcial)
                                    ->attribute('maxlength', 191)                                   
                                     }}
                            </div><!--col-->
                        </div><!--form-group-->


                        <div class="form-group row">
                            {{ html()->label('Detalle y especificaciones')->class('col-md-2 form-control-label')->for('descripcion') }}

                            <div class="col-md-10">
                                {{ html()->textarea('especificaciones')
                                    ->class('form-control')
                                    ->placeholder('información adicional')
                                    ->attribute('maxlength', 191)
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label('Cumplimiento ')->class('col-md-2 form-control-label')->for('') }}

                        {{ html()->label('Estado  :')->class('col-md-1 form-control-label')->for('estado') }}
                            <div class="col-md-2">

                            {{ html()->select('estado',array('1' => 'Sin iniciar', '2' => 'En proceso', '3' =>'Atrasada', '4' => 'Terminada', '5' => 'Entregada',  '6' => 'Anulada'), $item_ot->estado)
                                ->class('form-control')
                                ->attribute('maxlength', 191) 
                                ->required()
                                
                            }}
                            </div><!--col-->

                            {{ html()->label('Fecha inicio :')->class('col-md-1 form-control-label')->for('fecha_inicio') }}

                            <div class="col-md-2">
                                {{ html()->date('fecha_inicio')
                                    ->class('form-control')
                                    ->attribute('maxlength', 191)      
                                    ->autofocus()
                                    
                                    }}
                            </div><!--col-->

                            {{ html()->label('Fecha de termino :')->class('col-md-1 form-control-label')->for('fecha_termino') }}

                            <div class="col-md-2">
                                {{ html()->date('fecha_termino')
                                    ->class('form-control')
                                    ->attribute('maxlength', 191)      
                                    ->autofocus()
                                    
                                    }}
                            </div><!--col-->
                        </div><!--form-group-->

                        </div><!--col-->
                    </div><!--row-->

                </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.orden_trabajos.edit',$item_ot->ordenTrabajo), __('buttons.general.cancel')) }}
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
                            
                            <small class="text-muted">Galería de imágenes</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->
                <hr>

            {{ html()->form('POST', route('admin.imagen_itemot.store',$item_ot))->class('form-horizontal')->acceptsFiles()->open() }}
                
                    <div class="row mt-2 mb-0">
                        <div class="col">
                            <div class="form-group row">
                            {{ html()->label(__('Agregar Imagen :'))->class('col-md-2 form-control-label')->for('url') }}

                                <div class="col-md-6">
                                                                
                                <input name="url" id="url" type="file" accept="image/*" class="form-control" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                                <img id="output" src="" width="auto" height="100">
                                </div><!--col-->
                            </div><!--form-group-->          

                        </div><!--col-->
                    </div><!--row-->

                    <div class="row">
                        <div class="col">
                            {{ form_cancel(route('admin.orden_trabajos.edit',$trabajo), __('buttons.general.cancel')) }}
                    
                            {{ form_submit(__('Agregar imagen')) }}
                        </div><!--col-->
                        {{ html()->form()->close() }}
                    </div><!--row-->

                    <hr>
                    <div class="row">
                        <div class="col-sm-5">
                            <h4 class="card-title mb-0">
                                
                                <small class="text-muted">Imágenes</small>
                            </h4>
                        </div><!--col-->
                    </div><!--row-->
                    <hr>

                    <div class="row">
                        @foreach($item_ot->imagenes as $imagen)
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col">
                            @include('backend.item_ots.includes.actions_imagen', ['imagen' => $imagen])
                            </div>
                            </div>
                            <a href="{{asset('storage/' . $imagen->url)}}" target="_blank">                              
                            <div class="card bg-dark text-white">
                            
                            <img class="card-img" src="{{asset('storage/' . $imagen->url)}}" alt="Card image">
                                <div class="card-img-overlay d-flex flex-column">
                                    <h5 class="card-title"></h5>
                                    <h3 class="card-text font-weight-bold"><span class="mr-auto"></span></h3>
                                    <div class="mt-auto"></div>
                                </div>
                            </div>
                            </a>

                        </div>
                        @endforeach

                
                    </div>    

                    <hr>

                    <div class="row">

                        <div class="col-lg-8 col-sm-12 col-11 main-section">
                           
                                {!! csrf_field() !!}

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
    
  
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

$('#cantidad').on('change', function() {
 
  var total = parseFloat($('#valor_unitario').val())*parseFloat(this.value);
  $('#valor_parcial').val(total);
  
});

$('#valor_unitario').on('change', function() {
  
  var total = parseFloat($('#cantidad').val())*parseFloat(this.value);
  $('#valor_parcial').val(total);
  
});

</script>


<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/locales/es.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>

<script type="text/javascript">

    $("#file-1").fileinput({
        theme: 'fa',
        uploadUrl: "{{route('admin.imagen_itemot.store')}}",
        //"{{ route('admin.get-commune-list') }}?region_id=" + $(this).val(),
        uploadExtraData: function() {
            return {
                _token: $("input[name='_token']").val(),

            };
        },

        allowedFileExtensions: ['jpg', 'png', 'gif','txt','sql','pdf','xlsx'],
        overwriteInitial: false,
        maxFileSize:2000,
        maxFilesNum: 10,
        language : 'es',
        slugCallback: function (filename) {

        return filename.replace('(', '_').replace(']', '_');

        }

    });

</script>




@endsection