@extends('backend.layouts.app')

@section('title','Solicitud de material' . ' | ' . 'Responder solicitud de material')

@section('content')

        <div class="card">
        {{ html()->modelForm($solicitud, 'PATCH', route('admin.solicitudes_material.update', $solicitud))->class('form-horizontal')->acceptsFiles()->open() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Solicitud de material
                            <small class="text-muted">Responder solicitud</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                
                <div class="row mt-4 mb-4">
                        <div class="col">
                        <div class="form-group row">
                        {{ html()->label(__('Material solicitado:'))->class('col-md-2 form-control-label')->for('material') }}

                        <div class="col-md-6">                       
                                {{ html()->text('material')
                                    ->class('form-control')                                    
                                    ->value($solicitud->material->material)
                                    ->attribute('maxlength', 255)
                                    ->disabled()                              
                                }}
                    
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('Trabajo:'))->class('col-md-2 form-control-label')->for('trabajo') }}

                        <div class="col-md-2">
                                                
                                {{ html()->text('trabajo')
                                    ->class('form-control')
                                    
                                    ->value($solicitud->materialOt->folio)
                                    ->attribute('maxlength', 14)
                                    ->disabled()                              
                                }}
                                                    
                        </div>

                            {{ html()->label(__('Fecha:'))->class('col-md-1 form-control-label')->for('fecha_solicitud') }}

                        <div class="col-md-2">
                                                
                                {{ html()->text('fecha_solicitud')
                                    ->class('form-control')
                                    
                                    ->value($solicitud->created_at)
                                    ->attribute('maxlength', 255)
                                    ->disabled()                              
                                }}

                        </div>
                    </div><!--form-group--> 

                    <div class="form-group row">
                        
                        {{ html()->label('Dimensión solicitada:')->class('col-md-2 form-control-label')->for('medida') }}
                        <div class="col-md-2">

                            @switch($solicitud->material->perfil)
                                @case('3')
                                    {{ html()->text('medida')
                                        ->class('form-control')
                                        
                                        ->value($solicitud->dimension_largo .' x ' .$solicitud->dimension_largo .' mm')
                                        ->attribute('maxlength', 255)
                                        ->disabled()                              
                                    }}
                                @break
                                @default
                                    {{ html()->text('medida')
                                        ->class('form-control')
                                        
                                        ->value($solicitud->dimension_largo  .'mm')
                                        ->attribute('maxlength', 255)
                                        ->disabled()                              
                                    }}

                                @break
                            @endswitch

                        </div><!--col-->  

                        {{ html()->label(__('Solicitante:'))->class('col-md-1 form-control-label')->for('solicitante') }}

                        <div class="col-md-3">
                                                
                                {{ html()->text('solicitante')
                                    ->class('form-control')
                                    
                                    ->value($solicitud->materialOt->ordenTrabajo->usuario->first_name . ' ' .$solicitud->materialOt->ordenTrabajo->usuario->last_name )
                                    ->attribute('maxlength', 255)
                                    ->disabled()                              
                                }}

                        </div>



                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('Cerrada:'))->class('col-md-2 form-control-label')->for('resuelta') }}

                        <div class="col-md-3">                       
                                <label class="switch switch-label switch-pill switch-dark">
                                @if($solicitud->estado == 2)
                                    {{ html()->checkbox('resuelta', true)->class('switch-input') }}
                                    <span class="switch-slider" data-checked="SI" data-unchecked="NO"></span>
                                @else
                                    {{ html()->checkbox('resuelta', false)->class('switch-input') }}
                                    <span class="switch-slider" data-checked="SI" data-unchecked="NO"></span>
                                @endif
                                    
                                </label>
                    
                        </div><!--col-->
                    </div><!--form-group-->                    
                                           
                        <div class="form-group row" style="">

                                <div class="col-md-12"> <h4 class="card-title mb-0">                               
                                    <small class="text-muted">Dimensiones entregadas</small>
                                </h4></div>


                                <div class="col-md-12">
                                    <div id="materiales" class="table-responsive">
                                        <table class='table table-bordered table-hover' id="tab_logic">
                                            <thead>
                                                <tr class='info'>
                                                    <th style='width:7%;'hidden="true">ID TROZO.</th>
                                                    <th style='width:41%;'>Material</th>
                                                    <!-- <th>Origen</th> -->
                                                    
                                                    <th style='width:9%;'>Largo</th>
                                                    <th style='width:9%;'>Ancho</th>
                                                    <th style='width:12%;'>V.unitario</th>
                                                    <th style='width:12%;'>V.parcial</th>
                                                    <th style='width:9%; align-text:center'>Estado</td>
                                                    <th style='width:10%;'>Acción</th>
                                                </tr>
                                            </thead>
                                            <thead id="dynamic_field">

                                            <?php $entregadas = App\TrabajoUseMaterial::whereBetween('estado',[2,3])->where('itemot_id',$solicitud->materialOt->id)->where('solicitud_material_id',$solicitud->id)->get() ?>

                                            @foreach($entregadas as $material)
                                            <tr id="row{{$material->id}}">
                                                    <td class="custom-tbl" hidden="true"><input class='form-control input-sm'style='width:100%;' type="text"  value="{{$material->id}}" id="pr_item{{$material->id}}" name="pr_item[]" readonly required></td>
                                                    <td class="custom-tbl"><input class='form-control input-sm' style='width:100%;' type="text" value="{{$material->material->material}}" id="material_id{{$material->id}}" oninput='multiply("{{$material->id}}");' name="material_id[]">
                                                                        
                                                    </td>  
                                                   <!--  <td> 
                                                        @switch($material->origen_material)  
                                                            @case(1)
                                                                Compra
                                                            @break;
                                                            @case(2)
                                                                Retazo
                                                            @break;
                                                            @case(3)
                                                                Proporcionado por cliente
                                                            @break;
                                                        
                                                        @endswitch                                    
                                                    </td>   -->
                                                    <td><input class='form-control input-sm' style='width:100%;' type="text" value="{{$material->dimension_largo}}" id="pr_largo{{$material->id}}" oninput='multiply(0);' name="pr_largo[]"></td>
                                                    <td><input class='form-control input-sm' style='width:100%;' type="text" value="{{$material->dimension_ancho}}" id="pr_ancho{{$material->id}}" oninput='multiply(0);' name="pr_ancho[]"></td>
                                                    <td><input class='form-control input-sm' style='width:100%;' type="text" value="{{$material->valor_unit}}" id="pr_unit{{$material->id}}" oninput='multiply(0);' name="pr_unit[]"></td>
                                                    <td class="custom-tbl" ><input class='estimated_cost form-control input-sm' style="text-align:right;" value="@money($material->valor_total)" id="pr_cpi{{$material->id}}" value="{{$material->valor_parcial}}" style='width:100%;' type="text" name="pr_cpi[]" readonly></td>
                                                    <td style="text-align:center;"> 
                                                    @switch($material->estado)
                                                        @case(1)
                                                        <span class="badge btn-secondary" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> En Espera </p>  </span>
                                                        @break
                                                        @case(2)
                                                        <span class="badge btn-success" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Asignado </p>  </span>
                                                        @break
                                                        @case(3)
                                                        <span class="badge btn-dark" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Utilizado </p>  </span>
                                                        @break
                                                    @endswitch

                                                    </td>
                                                    <td class="custom-tbl"><!-- <button type="button" id="{{$material->id}}" class="btn-info btn-sm btn_add" name="add"><span class="fas fa-sync-alt"></span></button> -->
                                                        @if($material->estado == 2)
                                                            <button type="button" name="remove" id="{{$material->id}}" class="btn-danger btn-sm btn_remove"><span class="fas fa-times"></span></button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </thead>
                                        </table>
                                </div><!--col-->

                            </div><!--form-group-->  

                        </div><!--col-->
                    </div><!--row-->





                </div><!--card-body-->

           <!--  <div class="card-footer">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.solicitud_material.index'), __('buttons.general.cancel')) }}
                    </div> --><!--col-->

                    <!-- <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
                    </div> --><!--row-->
                <!-- </div> --><!--row-->
           <!--  </div> --><!--card-footer-->

            {{ html()->closeModelForm() }}    
        </div><!--card--> 




        <div class="card">
       
            <div class="card-body">
                


                
                <div class="row mt-1 mb-4">
                        <div class="col">

                        
                   
                        <div class="form-group row" style="">

                                <div class="col-md-12"> <h4 class="card-title mb-0">                               
                                    <small class="text-muted">Dimensiones disponibles</small>
                                </h4></div>



                                </div> <!--col-->

                                <div class="col col-md-12">

                                <div class="col border border-success"><hr/>

                                    <div class="form-group row">
                                        {{ html()->label(__('Seleccionar del inventario :'))->class('col-md-2 form-control-label')->for('material_id') }}

                                        <?php  $disponibles = App\ExistenciaMaterial::whereBetween('estado_consumo',[1,2])->where('material_id',$solicitud->material_id)->get()  ?>

                                        <div class="col-md-7">                       
                                            <select id="material_id" name="material_id" class="form-control" >
                                            <option value=""  selected="true"> Seleccione un trozo disponible </option>
                                            @foreach($disponibles as $disponible) 
                                                <option value="{{$disponible->id}}"> {{$disponible->material->material . '-'. $disponible->material->proveedor}} 
                                                    - [Disponible: {{$disponible->dimension_largo}} @if($disponible->material->perfil ==3) x {{$disponible->dimension_ancho}}@endif mm] - 
                                                    [Depósito: {{$disponible->deposito->nombre}}]
                                                </option>
                                            @endforeach                                      
                                            </select>
                                            
                                            

                                        </div><!--col-->
                                        <div class="col col-sm-2"><button class="btn btn-success btn-sm" onclick="calcular()"><i class="fas fa-calculator"></i> Calcular </button>
                                        <!-- <button class="btn btn-primary btn-sm" onclick="editar()"><i class="fas fa-edit"></i> Editar </button> --></div>
                                    </div><!--form-group-->

                                    <div class="form-group row" style="padding-top:10px;">

                                            {{ html()->label('Reservar corte :')->class('col-md-2 form-control-label')->for('') }}

                                            {{ html()->label('Largo (mm):')->class('col-md-1 form-control-label')->for('largo') }}

                                            <div class="col-md-1">
                                                {{ html()->number('largo')
                                                    ->class('form-control')
                                                                                
                                                    ->attribute('maxlength', 191)                                          
                                                    ->autofocus()                                   
                                                    }}
                                            </div><!--col-->

                                            {{ html()->label('Ancho (mm):')->class('col-md-1 form-control-label')->for('ancho') }}

                                            <div class="col-md-1">
                                                {{ html()->number('ancho')
                                                    ->class('form-control')
                                                    
                                                    ->attribute('maxlength', 191)                                            
                                                    ->autofocus()

                                                    }}
                                            </div><!--col-->

                                            <div class="col col-sm-2"><button id="agregar" class="btn btn-dark btn-sm" onclick="agregar()"><i class="fas fa-arrow-up"></i> Agregar </button>
                                            </div>

                                    </div><!--form-group-->    

                                    <div class="form-group row" style="padding-top:10px;">
                                            {{ html()->label('Resultados :')->class('col-md-2 form-control-label')->for('') }}

                                            {{ html()->label('Volumen (Lts):')->class('col-md-1 form-control-label')->for('volumen') }}

                                            <div class="col-md-2">
                                                {{ html()->text('volumen')
                                                    ->class('form-control')
                                                    ->disabled()                          
                                                    ->attribute('maxlength', 191)                                          
                                                    ->autofocus()                                   
                                                    }}
                                            </div><!--col-->

                                            {{ html()->label('Masa (Kg):')->class('col-md-1 form-control-label')->for('masa') }}

                                            <div class="col-md-2">
                                                {{ html()->text('masa')
                                                    ->class('form-control')
                                                    ->value(0)
                                                    ->disabled()
                                                    ->attribute('maxlength', 191)                                            
                                                    ->autofocus()

                                                    }}
                                            </div><!--col-->

                                            {{ html()->label('Valor total:')->class('col-md-1 form-control-label')->for('valor') }}
                                            <div class="col-md-2">
                                                {{ html()->text('valor')
                                                    ->class('form-control')
                                                    
                                                    ->disabled()
                                                    ->attribute('maxlength',
                                                        191)                                            
                                                    ->autofocus()

                                                    }}
                                            </div><!--col-->

                                            <input type="text" id="valor2" hidden="true" />

                                    </div><!--form-group-->  

                                </div>

                            </div><!--form-group-->  

                        </div><!--col-->
                    </div><!--row-->





                </div><!--card-body-->

           <!--  <div class="card-footer">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.solicitud_material.index'), __('buttons.general.cancel')) }}
                    </div> --><!--col-->

                    <!-- <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
                    </div> --><!--row-->
                <!-- </div> --><!--row-->
           <!--  </div> --><!--card-footer-->

              
        </div><!--card-->        



<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/locales/es.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" type="text/javascript"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.0.11/purify.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.7.7/xlsx.core.min.js"></script>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>


<script>

    $.fn.select2.defaults.set('language', 'es');

    var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
    });


    $('#material_id').on('change', function() {
      
      var materialID = this.value; 
      //alert(materialID) ;

       perfil = 0  ;
       densidad = 0;
       valor_kg = 0 ;
       diam_exterior = '';
       diam_interior = '';
       espesor = '';
       sistema_medida = 0;
       dimensionado = '';
       dimensionado_corte = '';
       valor_kg_corte = 0;
      
      if(materialID){
          $.ajax({

              url: "{{ route('admin.get-datos-trozado') }}?trozado_id=" + materialID,
              method: 'GET',
              success:function(res){               
              if(res){
                  perfil = res.perfil;
                  densidad = res.densidad;
                  valor_kg = res.valor_kg;
                  diam_exterior = res.diam_exterior;
                  diam_interior = res.diam_interior;
                  espesor = res.espesor;
                  sistema_medida = res.sistema_medida;
                  dimensionado = res.dimensionado;
                  dimensionado_corte = res.dimensionado_corte;
                  valor_kg_corte = res.valor_kg_corte;

                  if(dimensionado_corte != '') {
                      var res = dimensionado_corte.split("x");
                      $("#largo").val(res[0]);
                     // $("#largo").max(res[0]);
                      //$("#ancho").val(res[1]);   
                      $("#ancho").val(res[1]);                         
                                                  
                  }else{
                      $("#largo").val(0);
                      $("#ancho").val(0);
                  }
                  
                /*   
                  $("#largo").val(0);
                  $("#ancho").val(0); */
                  $("#volumen").val(0);
                  $("#masa").val(0);
                  $("#valor").val(0);

              }else{
                 // $("#representante_id").empty();
              }
              }
          });
        }else{
            //$("#commune_id").empty();
            
        }      
        }
    );



    function calcular(){
        var volumen ;
        
        if(perfil == 1){
            volumen = volumen_barra();
            
        }

        if(perfil == 2){
            volumen = volumen_bocina();
        }

        if(perfil == 3){
            volumen = volumen_plancha();
        }

        volumenLt = volumen/1000;

        $('#volumen').val(volumenLt.toFixed(3));

        var masa = parseFloat(densidad) * volumen;
        var masaKg = masa/1000
        var precio = masa *( parseFloat( valor_kg_corte  )  / 1000);

        $("#masa").val(masaKg.toFixed(3));
        $("#valor").val(  formatter.format(precio.toFixed(2)));
        $("#valor2").val(  precio.toFixed(2));

    }



    $('#largo').on('change', function () {

        var volumen ;

        if(perfil == 1){
            volumen = volumen_barra();            
        }

        if(perfil == 2){
            volumen = volumen_bocina();
        }

        if(perfil == 3){
            volumen = volumen_plancha();
        }

        volumenLt = volumen/1000;

        $('#volumen').val(volumenLt.toFixed(3));

        var masa = parseFloat(densidad) * volumen;
        var masaKg = masa/1000
        var precio = masa *( parseFloat( valor_kg  )  / 1000);

        $("#masa").val(masaKg.toFixed(3));
        $("#valor").val( formatter.format(precio.toFixed(2)));
        $("#valor2").val(  precio.toFixed(2));


    });

    $('#ancho').on('change', function() {

    var volumen ;

    if(perfil == 3){
        volumen = volumen_plancha();

        volumenLt = volumen/1000;

        $('#volumen').val(volumenLt.toFixed(3));

        var masa = parseFloat(densidad) * (volumen);
        var masaKg = masa/1000;
        var precio = masa * ( parseFloat(   valor_kg  )  / 1000);

        $("#masa").val(masaKg.toFixed(3));
        $("#valor").val( formatter.format(precio.toFixed(2)));
        $("#valor2").val(  precio.toFixed(2));

    }

    });


    function toDeci(fraction) {
        var result, wholeNum = 0, frac, deci = 0;
        if(fraction.search('/') >= 0){
            if(fraction.search('-') >= 0){
                var wholeNum = fraction.split('-');
                frac = wholeNum[1];
                wholeNum = parseInt(wholeNum, 10);
            }else{
                frac = fraction;
            }
            if(fraction.search('/') >=0){
                frac =  frac.split('/');
                deci = parseInt(frac[0], 10) / parseInt(frac[1], 10);
            }
            result = wholeNum + deci;
        }else{
            result = +fraction;
        }
        return result.toFixed(2);
    }


    function volumen_bocina(){
            if(sistema_medida == 2) //si es en pulgadas
            { 
                var radioExt = (parseFloat(   toDeci(diam_exterior)    ) / parseFloat(2)) *25.4;
                var radioInt = (parseFloat(   toDeci(diam_interior)    ) / parseFloat(2)) *25.4;
            }else{   // si es en milimetros

                var radioExt = parseFloat( diam_exterior ) / parseFloat(2);
                var radioInt = parseFloat( diam_interior ) / parseFloat(2);
            }
            var areaExt = Math.PI * Math.pow(radioExt,2);
            var areaInt = Math.PI * Math.pow(radioInt,2);

            var areaTotal = (areaExt - areaInt)/1000;
            var volumen = areaTotal * parseFloat( $('#largo').val() )
            return volumen;
    }

    function volumen_barra(){
        
        if(sistema_medida == 2) //si es en pulgadas
            { 
                console.log(diam_exterior);
                var radioExt =  ( parseFloat(   toDeci(diam_exterior)    ) / parseFloat(2) ) * 25.4;
                
                //var radioInt = parseFloat(   toDeci($('#diam_interior').val())    ) / parseFloat(2);
            }else{   // si es en milimetros

                var radioExt = parseFloat( diam_exterior ) / parseFloat(2);
                //var radioInt = parseFloat( $('#diam_interior').val() ) / parseFloat(2);
            }
            var areaExt = Math.PI * Math.pow(radioExt,2);
            //var areaInt = Math.PI * Math.pow(radioInt,2);

            var areaTotal = areaExt/1000 ;
            var volumen = areaTotal * parseFloat( $('#largo').val() )
            return volumen;
        //return radioExt;
    }

    function volumen_plancha(){

        //console.log('plancha');

        if(sistema_medida == 2) //si es en pulgadas
            { 
                var mespesor =   parseFloat( toDeci(espesor) ) * 25.4;

            }else{   // si es en milimetros

                var mespesor = parseFloat( espesor);
            
            }
            var areaTotal = parseFloat( $('#largo').val() ) * parseFloat( $('#ancho').val() );

            areaTotal = areaTotal / 1000;

            var volumen = areaTotal * parseFloat( mespesor )
            return volumen;
        
    }




    function agregar(){

        var material_id =  $("#material_id").val();
        var largo = $('#largo').val();
        var ancho =  $("#ancho").val();
        var valor =  $("#valor2").val();
        var solicitud = <?php echo $solicitud->id ?> ;


        $.ajax({
        type:'POST',
        url:'{{route("admin.trabajo_material.store")}}?id='+ "<?php echo $solicitud->materialOt->id; ?>",
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        data:{ material_id:material_id, largo:largo , ancho:ancho , valor:valor , solicitud:solicitud},
        success:function(data){
            //i++;  
            $('#dynamic_field').append('<tr id="row'+data.id+'" class="dynamic-added"><td class="custom-tbl" hidden="true"><input id="pr_item'+data.id+'" class="form-control input-sm"style="width:100%;" type="text" value="'+data.id+'" name="pr_item[]" readonly required></td> <td id="material_tr'+data.id+'" class="custom-tbl"> <input id="material_id'+data.id+'"  name="material_id[]" class="form-control" value="'+data.material+'" / >     </td>         <td class="custom-tbl"><input id="pr_largo'+data.id+'" class="form-control input-sm" style="width:100%;" type="text" name="pr_largo[]" value="'+data.dimension_largo+'"></td>   <td class="custom-tbl"><input id="pr_ancho'+data.id+'" class="form-control input-sm" style="width:100%;" type="text" oninput="multiply('+data.id+');" name="pr_ancho[]" value="'+data.dimension_ancho+'"></td>               <td class="custom-tbl"><input id="pr_unit'+data.id+'" class="form-control input-sm" style="width:100%;" type="text" oninput="multiply('+data.id+');" name="pr_unit[]" value="'+data.valor_unit+'"></td>               <td class="custom-tbl"><input id="pr_cpi'+data.id+'" class="estimated_cost form-control input-sm" style="width:100%; text-align:right;" type="text" name="pr_cpi[]" value="'+data.valor_total+'" readonly></td>      <td style="text-align:center;"><span class="badge btn-success" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Asignado </p></span></td>     <td class="custom-tbl"><!--<button type="button" id="'+data.id+'" class="btn-info btn-sm btn_add" hidden="true" name="add"><span class="fas fa-plus"></span></button> --><button type="button" name="remove" id="'+data.id+'" class="btn-danger btn-sm btn_remove"><span class="fas fa-times"></span></button></td></tr>');            
            //$('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td class="custom-tbl"><input id="pr_item'+i+'" class="form-control input-sm"style="width:100%;" type="text" value="'+i+'" name="pr_item[]" readonly required></td> <td id="material_tr'+i+'" class="custom-tbl">  </td>         <td class="custom-tbl"><input id="pr_largo'+i+'" class="form-control input-sm" style="width:100%;" type="text" name="pr_largo[]"></td>   <td class="custom-tbl"><input id="pr_ancho'+i+'" class="form-control input-sm" style="width:100%;" type="text" oninput="multiply('+i+');" name="pr_ancho[]"></td>               <td class="custom-tbl"><input id="pr_unit'+i+'" class="form-control input-sm" style="width:100%;" type="text" oninput="multiply('+i+');" name="pr_unit[]"></td>               <td class="custom-tbl"><input id="pr_cpi'+i+'" class="estimated_cost form-control input-sm" style="width:100%;" type="text" name="pr_cpi[]" readonly></td>       <td class="custom-tbl"><button type="button" id="'+i+'" class="btn-info btn-sm btn_add" name="add"><span class="fas fa-plus"></span></button> <button type="button" name="remove" id="'+i+'" class="btn-danger btn-sm btn_remove"><span class="fas fa-times"></span></button></td></tr>');  
            var format_total = parseFloat(data.total);
            var format_parcial = parseFloat(data.valor_total);

            $("#pr_cpi"+data.id).val(formatter.format( format_parcial.toFixed(2) )   );
            $("#valor_total").val(formatter.format( format_total.toFixed(2) ) );
            //alert( formatter.format( format_total.toFixed(2) ));
        
        },
        error: function() {
            console.log("No se ha podido obtener la información");
        }

        }); 

    }



    $(document).on('click', '.btn_remove', function(){  
            var button_id = $(this).attr("id");
            
            var item = $("#pr_item" + button_id).val();
            var material_id = $("#material_id"  + button_id).val();
            var largo = $('#pr_largo' + button_id).val();
            var ancho =  $("#pr_ancho" + button_id).val();
            var cpu =  $("#pr_unit" + button_id).val();
            var cpi =  $("#pr_cpi" + button_id).val();

            $.ajax({
            type:'POST',
            url:'{{route("admin.trabajo_material.destroy")}}?id='+ "<?php echo $solicitud->materialOt->id; ?>",
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            data:{item:button_id, material_id:material_id, largo:largo , ancho:ancho , unitario:cpu , parcial:cpi },
            success:function(data){
                
                $('#row'+button_id+'').remove();  

                    console.log(data.success);
/*                     document.getElementById('valor_neto').value = data.valor_neto;
                    document.getElementById('iva').value = data.iva;
                    document.getElementById('valor_incluido').value = data.total; */
                    
                //grandTotal();                      
            },
            error: function() {
                console.log("No se ha podido obtener la información");
            }

            });                      
            

        }); 

        $('#resuelta').change(function(){
            var mode= $(this).prop('checked');
            //alert(mode)
            // // submit the form 
            // $(#myForm).ajaxSubmit(); 
            // // return false to prevent normal browser submit and page navigation 
            // return false; 
            $.ajax({
            type:'POST',
            dataType:'JSON',
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            url:'{{route("admin.solicitud_material.cambiar_estado")}}?id='+ "<?php echo $solicitud->id; ?>",
            data:'mode='+mode,
            success:function(data)
            {
                //var data=eval(data);
                message=data.message;
                success=data.success;
                alert(success);
                /* $("#heading").html(success);
                $("#body").html(message); */
            }
            });

      });





</script>



@endsection