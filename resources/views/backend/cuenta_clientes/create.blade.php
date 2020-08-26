@extends('backend.layouts.app')


@section('title', 'Cuentas cliente (crédito)' . ' | ' .'Registrar nueva cuenta')

@section('breadcrumb-links')
   

@section('content')
    {{ html()->form('POST', route('admin.cuenta_clientes.store'))->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Cuentas cliente (crédito)
                            <small class="text-muted">Registrar nueva cuenta</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('Cliente: '))->class('col-md-2 form-control-label')->for('cliente_id') }}

                        <div class="col-md-6">
                            <select name="cliente_id" id="cliente_id" class="form-control" style="width:100%;" >
                            </select>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('Nombre/Encargado:'))->class('col-md-2 form-control-label')->for('nombre') }}

                        <div class="col-md-6">
                                                
                                {{ html()->text('nombre')
                                        ->class('form-control')
                                        ->placeholder('Nombre o encargado de la cuenta (opcional)')
                                        ->attribute('maxlength', 255)                                   
                                }}
                                                    
                        </div>
                    </div><!--form-group--> 


                    <div class="form-group row">
                        
                        {{ html()->label('Activa:')->class('col-md-2 form-control-label')->for('estado_activa') }}

                        <div class="col-md-3">                       
                                <label class="switch switch-label switch-pill switch-success">
                                {{ html()->checkbox('estado_activa', false)->class('switch-input') }}
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
                        {{ form_cancel(route('admin.cuenta_clientes.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit('Registrar') }}
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
        
        $('#cliente_id').select2({
            placeholder: "Seleccionar cliente...",
            minimumInputLength: 3,
            ajax: {
                url: "{{route('admin.clientes.dataAjax')}}",
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
