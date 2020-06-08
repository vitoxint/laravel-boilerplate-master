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
      
      <form method="POST" action="">
          {{ csrf_field() }}
          
          <div class="row mt-4 mb-4">
                    <div class="col">

                    <div class="form-group row">
                        
                        {{ html()->label('Proceso:')->class('col-md-1 form-control-label')->for('proceso_id') }}
                            <div class="col-md-3">
                                <select id="proceso_id" name="proceso_id" class="form-control" >
                                        <option value="" selected disabled>Seleccione</option>
                                        @foreach($procs as $proc)
                                            <option value="{{$proc->id}}"> {{$proc->descripcion}}</option>
                                        @endforeach
                                </select>
                            </div><!--col-->
                            {{ html()->label('Máquina:')->class('col-md-1 form-control-label')->for('maquina_id') }}
                           
                            <div class="col-md-3">
                                    <select name="maquina_id" id="maquina_id" class="form-control" >
                                    </select>

                            </div><!--col-->

                            {{ html()->label('Operador:')->class('col-md-1 form-control-label')->for('operador_id') }}
                            <div class="col-md-3">
                                    <select name="operador_id" id="operador_id" class="form-control" >
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
                            </div><!--col-->

                            {{ html()->label('Termino estimado:')->class('col-md-2 form-control-label')->for('fh_limite') }}
                           
                            <div class="col-md-3">
                            {{ html()->date('fh_limite')
                                    ->class('form-control')                                    
                                    ->attribute('maxlength', 512)
                                    ->autofocus() }}

                            </div><!--col-->

                        </div><!--form-group-->


                    </div><!--col-->
                </div><!--row-->
 
          
  </div>

  <div class="modal-footer">
            <!--<input type="submit" class="btn btn-success" value="Agregar" />-->
            <button class="btn btn-success btn-md btn-block btn-flat" id="postbutton_agregar">Agregar</button>
      
      </form>


  </div>
</div>

</div>
</div>

<script type="text/javascript">


$(document).ready(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
        $("#postbutton_agregar").click(function(){
            $.ajax({
                /* the route pointing to the post function */
                url:'{{route("admin.etapa_itemots.store")}}?id='+ "<?php echo $item_ot->id; ?>",
                type: 'POST',
                /* send the csrf-token and the input to the controller */
                data: {_token: CSRF_TOKEN, pregunta:document.getElementsByClassName("pregunta").val() , 
                               puntaje_maximo:document.getElementsByClassName("puntaje_maximo").val() , 
                               factor:document.getElementsByClassName("factor").val()},
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) { 
                    //$(".writeinfo").append(data.msg); 
                   // alert(data.msg);
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

