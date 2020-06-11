@extends('backend.layouts.app')


@section('title', 'Registro de máquinas' . ' | ' .'Registrar nueva máquina')

@section('breadcrumb-links')
   

@section('content')
    {{ html()->form('POST', route('admin.maquinas.store'))->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Registro de máquinas
                            <small class="text-muted">Registrar nueva máquina</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('Código *'))->class('col-md-2 form-control-label')->for('codigo') }}

                        <div class="col-md-2">                       
                                {{ html()->text('codigo')
                                    ->class('form-control')
                                    ->placeholder('Asignar un código')
                                    ->attribute('maxlength', 14)                                   
                                }}
                    
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('Nombre *'))->class('col-md-2 form-control-label')->for('nombre') }}

                        <div class="col-md-5">
                                                
                                {{ html()->text('nombre')
                                        ->class('form-control')
                                        ->placeholder('Nombre de la máquina ,marca,etc')
                                        ->attribute('maxlength', 191)                                   
                                }}
                                                    
                        </div>
                    </div><!--form-group--> 

<!--                     <div class="form-group row">
                        {{ html()->label(__('Valor hora HHMM'))->class('col-md-2 form-control-label')->for('valor_hora') }}

                        <div class="col-md-1">
                                                
                                {{ html()->number('valor_hora')
                                        ->class('form-control')
                                        ->placeholder('valor HHMM')
                                        ->attribute('maxlength', 191)
                                        ->value(0)                                   
                                }}
                                                    
                        </div>
                    </div> --><!--form-group--> 

<!--                     <div class="form-group row">
                        {{ html()->label('Detalle y especificaciones')->class('col-md-2 form-control-label')->for('especificaciones') }}

                        <div class="col-md-10">
                            {{ html()->textarea('especificaciones')
                                ->class('form-control')
                                ->placeholder('información adicional')
                                ->attribute('maxlength', 191)
                                ->autofocus() }}
                        </div>
                    </div> --><!--form-group-->

                    <div class="form-group row">
                    
                        {{ html()->label('Estado')->class('col-md-2 form-control-label')->for('estado') }}
                            <div class="col-md-2">

                            {{ html()->select('estado',array('1' => 'Disponible', '2' => 'Inhabilitada', '3' =>'En uso', '4' => 'En mantención'))
                                ->class('form-control')
                                ->attribute('maxlength', 191) 
                                ->required()
                                
                            }}
                            </div><!--col-->
                        </div><!--form-group-->   

<!--                         <div class="form-group row">
                        
                            {{ html()->label('Operadores')->class('col-md-2 form-control-label')->for('operadores') }}
                                <div class="col-md-5">
                                    <select name="operadores[]" id="operadores" class="form-control" multiple="multiple" >
                                    </select>
                                </div>
                        </div> --><!--form-group-->                   

                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.maquinas.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit('Registrar') }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}




  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" /> -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>
  
 
 
  <script>
        $.fn.select2.defaults.set('language', 'es');
        
        $('#operadores').select2({
            placeholder: "Seleccionar...",
            minimumInputLength: 3,
            ajax: {
                url: "{{route('admin.empleados.dataAjax')}}",
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
