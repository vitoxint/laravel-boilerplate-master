<!-- Trigger the modal with a button -->
<!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal_add_evaluacion">Open Modal</button>-->

<!-- load jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


<!-- provide the csrf token -->
<meta name="csrf-token" content="{{ csrf_token() }}" />


<!-- Modal -->
<div id="modal_add_proceso" class="modal fade" role="dialog">
<div class="modal-dialog modal-lg">

<!-- Modal content-->
<div class="modal-content">
  <div class="modal-header">
   <h5 class="modal-title">Nuevo proceso</h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    
  </div>
  <div class="modal-body">
      
      <form method="POST" action="" >
          {{ csrf_field() }}
          
          <div class="row mt-4 mb-4">
                    <div class="col">

                        <div class="form-group row">
                        
                            {{ html()->label('Proceso:')->class('col-md-1 form-control-label')->for('proceso_id') }}
                            <div class="col-md-3">
                                <select id="proceso_id" name="proceso_id" class="form-control" required="true" >
                                        <option value="" selected disabled>Seleccione</option>
                                        @foreach($procs as $proc)
                                            <option value="{{$proc->id}}"> {{$proc->descripcion}}</option>
                                        @endforeach
                                </select>
                            </div><!--col-->
                            {{ html()->label('Máquina:')->class('col-md-1 form-control-label')->for('maquina_id') }}
                           
                            <div class="col-md-3">
                                    <select name="maquina_id" id="maquina_id" class="form-control" required="true" >
                                    </select>

                            </div><!--col-->

                            {{ html()->label('Operador:')->class('col-md-1 form-control-label')->for('operador_id') }}
                            <div class="col-md-3">
                                    <select name="operador_id" id="operador_id" class="form-control" required="true">
                                    </select>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Detalle: ')->class('col-md-1 form-control-label')->for('detalle') }}

                            <div class="col-md-12">
                                {{ html()->textarea('detalle')
                                    ->class('form-control')
                                    ->placeholder('Detalle')
                                    ->attribute('maxlength', 512)
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        
                        {{ html()->label('Tiempo asignado:')->class('col-md-2 form-control-label')->for('tiempo_asignado') }}
                            <div class="col-md-2">
                            {{ html()->time('tiempo_asignado')
                                    ->class('form-control')
                                    ->placeholder('hh:mm')
                                    ->attribute('maxlength', 512)
                                    ->autofocus() }}
                                </span>
                            </div><!--col-->

                            {{ html()->label('Termino estimado:')->class('col-md-2 form-control-label')->for('fh_limite') }}
                           
                            <div class="col-md-4">
                            <div class='input-group date' id='fh_limite' name="fh_limite">
                                <input type='text' class="form-control" required="true" />
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>

                            </div><!--col-->
                            Nota: Considerar que el proceso no puede terminar despues del {{$item_ot->ordenTrabajo->fecha_estimada}}

                        </div><!--form-group-->

                       


                    </div><!--col-->
                </div><!--row-->
        </form>
          
  </div>

  <div class="modal-footer">
            
            <button class="btn btn-success btn-md btn-block btn-flat"  id="postbutton_agregar">Agregar</button>
      
      </form>


  </div>
</div>

</div>
</div>

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
        
        
        $("#postbutton_agregar").click(function(){

            var proceso_id = $("#proceso_id").val() ;
            var maquina_id = $("#maquina_id").val() ;
            var operador_id = $("#operador_id").val() ;
            var detalle = $("#detalle").val() ;
            var tiempo_asignado = $("#tiempo_asignado").val() ;
            var fh_limite = $("#fh_limite").find("input").val() ;

   
            $.ajax({
                /* the route pointing to the post function */
               
                type: 'POST',
                url:"{{route('admin.etapa_itemots.store')}}?id=" + "<?php echo $item_ot->id; ?>",
                             
                /* send the csrf-token and the input to the controller */
                data: {_token: CSRF_TOKEN,
                               proceso_id:proceso_id,
                               maquina_id:maquina_id,
                               operador_id:operador_id,
                               detalle:detalle,
                               tiempo_asignado:tiempo_asignado,
                               fh_limite:fh_limite
                            },
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success:function (data) { 
                    //$("#table-procesos").append(data.message); 
                    alert(data.mensaje);
               
                    
                },                
                error: function() {
                    console.log("No se ha podido obtener la información");
                }   
            }); 
     

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


       $('#maquina_id').on('change', function() {
        
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
       });   

       });    

</script>



