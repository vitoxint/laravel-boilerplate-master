@extends('backend.layouts.app')

@section('title','Clasificación de procesos' . ' | ' . 'Editar proceso')

@section('content')


        <div class="card">
        {{ html()->modelForm($proceso, 'PATCH', route('admin.procesos.update', $proceso))->class('form-horizontal')->acceptsFiles()->open() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Clasificación de procesos
                            <small class="text-muted">Editar proceso: {{$proceso->codigo}}</small>
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
                        {{ html()->label(__('Descripción *'))->class('col-md-2 form-control-label')->for('descripcion') }}

                        <div class="col-md-5">
                                                
                                {{ html()->text('descripcion')
                                        ->class('form-control')
                                        ->placeholder('Descripción o nombre del proceso')
                                        ->attribute('maxlength', 191)                                   
                                }}
                                                    
                        </div>
                    </div><!--form-group--> 

                    <div class="form-group row">
                        
                        {{ html()->label('Valorización:')->class('col-md-2 form-control-label')->for('proceso_id') }}

                        {{ html()->label('Modo Valorización:')->class('col-md-1 form-control-label')->for('tipo_valorizacion') }}
                        <div class="col-md-2">

                            {{ html()->select('tipo_valorizacion',array('1' => 'Por Hora Máquina (HM)', '2' => 'Por Kilogramo', '3' =>'Por Operación o Carga'), $proceso->tipo_valorizacion)
                                ->class('form-control')
                                ->attribute('maxlength', 191) 
                                ->required()
                                
                            }}
                        </div><!--col-->

                        {{ html()->label('Valor Unitario:')->class('col-md-1 form-control-label')->for('valor_unitario') }}
                        <div class="col-md-2">

                            {{ html()->number('valor_unitario')
                                    ->class('form-control')
                                    ->placeholder('$$')
                                    
                                    ->attribute('maxlength', 14)
                                    ->required()                                   
                            }}
                        </div><!--col-->                        

                    </div><!--form-group-->                       

                    <div class="form-group row">                    
                        {{ html()->label('Máquinas asignadas')->class('col-md-2 form-control-label')->for('maquinas') }}
                            <div class="col-md-5">
                                <select name=maquinas[]" id="maquinas" class="form-control" multiple="multiple" >
                                @foreach($proceso->proceso_has_maquina as $maquina)
                                <option value="{{$maquina->maquina->id}}" selected>{{$maquina->maquina->codigo. ': '.$maquina->maquina->nombre}}    </option>

                                @endforeach
                                </select>
                            </div><!--col-->
                        </div><!--form-group-->     

                        </div><!--col-->
                    </div><!--row-->
                </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.procesos.index'), __('buttons.general.cancel')) }}
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