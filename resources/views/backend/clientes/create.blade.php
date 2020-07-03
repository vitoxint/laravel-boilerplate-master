@extends('backend.layouts.app')

@section('title', 'Administración de clientes' . ' | ' .'Registrar nuevo cliente')

@section('breadcrumb-links')
    @include('backend.clientes.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->form('POST', route('admin.clientes.store'))->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Administración de clientes
                            <small class="text-muted">Registrar nuevo cliente</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label('Razón social')->class('col-md-2 form-control-label')->for('razon_social') }}

                            <div class="col-md-10">
                                {{ html()->text('razon_social')
                                    ->class('form-control')
                                    ->placeholder('nombre o razón social')
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label('RUT')->class('col-md-2 form-control-label')->for('rut_cliente') }}

                            <div class="col-md-3">
                                {{ html()->text('rut_cliente')
                                    ->class('form-control')
                                    ->placeholder('RUT ej: 12.345.678-9')
                                    ->attribute('maxlength', 12)                                   
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->


                        <div class="form-group row">
                            {{ html()->label('Dirección')->class('col-md-2 form-control-label')->for('direccion') }}

                            <div class="col-md-10">
                                {{ html()->text('direccion')
                                    ->class('form-control')
                                    ->placeholder('dirección , calle/avda + numero')
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->                        

                        
                        <div class="form-group row">
                        {{ html()->label(__('Región/Comuna *'))->class('col-md-2 form-control-label')->for('region_id') }}

                            <div class="col-md-4">
                                <select id="region_id" name="region_id" class="form-control" >
                                        <option value="" selected disabled>Seleccione</option>
                                        @foreach($regions as $region)
                                            <option value="{{$region->id}}"> {{$region->name}}</option>
                                        @endforeach
                                </select>
                            </div><!--col-->

                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                    
                                    <select name="commune_id" id="commune_id" class="form-control" >
                                    </select>
                                                       
                            </div>

                        </div><!--form-group--> 

              

                        <div class="form-group row">
                            {{ html()->label(__('Teléfono'))->class('col-md-2 form-control-label')->for('telefono') }}

                            <div class="col-md-4">
                                {{ html()->text('telefono')
                                    ->class('form-control')
                                    ->placeholder(__('+569999999999'))
                                    ->attribute('maxlength', 12)
                                    ->required()
                                     }}
                            </div><!--col-->
                        </div><!--form-group-->

                         <div class="form-group row">
                            {{ html()->label(__('Celular/WhatsApp'))->class('col-md-2 form-control-label')->for('celular') }}

                            <div class="col-md-4">
                                {{ html()->text('celular')
                                    ->class('form-control')
                                    ->placeholder(__('+569999999999'))
                                    ->attribute('maxlength', 12)
                                     }}
                            </div><!--col-->
                        </div><!--form-group-->  



                        <div class="form-group row">
                            {{ html()->label('Email')->class('col-md-2 form-control-label')->for('email') }}

                            <div class="col-md-10">
                                {{ html()->email('email')
                                    ->class('form-control')
                                    ->placeholder('usuario@proveedor.dom')
                                    ->attribute('maxlength', 191)
                                     }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('Giro comercial'))->class('col-md-2 form-control-label')->for('giro_comercial') }}

                            <div class="col-md-10">
                                {{ html()->textarea('giro_comercial')
                                    ->class('form-control')
                                    ->placeholder(__('Una breve descripción de la empresa o de los productos y servicios ofrecidos'))
                                    ->attribute('maxlength', 1024)
                                     }}
                            </div><!--col-->
                        </div><!--form-group--> 

                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.clientes.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}




<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js" ></script>

<script src="{{asset('js/jquery.rut.js')}}" ></script>

<script>

    $("#rut_cliente")
    .rut({formatOn: 'keyup', validateOn: 'keyup'})
    .on('rutInvalido', function(){ 
        $(this).parents(".control-group").addClass("error")
    })
    .on('rutValido', function(){ 
        $(this).parents(".control-group").removeClass("error")
    });

    $('#telefono').mask('+56 99 999 99 99');
    $('#celular').mask('+56 9 999 99 999');
</script>



<script type="text/javascript">
    

      $('#region_id').on('change', function() {
        
        var regionID = this.value;  
        
        if(regionID){
            $.ajax({
            //    type:"GET",
            //    url:"{{url('admin.get-commune-list')}}?region_id="+regionID,
                url: "{{ route('admin.get-commune-list') }}?region_id=" + $(this).val(),
                method: 'GET',
               success:function(res){               
                if(res){
                    $("#commune_id").empty();
                    $("#commune_id").append('<option>Seleccione</option>');
                    $.each(res,function(key,value){
                        $("#commune_id").append('<option value="'+key+'">'+value+'</option>');
                    });

                }else{
                   $("#commune_id").empty();
                }
               }
            });
        }else{
            $("#commune_id").empty();
          
        }      
       });
</script>


@endsection
