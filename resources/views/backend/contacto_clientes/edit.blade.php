@extends('backend.layouts.app')

@section('title','Contacto clientes' . ' | ' . 'Editar contacto: '. $contacto->contacto)

@section('content')


        <div class="card">
        {{ html()->modelForm($contacto, 'PATCH', route('admin.contacto_clientes.update', ['contacto' => $contacto, 'cliente' =>  $contacto->cliente]))->class('form-horizontal')->acceptsFiles()->open() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Contacto clientes
                            <small class="text-muted">Editar contacto: {{$contacto->nombre}}</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                        <div class="col">
                        <div class="form-group row">
                            {{ html()->label('Nombre')->class('col-md-2 form-control-label')->for('nombre') }}

                            <div class="col-md-10">
                                {{ html()->text('nombre')
                                    ->class('form-control')
                                    ->placeholder('nombre')
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label('Cargo')->class('col-md-2 form-control-label')->for('funcion_representante') }}

                            <div class="col-md-10">
                                {{ html()->text('funcion_representante')
                                    ->class('form-control')
                                    ->placeholder('ej. ventas, operador, dueño , etc')
                                    ->attribute('maxlength', 191)                                   
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->


                        <div class="form-group row">
                            {{ html()->label(__('Teléfono'))->class('col-md-2 form-control-label')->for('telefono') }}

                            <div class="col-md-3">
                                {{ html()->text('telefono')
                                    ->class('form-control')
                                    ->placeholder(__('+569999999999'))
                                    ->attribute('maxlength', 12)
                                    ->required()
                                     }}
                            </div><!--col-->
                        </div><!--form-group-->

 
                        <div class="form-group row">
                            {{ html()->label('Email')->class('col-md-2 form-control-label')->for('email') }}

                            <div class="col-md-4">
                                {{ html()->email('email')
                                    ->class('form-control')
                                    ->placeholder('usuario@proveedor.dom')
                                    ->attribute('maxlength', 191)
                                     }}
                            </div><!--col-->
                        </div><!--form-group-->

                        </div><!--col-->
                    </div><!--row-->
                </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.clientes.edit',$contacto->cliente), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
                    </div><!--row-->
                </div><!--row-->
            </div><!--card-footer-->

            {{ html()->closeModelForm() }}    
        </div><!--card-->
    
  
</div>


<script src="https://code.jquery.com/jquery-git.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js" ></script>

<script src="{{asset('js/jquery.rut.js')}}" ></script>

<script>

    $('#telefono').mask('+56 99 999 99 99');
    
</script>




@endsection