@extends('backend.layouts.app')

@section('title','Registro de operadores' . ' | ' . 'Editar operador: '.$empleado->codigo)

@section('content')


        <div class="card">
        {{ html()->modelForm($empleado, 'PATCH', route('admin.empleados.update', $empleado))->class('form-horizontal')->acceptsFiles()->open() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Registro de operadores
                            <small class="text-muted">Editar operador: {{$empleado->codigo}}</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                        <div class="col">
                      
                                    <div class="form-group row">
                                        {{ html()->label(__('RUT Operador*'))->class('col-md-2 form-control-label')->for('rut') }}

                                        <div class="col-md-2">                       
                                                {{ html()->text('rut')
                                                    ->class('form-control')
                                                    ->placeholder('RUT,con puntos y con guión')
                                                    ->attribute('maxlength', 12)
                                                    ->required()                                   
                                                }}
                                    
                                        </div><!--col-->
                                    </div><!--form-group-->

                                    <div class="form-group row">
                                        {{ html()->label(__('Nombres *'))->class('col-md-2 form-control-label')->for('nombres') }}

                                        <div class="col-md-5">
                                                                
                                                {{ html()->text('nombres')
                                                        ->class('form-control')
                                                        ->placeholder('Nombres')
                                                        ->attribute('maxlength', 191) 
                                                        ->required()                                  
                                                }}
                                                                    
                                        </div>
                                    </div><!--form-group--> 

                                    <div class="form-group row">
                                        {{ html()->label(__('Apellidos *'))->class('col-md-2 form-control-label')->for('apellidos') }}

                                        <div class="col-md-5">
                                                                
                                                {{ html()->text('apellidos')
                                                        ->class('form-control')
                                                        ->placeholder('Apellidos')
                                                        ->attribute('maxlength', 191)                                                                      
                                                }}
                                                                    
                                        </div>
                                    </div><!--form-group-->   

                                    <div class="form-group row">
                                        {{ html()->label(__('Ocupación/cargo'))->class('col-md-2 form-control-label')->for('ocupacion') }}

                                        <div class="col-md-5">

                                                {{ html()->text('ocupacion')
                                                        ->class('form-control')
                                                        ->placeholder('Función')
                                                        ->attribute('maxlength', 191)
                                                                                    
                                                }}                                                    
                                        </div>
                                    </div><!--form-group-->  
                                    
                                    <div class="form-group row">
                                        {{ html()->label(__('Activo'))->class('col-md-2 form-control-label')->for('estado_activo') }}

                                        <div class="col-md-10">
                                            <label class="switch switch-label switch-pill switch-success">
                                            
                                                {{ html()->checkbox('estado_activo' )->class('switch-input') }}
                                                <span class="switch-slider" data-checked="SÍ" data-unchecked="NO"></span>
                                            </label>
                                        </div><!--col-->
                                    </div><!--form-group-->   

                                </div><!--col-->
                        </div><!--row-->
                    </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.empleados.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
                    </div><!--row-->
                </div><!--row-->
            </div><!--card-footer-->

            {{ html()->closeModelForm() }}    
        </div><!--card-->
    
  
</div>




@endsection