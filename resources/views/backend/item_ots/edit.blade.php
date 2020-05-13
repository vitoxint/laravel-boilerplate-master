@extends('backend.layouts.app')

@section('title','Item OT: '.$trabajo->folio . ' | ' . $item_ot->folio)

@section('content')


        <div class="card">
        {{ html()->modelForm($item_ot, 'PATCH', route('admin.item_ots.update', ['item_ot' => $item_ot, 'trabajo' =>  $trabajo]))->class('form-horizontal')->acceptsFiles()->open() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            
                            <small class="text-muted">Editar item: {{$item_ot->folio}}</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                        <div class="col">
                        <div class="form-group row">
                            {{ html()->label('Descripción *')->class('col-md-2 form-control-label')->for('descripcion') }}

                            <div class="col-md-10">
                                {{ html()->textarea('descripcion')
                                    ->class('form-control')
                                    ->placeholder('Descripción principal')
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label('Valor :')->class('col-md-2 form-control-label')->for('') }}
                        
                        {{ html()->label('Cantidad:')->class('col-md-1 form-control-label')->for('cantidad') }}
                            <div class="col-md-1">
                                {{ html()->text('cantidad')
                                    ->class('form-control')
                                    ->value($item_ot->cantidad)
                                    ->attribute('maxlength', 191)                          
                                    ->required() }}
                            </div><!--col-->
                            {{ html()->label('Valor Unitario:')->class('col-md-1 form-control-label')->for('valor_unitario') }}
                            <div class="col-md-2">
                                {{ html()->text('valor_unitario')
                                    ->class('form-control')
                                    ->value($item_ot->valor_unitario)
                                    ->attribute('maxlength', 191)                                   
                                    ->required() }}
                            </div><!--col-->
                            {{ html()->label('Valor Parcial:')->class('col-md-1 form-control-label')->for('valor_parcial') }}
                            <div class="col-md-2">
                                {{ html()->text('valor_parcial')
                                    ->class('form-control')
                                    ->value($item_ot->valor_parcial)
                                    ->attribute('maxlength', 191)                                   
                                     }}
                            </div><!--col-->
                        </div><!--form-group-->


                        <div class="form-group row">
                            {{ html()->label('Detalle y especificaciones')->class('col-md-2 form-control-label')->for('descripcion') }}

                            <div class="col-md-10">
                                {{ html()->textarea('especificaciones')
                                    ->class('form-control')
                                    ->placeholder('información adicional')
                                    ->attribute('maxlength', 191)
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label('Cumplimiento ')->class('col-md-2 form-control-label')->for('') }}

                        {{ html()->label('Estado  :')->class('col-md-1 form-control-label')->for('estado') }}
                            <div class="col-md-2">

                            {{ html()->select('estado',array('1' => 'Sin iniciar', '2' => 'En proceso', '3' =>'Atrasada', '4' => 'Terminada', '5' => 'Entregada',  '6' => 'Anulada'), $item_ot->estado)
                                ->class('form-control')
                                ->attribute('maxlength', 191) 
                                ->required()
                                
                            }}
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

                        </div><!--col-->
                    </div><!--row-->
                </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.orden_trabajos.edit',$item_ot->ordenTrabajo), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
                    </div><!--row-->
                </div><!--row-->
            </div><!--card-footer-->

            {{ html()->closeModelForm() }}    
        </div><!--card-->
    
  
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

$('#cantidad').on('change', function() {
 
  var total = parseFloat($('#valor_unitario').val())*parseFloat(this.value);
  $('#valor_parcial').val(total);
  
});

$('#valor_unitario').on('change', function() {
  
  var total = parseFloat($('#cantidad').val())*parseFloat(this.value);
  $('#valor_parcial').val(total);
  
});


</script>




@endsection