@extends('backend.layouts.app')

@section('title','Mantenimiento de clientes' . ' | ' . 'Editar cliente: '. $cliente->razon_social)

@section('content')


        <div class="card">
        {{ html()->modelForm($cliente, 'PATCH', route('admin.clientes.update', $cliente))->class('form-horizontal')->acceptsFiles()->open() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Administración de clientes
                            <small class="text-muted">Editar cliente: {{$cliente->razon_social}}</small>
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
                                    <option value="{{$cliente->region_id}}" selected>{{$cliente->commune->region->name}}</option>
                                      @foreach($regions as $region)
                                        <option value="{{$region->id}}"> {{$region->name}}</option>
                                      @endforeach
                                </select>
                            </div><!--col-->

                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                    
                                    <select name="commune_id" id="commune_id" class="form-control" >
                                       <option value="{{$cliente->commune_id}}" selected> {{$cliente->commune->name}}</option>
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
                                {{ html()->text('giro_comercial')
                                    ->class('form-control')
                                    ->placeholder(__('Una breve descripción de la empresa o de los productos y servicios ofrecidos'))
                                    ->attribute('maxlength', 1024)
                                     }}
                            </div><!--col-->
                        </div><!--form-group-->   

                        </div><!--col-->
                    </div><!--row-->
                </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.clientes.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
                    </div><!--row-->
                </div><!--row-->
            </div><!--card-footer-->

            {{ html()->closeModelForm() }}    
        </div><!--card-->
    


        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Contactos <small class="text-muted">Todos los contactos</small>
                        </h4>
                    </div><!--col-->

                    <div class="col-sm-7">
                        @include('backend.contacto_clientes.includes.header-buttons')
                    </div><!--col-->
                </div><!--row-->

                <div class="row mt-4">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Cargo</th>                                   
                                    <th>Teléfono</th>
                                    <th>Email</th>         
                                    <th>@lang('labels.general.actions')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cliente->contactos as $contacto)
                                    <tr>
                                        <td>{{ $contacto->nombre }}</td>
                                        <td>{{ $contacto->funcion_representante }}</td>
                                        <td>{{ $contacto->telefono }}</td>
                                        <td>{{ $contacto->email }}</td>                               
                                      
                                        <td class="btn-td">@include('backend.contacto_clientes.includes.actions', ['contacto' => $contacto , 'cliente' => $cliente])</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!--col-->
                </div><!--row-->
                <div class="row">
                    <div class="col-7">
                        <div class="float-left">
                            {!! $cliente->contactos->count() !!} 
                        </div>
                    </div><!--col-->

                    <div class="col-5">
                        <div class="float-right">
                           
                        </div>
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->
        </div><!--card-->


    
</div>



<script src="https://code.jquery.com/jquery-git.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">
    

      $('#region_id').on('change', function() {
        
        var regionID = this.value;  
        
        if(regionID){
            $.ajax({
            //    type:"GET",
            //    url:"{{url('get-commune-list')}}?region_id="+regionID,
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