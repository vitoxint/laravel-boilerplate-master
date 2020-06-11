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
                <span style="padding-left: 500px;  font-weight: bold; font-size: 15px; color: green;">Orden de Trabajo: {{$trabajo->folio}}</span>
            </td>
        </tr>
    </table>

    <table border="0">
        <tr>
            <td style="width: 480px">
                <p style="font-size: 8px;"><b>INGENIERÍA Y MAESTRANZA ORECAL LTDA.</b><br>
                 RUT 76.285.390-6<br>
                 AV. LINCOYÁN Nº870, TELEFONO (56-41) 2223509<br>
                 CONCEPCIÓN - REGIÓN DEL BIO BÍO<br>
                 E-MAIL : ORECAL@ORECAL.CL<br>
                 SITIO WEB : WWW.ORECAL.CL</P>
            </td>
            <td>
                <span style=" font-size: 11px;"><?php
                 setlocale(LC_TIME, 'es_CL.utf8');
                    echo strftime("%A, %e de %B de %Y");
/*                     use Carbon\Carbon;
                    Carbon::setLocale('es_ES');
                    $fecha = Carbon::now();
                    $fecha->diffForHumans();
                    echo $fecha; */
                    ?></span>
            </td>
        </tr>
    
    </table>

    <div>
        <span>
            <p style="font-size: 10px;">Sres. <b>{{ $trabajo->cliente->razon_social }}</b> ,se ha emitido una nueva orden de trabajo para usted con los siguientes trabajos indicados en el detalle de esta orden: <p>
        </span>

    </div>

    <div class="datos">


        <table  class="table table-bordered table-sm" style="border:1px;" >
            <thead>
                <tr >
                    <td colspan="4" style="background-color:blue; padding-bottom:-10px;"> <p style="color:white; font-size: 10px;">Información de la Orden de Trabajo </p> </td>
                </tr>   
            </thead>

            <tbody>
                <tr>
                    <td style="padding-bottom:-10px;"> <p style="font-size: 10px; font-weight: bold; ">Cliente: </p>
                    <td style="padding-bottom:-10px;"> <p style="font-size: 10px; ">{{$trabajo->cliente->razon_social}}</p></td>
                    <td style="padding-bottom:-10px;"> <p style="font-size: 10px; font-weight: bold;">Vendedor: </p></td>
                    <td style="padding-bottom:-10px;"> <p style="font-size: 10px; ">{{ $trabajo->usuario['first_name'] . ' '. $trabajo->usuario['last_name'] }}</p></td>
                </tr>

                <tr>
                    <td style="padding-bottom:-10px;"> <p style="font-size: 10px; font-weight: bold;">Contacto: </p></td>
                    <td style="padding-bottom:-10px;"> <p style="font-size: 10px; ">
                                    @if($trabajo->representante)
                                        {{ $trabajo->representante->nombre }}
                                        @else
                                        {{ ' '}}
                                    @endif
                    </p></td>
                    <td style="padding-bottom:-10px;"> <p style="font-size: 10px; font-weight: bold;">Email vendedor: </p></td>
                    <td style="padding-bottom:-10px;"> <p style="font-size: 10px; "><?php echo $trabajo->usuario['email'] ?></p></td>
                </tr>

                <tr>
                    <td style="padding-bottom:-10px;"> <p style="font-size: 10px; font-weight: bold;">Teléfono/Email: </p></td>
                    <td style="padding-bottom:-10px;"> <p style="font-size: 10px; ">
                                    @if($trabajo->representante)
                                        {{ $trabajo->representante->telefono . ' ' . $trabajo->representante->email  }}
                                        @else
                                        {{ ' '}}
                                    @endif                    
                   
                    <?php   $fecha_ot = new Carbon\Carbon($trabajo->created_at); ?>
                    <td style="padding-bottom:-10px;"> <p style="font-size: 10px; font-weight: bold;">Fecha/hora emisión: </p></td>
                    <td style="padding-bottom:-10px;"> <p style="font-size: 10px; ">{{ $fecha_ot->format('d/m/Y H:i') }}</p></td>
                </tr>                

                <tr>
                    <td style="padding-bottom:-10px;"> <p style="font-size: 10px; font-weight: bold;">Cotización/OC ref.: </p></td>
                    <td style="padding-bottom:-10px;"> <p style="font-size: 10px; ">{{$trabajo->cotizacion.' '.$trabajo->orden_compra}}</p></td>
                    <td style="padding-bottom:-10px;"> <p style="font-size: 10px; font-weight: bold;">Entrega estimada: </p></td>
                    <td style="padding-bottom:-10px;"> <p style="font-size: 10px; "><?php echo $trabajo->entrega_estimada ?></p></td>
                </tr> 
            </tbody>
        </table>


        </br>

        <table  class="table table-bordered" style="border:1px;">
            <thead>

                <tr >
                    <td colspan="5" style="background-color:blue; padding-bottom:-10px; padding-left:5px; padding-top:3px;"> <p style="color:white; font-size: 10px;">Detalle de la orden. </p> </td>
                </tr>    

                <tr>
                    <td style="background-color:blue;  padding-top:3px; padding-bottom:-10px; text-align:center; width:7px"><p style="color:white; font-size: 10px; ">#</p></td>
                    <td style="background-color:blue;  padding-top:3px; padding-bottom:-10px; text-align:center; width:8px"><p style=" color:white; font-size: 10px; ">Cantidad</p></td>
                    <td style="background-color:blue;  padding-top:3px; padding-bottom:-10px; text-align:center;"><p style="color:white; font-size: 10px; ">Descripción del producto / trabajo </p></td>
                    <td style="background-color:blue;  padding-top:3px; padding-bottom:-10px; text-align:center; width:75px"><p style="color:white; font-size: 10px; ">Valor unitario </p></td>
                    <td style="background-color:blue;  padding-top:3px; padding-bottom:-10px; text-align:center; width:65px"><p style="color:white; font-size: 10px; ">Valor total</p></td>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($trabajo->items_ot as $item): ?>

                @if($item->especificaciones != '')               
                    <tr>
                        <td rowspan="2" style="text-align:center; padding-top:3px; padding-bottom:-10px;"><p style="font-size: 10px; font-weight:bold; "><?php echo $i++ ?></p> </td>
                        <td rowspan="2" style="text-align:center; padding-top:3px; padding-bottom:-10px;"><p style="font-size: 10px; font-weight:bold; "><?php echo $item["cantidad"] ?></p> </td>
                        <td style="padding-bottom:-10px; padding-top:3px;"><p style="font-size: 10px; font-weight:bold; "><?php echo $item["descripcion"] ?></p> </td>
                        <td rowspan="2" style="text-align:right; padding-top:3px; padding-bottom:-10px;"><p style="font-size: 10px; font-weight:bold; ">  @money($item->valor_unitario) </p> </td>
                        <td rowspan="2" style="text-align:right; padding-top:3px; padding-bottom:-10px;"><p style="font-size: 10px; font-weight:bold; ">@money($item->valor_parcial) </p> </td>
                    </tr>
                    <tr>
                      
                       <td style="padding-bottom:-10px; padding-top:3px;"><p style="font-size: 10px; font-weight:bold; ">Observaciones: <br><?php echo $item["especificaciones"] ?></p> </td>
                     
                   </tr>
                @else
                    <tr>
                        <td style="text-align:center; padding-top:3px; padding-bottom:-10px;"><p style="font-size: 10px; font-weight:bold; "><?php echo $i++ ?></p> </td>
                        <td style="text-align:center; padding-top:3px; padding-bottom:-10px;"><p style="font-size: 10px; font-weight:bold; "><?php echo $item["cantidad"] ?></p> </td>
                        <td style="padding-bottom:-10px; padding-top:3px;"><p style="font-size: 10px; font-weight:bold; "><?php echo $item["descripcion"] ?></p> </td>
                        <td style="text-align:right; padding-top:3px; padding-bottom:-10px;"><p style="font-size: 10px; font-weight:bold; ">  @money($item->valor_unitario) </p> </td>
                        <td style="text-align:right; padding-top:3px; padding-bottom:-10px;"><p style="font-size: 10px; font-weight:bold; ">@money($item->valor_parcial) </p> </td>
                    </tr>

                @endif
                <?php endforeach; ?>
                <tr>
                    <td style="text-align:center;"><br></td>
                    <td style="text-align:center;"><br></td>
                    <td style="text-align:center;"><br></td>
                    <td style="text-align:center;"><br></td>
                    <td style="text-align:center;"><br></td>
                   
                </tr>
                <tr>
                    <td colspan="3" style="padding-bottom:-10px; padding-top:3px;"><p style="font-size: 10px; font-weight:bold; "></p></td>
                    <td style="padding-bottom:-10px; padding-top:3px;"><p style="font-size: 10px; font-weight:bold; padding-top:3px; padding-bottom:-10px; ">Neto</p></td>
                    <td style="text-align:right; padding-top:3px; padding-bottom:-10px;"><p style="font-size: 10px; font-weight:bold; ">@money($trabajo->valor_total) </p></td>
                </tr>
                <tr>
                    <td colspan="3" rowspan="2" style="padding-bottom:-10px; padding-top:3px;"><p style="font-size: 10px; "><?php echo '' ?></p></td>
                    <td style="padding-bottom:-10px; padding-top:3px;"><p style="font-size: 10px; font-weight:bold;">19% (IVA)</p></td>
                    <td style="text-align:right; padding-top:3px; padding-bottom:-10px;"><p style="font-size: 10px; font-weight:bold; "> @money($trabajo->valor_total * 0.19) </p></td>
                </tr>
                <tr>
                    <td style="padding-bottom:-10px; padding-top:3px;"><p style="font-size: 10px; font-weight:bold;">Valor Total</p></td>
                    <td style="text-align:right; padding-top:3px; padding-bottom:-10px;"><p style="font-size: 10px; font-weight:bold; "><b>@money($trabajo->valor_total * 1.19)</b></p></td>
                </tr>
                <tr>
                    <td colspan="5"> <p style="font-size: 10px;"><span style="font-weight: bold;">Condiciones de pago : Abono 50% , saldo contra entrega </span> </p> </td>
                </tr>
            </tbody>
        </table>

        <p style="font-size: 10px;"> Saludos cordiales.  
        <?php echo $trabajo->usuario['first_name'].' '. $trabajo->usuario['last_name']; ?><br>
        <?php echo $trabajo->usuario['email'] ?></p>
        
    </div>
</div>
<br>

<div id="extra_informaciones" >
    <table border="0">
        <tr>
            <td valign="top" style="width: 200px">
                <p style="font-size: 10px; font-weight: bold;">Medios de Pago : </p>
            <td>
                <p style="font-size: 10px;">
                <b>*Efectivo</b><br>
                <b>*Transferencia bancaria:</b><br>
                    &nbsp; Ingeniería y Maestranza Orecal Ltda, RUT 76.285.390-6<br>
                    &nbsp; Cuenta corriente Banco BICE N° 03-01643-9<br>
                    &nbsp; Favor enviar comprobante a : vosorio@orecal.cl<br>
                <!-- <b>*Tarjetas de débito y crédito (Transbank).</b> -->
                </p>
            </td>
        </tr>
    </table>
    <br>
    <table border="1">
        <tr>
            <td valign="top" style="width: 600px">
                <p style="font-size: 10px; font-weight: bold;">Información importante para trabajos de corte y mecanizado: </p>
                <ol>
                    <!-- <li style="font-size: 10px;">En Difierro sólo tenemos planchas de fierro calidad ASTM A-36.</li> -->
                    <li style="font-size: 10px;">El cliente deberá entregar archivo vectorial trazado en formato DWG o DXF. En caso de enviar archivo en PDF el cliente deberá acotar las medidas de los planos.</li>
                    <li style="font-size: 10px;">Esta  cotización  ha sido  realizada según planos enviado por el cliente, por lo que cualquier modificación de estos podría  hacer variar los valores de la presente cotización.</li>
                    <li style="font-size: 10px;">Al aceptar esta cotización el cliente aprueba los planos enviados para cotizar y/o los desarrollados por los ingenieros de Maestranza Orecal.</li>
                    <li style="font-size: 10px;">El  trabajo deberá  ser retirado  por el cliente  en las dependencias de Ingeniería y Maestranza Orecal. Se eliminará todo despunte si éste no es retirado junto con el trabajo de corte.</li>
                    <li style="font-size: 10px;">El corte por agua tiene una toleración de +- 0,3 mm aproximadamente. En espesores superiores la tolerancia puede ser mayor.<span style="text-decoration: underline;">El oxicorte y el corte por plasma no son corte de precisión</span>, por lo que debe considerar una mayor tolerancia de +- 3mm para piezas cortadas con esos procesos.</li>
                    <li style="font-size: 10px;"><span style="text-decoration: underline;">Si el cliente proporciona el material éste debe venir según las condiciones exigidas por Orecal para la recepción de material, sin pintura, óxido, ni ningún otro tipo de impureza y completamente lisas. En caso contrario Maestranza Orecal cobrará un costo extra asociado al proceso de limpieza del material.</span></li>
                    <li style="font-size: 10px;">Los materiales deben considerar un margen para regular la máquina de corte por agua y márgenes para el corte. Se debe considerar además la posibilidad que alguna pieza presente defectos en el corte, por lo que deba ser cortada nuevamente.</li>
                    <li style="font-size: 10px;">No se reciben retazos de planchas ni materiales ya cortados.</li>
                </ol>
            </td>
        </tr>
    </table>
</div>