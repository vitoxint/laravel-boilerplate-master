@extends('backend.layouts.app')

@section('title','Depósito de materiales' . ' | ' . 'Editar lugar de almacenamiento')

@section('content')


        <div class="card">
        {{ html()->modelForm($deposito, 'PATCH', route('admin.depositos.update', $deposito))->class('form-horizontal')->acceptsFiles()->open() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Depósito de materiales
                            <small class="text-muted">Editar deposito de almacenamiento material</small>
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
                                        ->placeholder('ubicación, local, sucursal, etc')
                                        ->attribute('maxlength', 191)                                   
                                }}
                                                    
                        </div>
                    </div><!--form-group--> 


                    <div class="form-group row">
                        
                        {{ html()->label('Habilitada:')->class('col-md-2 form-control-label')->for('estado_habilitada') }}

                        <div class="col-md-2">
                                <label class="switch switch-label switch-pill switch-success">
                                    @if($deposito->estado_habilitada == 1)
                                        {{ html()->checkbox('estado_habilitada', true)->class('switch-input') }}
                                    @else
                                         {{ html()->checkbox('estado_habilitada', false)->class('switch-input') }}
                                    @endif
                                    <span class="switch-slider" data-checked="SI" data-unchecked="NO"></span>
                                </label>
                        </div><!--col-->                    

                    </div><!--form-group-->  

                    <div class="form-group row">
                        
                        {{ html()->label('Utilizada:')->class('col-md-2 form-control-label')->for('estado_utilizada') }}

                        <div class="col-md-2">
                                <label class="switch switch-label switch-pill switch-success">
                                    @if($deposito->estado_utilizada == 1)
                                        {{ html()->checkbox('estado_utilizada', true)->class('switch-input') }}
                                    @else
                                         {{ html()->checkbox('estado_utilizada', false)->class('switch-input') }}
                                    @endif
                                    <span class="switch-slider" data-checked="SI" data-unchecked="NO"></span>
                                </label>
                        </div><!--col-->                    

                    </div><!--form-group-->   

                        </div><!--col-->
                    </div><!--row-->
                </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.depositos.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
                    </div><!--row-->
                </div><!--row-->
            </div><!--card-footer-->

            {{ html()->closeModelForm() }}    
        </div><!--card-->
    
  
</div>



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