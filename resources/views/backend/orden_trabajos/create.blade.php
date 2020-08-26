@extends('backend.layouts.app')


@section('title', 'Ordenes de Trabajo' . ' | ' .'Registrar nueva OT')

@section('breadcrumb-links')
    @include('backend.orden_trabajos.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->form('POST', route('admin.orden_trabajos.store'))->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Ordenes de Trabajo
                            <small class="text-muted">Registrar nueva OT</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('Cliente *'))->class('col-md-2 form-control-label')->for('cliente_id') }}

                        <div class="col-md-4">                       
                            <select id="cliente_id" name="cliente_id" class="form-control" >                                       
                            </select>
                    
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('Contacto cliente *'))->class('col-md-2 form-control-label')->for('representante_id') }}

                        <div class="col-md-4">
                                                
                                <select name="representante_id" id="representante_id" class="form-control" >

                                </select>
                                                    
                        </div>

                        <div class="col-md-2">
                                                
                            <a href="{{ route('admin.clientes.index') }}" class="btn btn-default btn-md"><i class="fas fa-plus"></i> Ir a clientes</a>
                                                    
                        </div>


                    </div><!--form-group--> 

                        <div class="form-group row">
                        {{ html()->label('Cotización')->class('col-md-2 form-control-label')->for('cotizacion') }}

                            <div class="col-md-3">
                                {{ html()->text('cotizacion')
                                    ->class('form-control')
                                    ->placeholder('Cotización referencia (opcional)')
                                    ->attribute('maxlength', 191)                                   
                                     }}
                            </div><!--col-->
                        </div><!--form-group-->


                        <div class="form-group row">
                            {{ html()->label('Orden compra')->class('col-md-2 form-control-label')->for('orden_compra') }}

                            <div class="col-md-3">
                                {{ html()->text('orden_compra')
                                    ->class('form-control')
                                    ->placeholder('orden compra referencia (opcional)')
                                    ->attribute('maxlength', 191)      
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->                        

                        <div class="form-group row">
                            {{ html()->label('Fecha compromiso entrega')->class('col-md-2 form-control-label')->for('entrega_estimada') }}

                            <div class="col-md-2">
                                {{ html()->date('entrega_estimada')
                                    ->class('form-control')
                                    ->attribute('maxlength', 191)      
                                    ->autofocus()
                                    
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->                           
    

                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.orden_trabajos.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit('Continuar') }}
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
            placeholder: "Seleccionar...",
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


<script type="text/javascript">
    

    $('#cliente_id').on('change', function() {
      
      var clienteID = this.value;  
      
      if(clienteID){
          $.ajax({
          //    type:"GET",
          //    url:"{{url('admin.get-commune-list')}}?region_id="+regionID,
              url: "{{ route('admin.get-contactos-list') }}?cliente_id=" + $(this).val(),
              method: 'GET',
             success:function(res){               
              if(res){
                  $("#representante_id").empty();
                  //$("#representante_id").append('<option>Seleccione</option>');
                  $.each(res,function(key,value){
                      $("#representante_id").append('<option value="'+key+'">'+value+'</option>');
                  });

              }else{
                 $("#representante_id").empty();
              }
             }
          });
      }else{
          $("#commune_id").empty();
        
      }      
     });
</script>



@endsection
