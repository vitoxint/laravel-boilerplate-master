@extends('backend.layouts.app')

@section('title','Editar proceso' . ' | ' . 'Editar proceso')

@section('content')


        <div class="card">
        {{ html()->modelForm($etapaItemOt, 'PATCH', route('admin.etapa_itemots.update', $etapaItemOt))->class('form-horizontal')->acceptsFiles()->open() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Editar
                            <small class="text-muted">Editar proceso: {{$etapaItemOt->codigo}}</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                        <div class="col">

                        <div class="form-group row">
                        
                        {{ html()->label('Proceso:')->class('col-md-2 form-control-label')->for('proceso_id') }}
                        <div class="col-md-3">
                            <select id="proceso_id" name="proceso_id" class="form-control" required="true" >
                                    <option value="{{$etapaItemOt->proceso_id}}" selected>{{$etapaItemOt->proceso->descripcion}}</option>
                                    @foreach($procs as $proc)
                                        <option value="{{$proc->id}}"> {{$proc->descripcion}}</option>
                                    @endforeach
                            </select>
                        </div><!--col-->
                        {{ html()->label('Máquina:')->class('col-md-1 form-control-label')->for('maquina_id') }}
                       
                        <div class="col-md-3">
                                <select name="maquina_id" id="maquina_id" class="form-control" required="true" >
                                <option value="{{$etapaItemOt->maquina_id}}" selected>{{$etapaItemOt->maquina->nombre}}</option>
                                </select>

                        </div><!--col-->
<!-- 
                        {{ html()->label('Operador:')->class('col-md-1 form-control-label')->for('operador_id') }}
                        <div class="col-md-3">
                                <select name="operador_id" id="operador_id" class="form-control" required="true" >
                                    <option value="" selected></option>
                                </select>
                        </div> -->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label('Detalle: ')->class('col-md-2 form-control-label')->for('detalle') }}

                        <div class="col-md-7">
                            {{ html()->textarea('detalle')
                                ->class('form-control')
                                ->placeholder('Detalle')
                                
                                ->attribute('maxlength', 512)
                                ->autofocus() }}
                        </div><!--col-->
                    </div><!--form-group-->


                    <div class="form-group row">
                        
                        {{ html()->label('Valorización:')->class('col-md-2 form-control-label')->for('') }}

                        {{ html()->label('Tipo:')->class('col-md-1 form-control-label')->for('tipo_valorizacion') }}
                        <div class="col-md-2">

                            {{ html()->select('tipo_valorizacion',array('1' => 'Por Hora Máquina (HM)', '2' => 'Por Kilogramo', '3' =>'Por Operación o Carga'),$etapaItemOt->proceso->tipo_valorizacion)
                                ->class('form-control')
                                ->attribute('maxlength', 191) 
                                ->value($etapaItemOt->proceso->tipo_valorizacion)
                                ->required()
                                
                            }}
                        </div><!--col-->

                        {{ html()->label('Valor Unitario:')->class('col-md-1 form-control-label')->for('valor_unitario') }}
                        <div class="col-md-2">

                            {{ html()->number('valor_unitario')
                                    ->class('form-control')
                                    ->attribute('maxlength', 14)
                                    ->required()                                   
                            }}
                        </div><!--col--> 
                    </div>  

                    <div class="form-group row">
                        
                        {{ html()->label('')->class('col-md-2 form-control-label')->for('') }}

                        {{ html()->label('Cantidad:')->class('col-md-1 form-control-label')->for('cantidad') }}
                        <div class="col-md-2">

                            {{ html()->text('cantidad')
                                ->class('form-control')
                                ->attribute('maxlength', 191) 
                                ->required()
                                
                            }}
                        </div><!--col-->

                        {{ html()->label('Valor total:')->class('col-md-1 form-control-label')->for('valor_proceso') }}
                        <div class="col-md-2">

                            {{ html()->number('valor_proceso')
                                    ->class('form-control')
                                    ->placeholder('$$')
                                    ->attribute('maxlength', 14)
                                    ->required()                                   
                            }}
                        </div><!--col--> 
                    </div>       


                    <div class="form-group row">
                    
                    {{ html()->label('Tiempo asignado:')->class('col-md-1 form-control-label')->for('tiempo_asignado') }}
                        <div class="col-md-2">
                        {{ html()->time('tiempo_asignado')
                                ->class('form-control')
                                ->placeholder('hh:mm')
                                ->attribute('maxlength', 512)
                                ->autofocus() }}
                            </span>
                        </div><!--col-->

                        {{ html()->label('Termino estimado:')->class('col-md-1 form-control-label')->for('fh_limite') }}
                       
                        <div class="col-md-3">
                        <div class='input-group date' id='fh_limite' name="fh_limite" >

                       <?php $limite = new Carbon\Carbon( $etapaItemOt->fh_limite);
                        $limite = $limite->format('d-m-y H:i'); ?>
                            <input type='text' class="form-control" id='fh_limiten' name="fh_limiten" value="{{$limite}}" />
                            <span class="input-group-addon">
                                <span class="fa fa-calendar btn btn-xs"></span>
                            </span>
                        </div>

                        <?php $fecha = new Carbon\Carbon($etapaItemOt->itemOt->ordenTrabajo->entrega_estimada); ?>
                        <?php $fecha = $fecha->format('d-m-Y'); ?> 
                        Nota: Considere que el proceso no puede terminar despues del {{$fecha}}

                        </div><!--col-->

                    </div><!--form-group--> 

                    <div class="form-group row">
                            {{ html()->label('Estado avance:')->class('col-md-1 form-control-label')->for('estado_avance') }}

                            <div class="col-md-2">
                                {{ html()->select('estado_avance',array('1' => 'Sin iniciar', '2' => 'En proceso', '3' =>'Atrasada', '4' => 'Terminada', '5' => 'Detenida',  '6' => 'Anulada'), $etapaItemOt->estado_avance)
                                    ->class('form-control')
                                    ->attribute('maxlength', 191) 
                                    ->required()
                                    
                                }}
                            </div><!--col--> 

                            {{ html()->label('Hora inicio:')->class('col-md-1 form-control-label')->for('fh_inicio') }}
                            <?php 
                                if($etapaItemOt->fh_inicio != null){
                                    $finicio = new Carbon\Carbon($etapaItemOt->fh_inicio); $finicio = $finicio->format('d-m-Y H:i'); 
                                }else{
                                    $finicio = null;
                                }
                                
                            ?>
                            <div class="col-md-2">
                                {{ html()->text('fh_inicio')
                                    ->class('form-control')
                                    ->value($finicio)
                                    ->attribute('maxlength', 191)                                   
                                     }}
                            </div><!--col-->

                            {{ html()->label('Hora termino:')->class('col-md-1 form-control-label')->for('fh_termino') }}
                            <?php 

                                if($etapaItemOt->fh_termino != null){
                                    $ftermino = new Carbon\Carbon($etapaItemOt->fh_termino); $ftermino = $ftermino->format('d-m-Y H:i');
                                }else{
                                    $ftermino = null;
                                }
                            
                             ?>
                            <div class="col-md-2">
                                {{ html()->text('fh_termino')
                                    ->class('form-control')
                                    ->value($ftermino)
                                    ->attribute('maxlength', 191)                                   
                                     }}
                            </div><!--col-->                            

                    </div><!--form-group -->

                        </div><!--col-->
                    </div><!--row-->
                </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.item_ots.edit',[$etapaItemOt->itemOt, $etapaItemOt->itemOt->ordenTrabajo]), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
                    </div><!--row-->
                </div><!--row-->
            </div><!--card-footer-->

            {{ html()->closeModelForm() }}    
        </div><!--card-->
    
  
</div>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" /> -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>


  <script src="{{asset('datepicker/js/bootstrap-datetimepicker.js')}}"></script>
<script src="{{asset('datepicker/js/moments.js')}}"></script>



<script type="text/javascript">


$(document).ready(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
       
        $('#fh_limite').datetimepicker({
            // Formats
            // follow MomentJS docs: https://momentjs.com/docs/#/displaying/format/
            format: 'DD-MM-YYYY HH:mm',
            locale: 'es',
            
            // Your Icons
            // as Bootstrap 4 is not using Glyphicons anymore
            icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-check',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            }
        });
        
        

        


    $('#proceso_id').on('change', function() {
        
        var procesoID = this.value;  
        
        
        if(procesoID){
            $.ajax({
            
                url: "{{ route('admin.get-maquina-list') }}?proceso_id=" + $(this).val(),
                method: 'GET',
                success:function(res){               
                if(res){
                    $("#maquina_id").empty();
                    $("#maquina_id").append('<option>Seleccione</option>');
                    $.each(res,function(key,value){
                        $("#maquina_id").append('<option value="'+key+'">'+value+'</option>');
                    });

                }else{
                   $("#maquina_id").empty();
                }
               }
            });
        }else{
            $("#maquina_id").empty();
          
        }      
       });


       $('#proceso_id').on('change', function() {
        
        var procesoID = this.value;  
        
        
        if(procesoID){

             $.ajax({
            
            url: "{{ route('admin.get-valor-proceso') }}?proceso_id=" + $(this).val(),
            method: 'GET',
            success:function(data){               
            if(data){
                $("#tipo_valorizacion").val(data.tipo_valorizacion).prop('selected', true);
                $("#valor_unitario").val(data.valor_unitario);
               
            }else{
               
               console.log('no se puede obtener la información');
            }
           }
        });         


        }else{
            $("#maquina_id").empty();
          
        }      
       }); 
       
       
        $('#cantidad').on('change', function() {
 
            var total = parseFloat($('#valor_unitario').val())*parseFloat(this.value);
            $('#valor_proceso').val(total.toFixed());
            
        });

        $('#valor_unitario').on('change', function() {
            
            var total = parseFloat($('#cantidad').val())*parseFloat(this.value);
            $('#valor_proceso').val(total.toFixed());
            
        });

        $('#tiempo_asignado').on('change', function() {
            
            var time = this.value;
            var hoursMinutes = time.split(/[.:]/);
            var hours = parseInt(hoursMinutes[0], 10);
            var minutes = hoursMinutes[1] ? parseInt(hoursMinutes[1], 10) : 0;
            var cantidad = (hours + minutes / 60);

            if( $('#tipo_valorizacion').val() == '1' ){
                $('#cantidad').val(cantidad.toFixed(2));
                var total = parseFloat($('#valor_unitario').val())*parseFloat($('#cantidad').val());
                $('#valor_proceso').val(total);
            }

            
        });


 /*       $('#maquina_id').on('change', function() {
        
        var maquinaID = this.value;  
        
        if(maquinaID){
            $.ajax({
            
                url: "{{ route('admin.get-operador-list') }}?maquina_id=" + $(this).val(),
                method: 'GET',
               success:function(res){               
                if(res){
                    $("#operador_id").empty();
                    $("#operador_id").append('<option>Seleccione</option>');
                    $.each(res,function(key,value){
                        $("#operador_id").append('<option value="'+key+'">'+value+'</option>');
                    });

                }else{
                   $("#operador_id").empty();
                }
               }
            });
        }else{
            $("#operador_id").empty();
          
        }      
       });    */

       });    

</script>


@endsection