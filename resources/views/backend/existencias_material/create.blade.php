@extends('backend.layouts.app')


@section('title', 'Deposito de materiales' . ' | ' .'Registrar nuevo lugar de almacenamiento')

@section('breadcrumb-links')
   

@section('content')
    {{ html()->form('POST', route('admin.depositos.store'))->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                                Depósito de materiales
                            <small class="text-muted">Registrar nuevo lugar de almacenamiento</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('Nombre *'))->class('col-md-2 form-control-label')->for('nombre') }}

                        <div class="col-md-4">                       
                                {{ html()->text('nombre')
                                    ->class('form-control')
                                    ->placeholder('Asignar un nombre')
                                    ->attribute('maxlength', 255) 
                                    ->required()                                  
                                }}
                    
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('Ubicación'))->class('col-md-2 form-control-label')->for('ubicacion') }}

                        <div class="col-md-4">
                                                
                                {{ html()->text('ubicacion')
                                        ->class('form-control')
                                        ->placeholder('Descripción o nombre del proceso')
                                        ->attribute('maxlength', 191)                                   
                                }}
                                                    
                        </div>
                    </div><!--form-group--> 


                    <div class="form-group row">
                        
                        {{ html()->label('Habilitada:')->class('col-md-2 form-control-label')->for('estado_habilitada') }}

                        <div class="col-md-2">
                                <label class="switch switch-label switch-pill switch-success">
                                    {{ html()->checkbox('estado_habilitada', true)->class('switch-input') }}
                                    <span class="switch-slider" data-checked="SI" data-unchecked="NO"></span>
                                </label>
                        </div><!--col-->                    

                    </div><!--form-group-->                    

                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.depositos.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit('Añadir') }}
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

    <script>
        $.fn.select2.defaults.set('language', 'es');
        
        $('#maquinas').select2({
            placeholder: "Seleccionar...",
            minimumInputLength: 3,
            ajax: {
                url: "{{route('admin.maquinas.dataAjax')}}",
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
