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




@endsection