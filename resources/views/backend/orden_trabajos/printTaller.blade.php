<!DOCTYPE html>

<html>
<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<div>
    <table border="0">
        <tr>
            <td style="text-align: left; width: 475px"><img src="{{ asset('img/backend/brand/marca.png') }}" width="150px" /></td>
            <td>         </td>
            <td>
                <span style="padding-left: 500px;  font-weight: bold; font-size: 15px; color: green;">Orden de Trabajo: {{$trabajo->folio}}</span><br>
                <span style="padding-left: 500px;  font-weight: bold; font-size: 15px; color: blue;">Control Interno</span>
            </td>
        </tr>

    </table>

    <table border="0">
        <tr>
            <td style="width: 480px">
                <p style="font-size: 8px;"><b>INGENIERÍA Y MAESTRANZA ORECAL LTDA.</b><br>
                 RUT 76.285.390-6<br>
                 AV. LINCOYÁN Nº870, TELEFONO (56-41) 2223509 
                 CONCEPCIÓN - REGIÓN DEL BIO BÍO</P>
            </td>
            <td>
                <span style=" font-size: 11px;"><?php
                 setlocale(LC_TIME, 'es_CL.utf8');
                    echo strftime("%A, %e de %B de %Y");

                    ?></span>
            </td>
        </tr>
    
    </table>


    <div class="datos">


        <table  class="table table-bordered table-sm" style="border:1px;" >
            <thead>
                <tr >
                    <td colspan="4" style="background-color:blue; padding-bottom:-10px;"> <p style="color:white; font-size: 10px;">Datos generales </p> </td>
                </tr>   
            </thead>

            <tbody>
                <tr>
                    <td style="padding-bottom:-10px;"> <p style="font-size: 10px; font-weight: bold; ">Cliente: </p>
                    <td style="padding-bottom:-10px;"> <p style="font-size: 10px; ">{{$trabajo->cliente->razon_social}}</p></td>
                    <td style="padding-bottom:-10px;"> <p style="font-size: 10px; font-weight: bold;">Encargado: </p></td>
                    <td style="padding-bottom:-10px;"> <p style="font-size: 10px; ">{{ $trabajo->usuario['first_name'] . ' '. $trabajo->usuario['last_name'] }}</p></td>
                </tr>

                <tr>
                        <?php   $fecha_ot = new Carbon\Carbon($trabajo->created_at); ?>
                    <td style="padding-bottom:-10px;"> <p style="font-size: 10px; font-weight: bold;">Fecha/hora emisión: </p></td>
                    <td style="padding-bottom:-10px;"> <p style="font-size: 10px; "> {{ $fecha_ot->format('d/m/Y H:i') }}</p></td>

                    <td style="padding-bottom:-10px;"> <p style="font-size: 10px; font-weight: bold;">Fecha entrega: </p></td>
                    <?php   $fecha_entrega = new Carbon\Carbon($trabajo->entrega_estimada); ?> 
                    <td style="padding-bottom:-10px;"> <p style="font-size: 10px; "><?php echo $fecha_entrega->format('d/m/Y') ?></p></td>
                </tr>
            </tbody>
        </table>


        </br>

<!--         <table  class="table table-bordered" style="border:1px;">
            <thead>
                <tr >
                    <td  style="background-color:blue; padding-bottom:-10px; padding-left:5px; padding-top:3px;"> <p style="color:white; font-size: 10px;">Trabajos. </p> </td>
                </tr>    
            </thead>
        </table> -->
        
            <?php $i = 1; ?>
            <?php foreach ($trabajo->items_ot as $item): ?>

        <table  class="table table-bordered" style="border:1px;">
            <thead>
                <tr >
                    <td colspan="3" style="background-color:blue; padding-bottom:-10px; padding-left:5px; padding-top:3px;"> <p style="color:white; font-size: 11px; font-weight:bold;">Item : {{$item->folio}} </p> </td>
                </tr>
                <tr>
                    <td style="background-color:blue;  padding-top:3px; padding-bottom:-10px; text-align:center; width:7px"><p style="color:white; font-size: 10px; ">#</p></td>
                    <td style="background-color:blue;  padding-top:3px; padding-bottom:-10px; text-align:center; width:8px"><p style=" color:white; font-size: 10px; ">Cantidad</p></td>
                    <td colspan="1" style="background-color:blue;  padding-top:3px; padding-bottom:-10px; "><p style="color:white; font-size: 10px; ">Descripción del producto / trabajo </p></td>
                <!--                     <td style="background-color:blue;  padding-top:3px; padding-bottom:-10px; text-align:center; width:75px"><p style="color:white; font-size: 10px; ">Valor unitario </p></td>
                    <td style="background-color:blue;  padding-top:3px; padding-bottom:-10px; text-align:center; width:65px"><p style="color:white; font-size: 10px; ">Valor total</p></td> -->
                </tr>
            </thead>                

            <tbody>


                @if($item->especificaciones != '')               
                    <tr>
                        <td rowspan="2" style="text-align:center; padding-top:3px; padding-bottom:-10px;"><p style="font-size: 10px; font-weight:bold; "><?php echo $i++ ?></p> </td>
                        <td rowspan="2" style="text-align:center; padding-top:3px; padding-bottom:-10px;"><p style="font-size: 10px; font-weight:bold; "><?php echo $item["cantidad"] ?></p> </td>
                        <td style="padding-bottom:-10px; padding-top:3px;"><p style="font-size: 10px; font-weight:bold; "><?php echo $item["descripcion"] ?></p> </td>
<!--                         <td rowspan="2" style="text-align:right; padding-top:3px; padding-bottom:-10px;"><p style="font-size: 10px; font-weight:bold; ">  @money($item->valor_unitario) </p> </td>
                        <td rowspan="2" style="text-align:right; padding-top:3px; padding-bottom:-10px;"><p style="font-size: 10px; font-weight:bold; ">@money($item->valor_parcial) </p> </td> -->
                    </tr>
                    <tr>
                      
                       <td style="padding-bottom:-10px; padding-top:3px;"><p style="font-size: 10px; font-weight:bold; ">Observaciones: <br><?php echo $item["especificaciones"] ?></p> </td>
                     
                   </tr>
                @else
                    <tr>
                        <td style="text-align:center; padding-top:3px; padding-bottom:-10px;"><p style="font-size: 10px; font-weight:bold; "><?php echo $i++ ?></p> </td>
                        <td style="text-align:center; padding-top:3px; padding-bottom:-10px;"><p style="font-size: 10px; font-weight:bold; "><?php echo $item["cantidad"] ?></p> </td>
                        <td style="padding-bottom:-10px; padding-top:3px;"><p style="font-size: 10px; font-weight:bold; "><?php echo $item["descripcion"] ?></p> </td>
<!--                         <td style="text-align:right; padding-top:3px; padding-bottom:-10px;"><p style="font-size: 10px; font-weight:bold; ">  @money($item->valor_unitario) </p> </td>
                        <td style="text-align:right; padding-top:3px; padding-bottom:-10px;"><p style="font-size: 10px; font-weight:bold; ">@money($item->valor_parcial) </p> </td> -->
                    </tr>

                @endif
                
            </tbody>

 
        </table>

        <table class="table table-bordered" style="border:1px; padding-top:-15px;">
            <thead>
                <tr>
                    <!-- <td style="background-color:grey;  padding-top:3px; padding-bottom:-10px; text-align:center; width:7px"><p style="color:white; font-size: 10px; ">#</p></td> -->
                    <td style="background-color:grey;  padding-top:3px; padding-bottom:-10px;  "><p style=" color:white; font-size: 10px; ">Proceso</p></td>
                    <td style="background-color:grey;  padding-top:3px; padding-bottom:-10px; "><p style="color:white; font-size: 10px; ">Máquina </p></td>
                    <td style="background-color:grey;  padding-top:3px; padding-bottom:-10px; text-align:center;  "><p style="color:white; font-size: 10px; ">Recurso principal</p></td>
                    <td style="background-color:grey;  padding-top:3px; padding-bottom:-10px; "><p style="color:white; font-size:10px; ">Hora tentativa entrega </p></td>
                    <td style="background-color:grey;  padding-top:3px; padding-bottom:-10px; text-align:center; width:10px"><p style="color:white; font-size: 10px; ">Check</p></td>
                </tr>
            </thead>
            
            <tbody>
            <?php $j = 1; ?>
            <?php foreach($item->procesosOt as $proceso): ?>
                <tr>
                    <!-- <td style="text-align:center; padding-top:3px; padding-bottom:-10px;"><p style="font-size: 10px; font-weight:bold; ">></p> </td> -->
                    <td style="padding-top:3px; padding-bottom:-10px;"><p style="font-size: 10px; font-weight:bold; "><?php echo $j++ ?>.-<?php echo $proceso->proceso->descripcion ?></p> </td>
                    <td style="padding-bottom:-10px; padding-top:3px;"><p style="font-size: 10px; font-weight:bold; "><?php echo  $proceso->maquina->codigo  ?></p> </td>
                         <td style="text-align:right; padding-top:3px; padding-bottom:-10px;"><p style="font-size: 10px; font-weight:bold; ">  
                                @switch($proceso->proceso->tipo_valorizacion)
                                    @case('1')
                                        {{$proceso->tiempo_asignado}} hora/s
                                    @break
                                    @case('2')
                                        {{$proceso->cantidad}} Kg
                                    @break
                                    @case('3')
                                    {{$proceso->cantidad}} operacion/es
                                    @break
                                @endswitch  
                          </p> </td>
                    <td style="text-align:right; padding-top:3px; padding-bottom:-10px;"><p style="font-size: 10px; font-weight:bold; ">
                    <?php $ftermino= new Carbon\Carbon($proceso->fh_termino);
                             $ftermino = $ftermino->format('d/m/Y h:i'); echo $ftermino;?> 
                    
                     </p> </td> 
                     <td style="align-text:center; padding-top:3px; padding-bottom:-10px;">
                        @if($proceso->estado_avance == 4)
                            <p style="font-size: 10px; font-weight:bold;">OK</b>
                        @endif
                     </td>
                </tr>
                <?php endforeach ?>   
            </tbody>
        </table>

        <table class="table table-bordered" style="border:1px; padding-top:-15px;">
            <thead>
                <tr>
                    <!-- <td style="background-color:grey;  padding-top:3px; padding-bottom:-10px; text-align:center; width:7px"><p style="color:white; font-size: 10px; ">#</p></td> -->
                    <td style="background-color:grey;  padding-top:3px; padding-bottom:-10px;  "><p style=" color:white; font-size: 10px; ">Material</p></td>
                    <td style="background-color:grey;  padding-top:3px; padding-bottom:-10px; "><p style="color:white; font-size: 10px; ">Dimensión del corte </p></td>
<!--                     <td style="background-color:grey;  padding-top:3px; padding-bottom:-10px; text-align:center;  "><p style="color:white; font-size: 10px; ">Recurso principal</p></td>
                    <td style="background-color:grey;  padding-top:3px; padding-bottom:-10px; "><p style="color:white; font-size: 10px; ">Hora tentativa entrega </p></td> -->
                    <td style="background-color:grey;  padding-top:3px; padding-bottom:-10px; text-align:center; width:10px"><p style="color:white; font-size: 10px; ">Disponible</p></td>
                    <td style="background-color:grey;  padding-top:3px; padding-bottom:-10px; text-align:center; width:10px"><p style="color:white; font-size: 10px; ">Utilizado</p></td>
                </tr>
            </thead>
            
            <tbody>
            <?php $k = 1; ?>
            <?php foreach($item->materialOt as $material): ?>
                <tr>
                    <td style="padding-top:3px; padding-bottom:-10px;"><p style="font-size: 10px; font-weight:bold; "><?php echo $k++ ?>.-<?php echo $material->material->material ?></p> </td>
                    
                         <td style="text-align:center; padding-top:3px; padding-bottom:-10px;"><p style="font-size: 10px; font-weight:bold; ">  
                                @switch($material->material->perfil)
                                    @case('1')
                                        {{$material->dimension_largo}} mm
                                    @break
                                    @case('2')
                                        {{$material->dimension_largo}} mm
                                    @break
                                    @case('3')
                                        {{$material->dimension_largo}} x {{$material->dimension_ancho}} mm
                                    @break
                                @endswitch  
                          </p> </td>
                     <td></td>
                     <td></td>
                </tr>
                <tr >
                    <td colspan="4" style=" text-align:center;  padding-bottom:-10px; padding-left:5px; padding-top:3px;"> <p style=" font-size: 10px;">**************************************************** </p> </td>
                </tr>
                <?php endforeach ?>   
            </tbody>
        </table>

        <?php endforeach; ?>
        
    </div>
</div>
<br>

