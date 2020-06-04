@extends('backend.layouts.app')

@section('title','Clasificación de procesos' . ' | ' . 'Editar proceso')

@section('content')


        <div class="card">
        {{ html()->modelForm($maquina, 'PATCH', route('admin.maquinas.update', $maquina))->class('form-horizontal')->acceptsFiles()->open() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Registro de máquinas
                            <small class="text-muted">Editar máquina: {{$maquina->codigo}}</small>
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

                    <div class="form-group row">
                        {{ html()->label('Detalle y especificaciones')->class('col-md-2 form-control-label')->for('especificaciones') }}

                        <div class="col-md-10">
                            {{ html()->textarea('especificaciones')
                                ->class('form-control')
                                ->placeholder('información adicional')
                                ->attribute('maxlength', 191)
                                ->autofocus() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">

                        {{ html()->label('Estado  ')->class('col-md-2 form-control-label')->for('estado') }}
                            <div class="col-md-2">

                            {{ html()->select('estado',array('1' => 'Disponible', '2' => 'Inhabilitada', '3' =>'En uso', '4' => 'En mantención'), $maquina->estado)
                                ->class('form-control')
                                ->attribute('maxlength', 191) 
                                ->required()
                                
                            }}
                            </div><!--col-->
                        </div><!--form-group-->    

                        </div><!--col-->
                    </div><!--row-->
                </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.maquinas.index'), __('buttons.general.cancel')) }}
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