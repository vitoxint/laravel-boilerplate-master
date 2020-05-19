@extends('backend.layouts.app')

@section('title','Item OT: '.$trabajo->folio . ' | ' . $item_ot->folio)

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
                            
                            <small class="text-muted">Galería de Archivos Adjuntos</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->
                <hr>

                    <div class="row">

                        <div class="col-lg-12 col-sm-12 col-12 main-section">
                           
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.0.11/purify.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.7.7/xlsx.core.min.js"></script>




<script type="text/javascript">

var urls = [];
    <?php foreach($item_ot->imagenes as $imagen){ ?>
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

            <?php foreach($item_ot->imagenes as $imagen){ ?>
             <?php 
                $infoPath = pathinfo(asset('storage/'. $imagen->url));
                $extension = $infoPath['extension']; 
             ?>

             { type: "<?php echo $imagen->extension;?>" , size: "<?php echo $imagen->size;?>",  caption: "<?php echo $imagen->image_name;?>", url: "{{route('admin.imagen_itemot.destroy')}}?key="+"<?php echo $imagen->id;?>"  , downloadUrl:"<?php echo asset('storage/'. $imagen->url);?>" , key: "<?php echo $imagen->id;?>" ,extra: {id:"<?php echo $imagen->id;?>"} },
            
            <?php } ?>
        ],
        uploadUrl: "{{route('admin.imagen_itemot.store')}}?itemot_id=" + "<?php echo $item_ot->id; ?>" ,
        uploadExtraData: function() {
            return {
                _token: $("input[name='_token']").val(),

            };
        },
        
       
         initialPreviewShowDelete:true,
         deleteUrl: "{{route('admin.imagen_itemot.destroy')}}",


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

<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>


@endsection