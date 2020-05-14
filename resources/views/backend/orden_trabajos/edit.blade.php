@extends('backend.layouts.app')

@section('title','Ordenes de Trabajo' . ' | ' . 'Editar OT: '. $trabajo->folio)

@section('content')


        <div class="card">
        {{ html()->modelForm($trabajo, 'PATCH', route('admin.orden_trabajos.update', $trabajo))->class('form-horizontal')->acceptsFiles()->open() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Ordenes de Trabajo
                            <small class="text-muted">Editar OT: {{$trabajo->folio}}</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                        <div class="col">

                    <div class="form-group row">
                        {{ html()->label(__('Cliente '))->class('col-md-2 form-control-label')->for('cliente_id') }}

                        <div class="col-md-6">                       
                            
                            {{ html()->text('cliente_id')
                                    ->class('form-control')
                                    ->value($trabajo->cliente->razon_social)
                                    ->attribute('maxlength', 191)
                                    ->disabled()                                   
                                     }}
                    
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('Contacto cliente'))->class('col-md-2 form-control-label')->for('representante_id') }}

                        <div class="col-md-6">
                            @if($trabajo->representante)
                                                
                            {{ html()->text('representante_id')
                                        ->class('form-control')
                                        ->value($trabajo->representante->nombre)
                                        ->attribute('maxlength', 191)
                                        ->disabled()                                   
                                        }}
                                        
                            @else
              
                            {{ html()->text('representante_id')
                                        ->class('form-control')
                                        ->value('')
                                        ->attribute('maxlength', 191)
                                        ->disabled()                                   
                                        }}              
                            
                            @endif
                                                    
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
                            {{ html()->label('Estado')->class('col-md-2 form-control-label')->for('estado') }}

                            <div class="col-md-2">
                                {{ html()->select('estado',array('1' => 'Sin iniciar', '2' => 'En proceso', '3' =>'Atrasada', '4' => 'Terminada', '5' => 'Entregada',  '6' => 'Anulada'), $trabajo->estado)
                                    ->class('form-control')
                                    ->attribute('maxlength', 191) 
                                    ->required()
                                    
                                }}
                            </div><!--col-->

                            {{ html()->label('Usuario digitador :')->class('col-md-2 form-control-label')->for('user_id') }}

                            <div class="col-md-3">
                            
                                {{ html()->text('user_id')
                                    ->class('form-control')
                                    ->value($trabajo->usuario->first_name .' '.$trabajo->usuario->last_name )
                                    ->disabled()
                                    ->attribute('maxlength', 191)      
                                    ->autofocus() }}
                            </div><!--col-->
                            
                        </div><!--form-group-->  

                        <div class="form-group row">
                            {{ html()->label('Fecha compromiso entrega :')->class('col-md-2 form-control-label')->for('entrega_estimada') }}

                            <div class="col-md-2">
                                {{ html()->date('entrega_estimada')
                                    ->class('form-control')
                                    ->value($trabajo->entrega_estimada)
                                    ->attribute('maxlength', 191)      
                                    ->autofocus()
                                    
                                    ->required() }}
                            </div><!--col-->

                            {{ html()->label('Fecha inicio :')->class('col-md-1 form-control-label')->for('fecha_inicio') }}

                            <div class="col-md-2">
                                {{ html()->date('fecha_inicio')
                                    ->class('form-control')
                                    ->attribute('maxlength', 191)      
                                    ->autofocus()
                                    
                                     }}
                            </div><!--col-->

                            {{ html()->label('Fecha de termino :')->class('col-md-1 form-control-label')->for('fecha_termino') }}

                            <div class="col-md-2">
                                {{ html()->date('fecha_termino')
                                    ->class('form-control')
                                    ->attribute('maxlength', 191)      
                                    ->autofocus()
                                    
                                     }}
                            </div><!--col-->

                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Valor Neto :')->class('col-md-2 form-control-label')->for('valor_total') }}

                            <div class="col-md-2">
                                {{ html()->text('valor_total')
                                    ->class('form-control')
                                    ->value('$  '. number_format($trabajo->valor_total,0, ',' , '.'  ))                                   
                                    ->attribute('maxlength', 191)
                                    ->disabled()      
                                    ->autofocus()
                                    
                                    ->required() }}
                            </div><!--col-->

                            {{ html()->label('IVA (19%) :')->class('col-md-1 form-control-label')->for('iva') }}

                            <div class="col-md-2">
                                {{ html()->text('iva')
                                    ->class('form-control')
                                    ->value('$  '.number_format(($trabajo->valor_total * 0.19),0, ',' , '.'  ))      
                                    ->attribute('maxlength', 191)  
                                    ->disabled()      
                                    ->autofocus()
                                    
                                     }}
                            </div><!--col-->

                            {{ html()->label('valor Total :')->class('col-md-1 form-control-label')->for('valor_incluido') }}

                            <div class="col-md-2">
                                {{ html()->text('valor_incluido')
                                    ->class('form-control')
                                    ->attribute('maxlength', 191)
                                    ->value('$  '.number_format(($trabajo->valor_total * 1.19),0, ',' , '.'  ))   
                                    ->disabled()        
                                    ->autofocus()
                                    
                                     }}
                            </div><!--col-->

                        </div><!--form-group-->                                                     

                        </div><!--col-->
                    </div><!--row-->
                </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.orden_trabajos.index'), __('buttons.general.cancel')) }}
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
                            Ítems OT <small class="text-muted">Todos los ítems</small>
                        </h4>
                    </div><!--col-->

                    <div class="col-sm-7">
                        @include('backend.item_ots.includes.header-buttons')
                    </div><!--col-->
                </div><!--row-->

                <div class="row mt-4">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th>Cantidad</th>
                                    <th>Descripcion</th>                                   
                                    <th>Val. Unitario</th>
                                    <th>Val. Parcial</th>
                                    <th>Avance</th>
                                    <th>Estado</th>       
                                    <th>@lang('labels.general.actions')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($trabajo->items_ot as $item_ot)
                                    <tr>
                                        <td>{{ $item_ot->folio }}</td>
                                        <td>{{ $item_ot->cantidad }}</td>
                                        <td>{{ $item_ot->descripcion }}</td>
                                        <td align="right">{{number_format($item_ot->valor_unitario, 0 ,',','.' )   }}</td>
                                        <td align="right">{{number_format($item_ot->valor_parcial, 0 ,',','.')  }}</td>
                                        
                                        <td>Proceso 0 de 0</td>
                                        <td>
                                            @switch($item_ot->estado)
                                                @case(1)
                                                    <span class="badge btn-secondary"> Sin Iniciar </span>
                                                    @break
                                                    
                                                @case(2)
                                                    <span class="badge btn-primary"> En Proceso </span>
                                                    @break
                                                @case(3)
                                                    <span class="badge btn-danger"> Atrasada </span>
                                                    @break
                                                @case(4)
                                                    <span class="badge btn-success"> Terminada </span>
                                                    @break  
                                                @case(5)
                                                    <span class="badge btn-black"> Entregada </span>
                                                    @break                                  
                                            
                                                @case(6)
                                                    <span class="badge btn-warning"> Anulada </span>
                                                    @break   
                                                @default
                                                <span>Something went wrong, please try again</span>
                                            
                                                    
                                            @endswitch
                                        
                                        </td>                               
                                      
                                        <td class="btn-td">@include('backend.item_ots.includes.actions', ['item_ot' => $item_ot , 'trabajo' => $trabajo])</td>
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
                            {!! $trabajo->items_ot->count() !!} 
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