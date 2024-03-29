@extends('backend.layouts.app')


@section('title', 'Cotizaciones' . ' | ' .'Crear nueva cotización')

@section('breadcrumb-links')
   

@section('content')
    {{ html()->form('POST', route('admin.cotizaciones.store'))->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Cotizaciones
                            <small class="text-muted">Crear nueva cotización</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('Cliente *'))->class('col-md-2 form-control-label')->for('empresa') }}

                        <div class="col-md-4">                       
                                {{ html()->text('empresa')
                                    ->class('form-control')
                                    ->placeholder('Cliente o empresa')
                                    ->attribute('maxlength', 191)                                   
                                        }}
                    
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('Contacto cliente (opcional)'))->class('col-md-2 form-control-label')->for('contacto') }}

                        <div class="col-md-4">
                                                
                        {{ html()->text('contacto')
                                    ->class('form-control')
                                    ->placeholder('Contacto o persona encargada (opcional)')
                                    ->attribute('maxlength', 191)                                   
                                        }}
                                                    
                        </div>
                    </div><!--form-group--> 

                        <div class="form-group row">
                        {{ html()->label('Teléfono')->class('col-md-2 form-control-label')->for('telefono_contacto') }}

                            <div class="col-md-3">
                                {{ html()->text('telefono_contacto')
                                    ->class('form-control')
                                    ->placeholder('Teléfono contacto(opcional)')
                                    ->attribute('maxlength', 12)                                   
                                     }}
                            </div><!--col-->
                        </div><!--form-group-->


                        <div class="form-group row">
                            {{ html()->label('Email')->class('col-md-2 form-control-label')->for('email_contacto') }}

                            <div class="col-md-3">
                                {{ html()->text('email_contacto')
                                    ->class('form-control')
                                    ->placeholder('Email contacto (opcional)')
                                    ->attribute('maxlength', 191)      
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->                        

                        <div class="form-group row">
                            {{ html()->label('Validez * (días)')->class('col-md-2 form-control-label')->for('dias_validez') }}

                            <div class="col-md-1">
                                {{ html()->number('dias_validez')
                                    ->class('form-control')
                                    ->value(30)
                                    ->attribute('maxlength', 191)      
                                    ->autofocus()
                                    
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->  

                        <div class="form-group row">
                            {{ html()->label('Forma de pago')->class('col-md-2 form-control-label')->for('forma_pago') }}

                            <div class="col-md-4">
                                {{ html()->text('forma_pago')
                                    ->class('form-control')
                                    ->placeholder('ej: al contado, crédito, cheque nominativo , transferencia ,etc (opcional)')
                                    ->value('Al contado')
                                    ->attribute('maxlength', 191)      
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Condiciones de pago')->class('col-md-2 form-control-label')->for('condicion_pago') }}

                            <div class="col-md-4">
                                {{ html()->text('condicion_pago')
                                    ->class('form-control')
                                    ->placeholder('Agregar condiciones de compra o pago (opcional)')
                                    ->value('50% contado junto O/C, saldo contra Entrega')
                                    ->attribute('maxlength', 191)      
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->                                                   

                        <div class="form-group row">
                            {{ html()->label('Observaciones')->class('col-md-2 form-control-label')->for('observaciones') }}

                            <div class="col-md-10">
                                {{ html()->textarea('observaciones')
                                    ->class('form-control')
                                    ->placeholder('Observaciones')
                                    ->attribute('maxlength', 512)
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->                                                 
    

                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.cotizaciones.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit('Continuar') }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js" ></script>

<script>


    $('#telefono_contacto').mask('+56 99 999 99 99');
    
</script>



@endsection
