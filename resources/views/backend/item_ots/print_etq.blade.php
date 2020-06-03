<!DOCTYPE html>

<html>
<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<style>
 *{margin:0;padding:0;}
</style>

<div>
    <table>
        <tr>
            <td style="text-align: center; width: 450px"><img src="{{ asset('img/backend/brand/marca.png') }}" width="130px" /></td>
        </tr>
    </table>

    <table>
        <tr>
            <td style="width: 450px; padding-bottom:-18px; text-align: center;">
                <p style="font-size: 10px;"><b>INGENIERÍA Y MAESTRANZA ORECAL LTDA.</b></p>
            </td>
        </tr>
        <tr>
            <td style="width: 240px; padding-bottom:-18px; text-align: center;">
                <p style="font-size: 10px;"><b>LINCOYÁN #870, CONCEPCIÓN.</b></p>
            </td>
        </tr>
         <tr>
            <td style="width: 240px; padding-bottom:-10px; text-align: center;">
                <p style="font-size: 10px;"><b>TEL.(41)222 3509 - WWW.ORECAL.CL.</b></p>
            </td>

        </tr> 
    
    </table>



<table  class="table table-bordered table-sm" style="border:2px; padding-left:10px; padding-right:10px; padding-top:2px;" >


    <tbody>
        <!-- <tr>
            <td style="padding-bottom:-15px; padding-top:1px;"> <p style="font-size: 12px; font-weight: bold; ">ORDEN: </p>
            <td style="padding-bottom:-15px; padding-top:1px;"> <p style="font-size: 12px; font-weight:bold; ">{{$item_ot->ordenTrabajo->folio}}</p></td>
        </tr> -->
        <tr>
            <td style="padding-bottom:-15px; padding-top:1px;"> <p style="font-size: 12px; font-weight: bold;">ÍTEM OT: </p></td>
            <td style="padding-bottom:-15px; padding-top:1px;"> <p style="font-size: 12px; font-weight:bold; ">{{$item_ot->folio}}</p></td>
        </tr>

        <tr>
            <td style="padding-bottom:-15px; padding-top:1px;"> <p style="font-size: 12px; font-weight: bold;">DESCRIPCIÓN: </p></td>
            <td style="padding-bottom:-15px; padding-top:1px;"> <p style="font-size: 12px; font-weight:bold; "><?php echo Str::limit($item_ot->descripcion, 50)  ?></p></td>
        </tr>

        <tr>
            <td style="padding-bottom:-15px; padding-top:1px;"> <p style="font-size: 12px; font-weight: bold;">CLIENTE: </p></td>
            <td style="padding-bottom:-15px; padding-top:1px;"> <p style="font-size: 12px; font-weight: bold; "><?php echo Str::limit($item_ot->ordenTrabajo->cliente->razon_social, 50)  ?></p></td>
        </tr>
<!--         <tr>
            <td style="padding-bottom:-15px; padding-top:2px;"> <p style="font-size: 7px; font-weight: bold;">VENDEDOR: </p></td>
            <td style="padding-bottom:-15px; padding-top:2px;"> <p style="font-size: 7px; "><?php echo $item_ot->ordenTrabajo->usuario->first_name . ' '. $item_ot->ordenTrabajo->usuario->last_name ?></p></td>
        </tr> -->

        <tr>
            <td style="padding-bottom:-15px; padding-top:1px;"> <p style="font-size: 12px; font-weight: bold;">FECHA/HORA: </p></td>
            <?php   $fecha = new Carbon\Carbon(now()); ?>
            <td style="padding-bottom:-15px; padding-top:1px;"> <p style="font-size: 12px; font-weight: bold;">{{ $fecha->format('d/m/Y H:i') }}</p></td>
        </tr>
        <tr>
            <td colspan="2" style="padding-bottom:-15px; padding-top:1px; text-align:center;"> <p style="font-size: 8px; font-weight: bold;"><?php echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($item_ot->folio, 'C39',1.5,36,array(1,1,1), true) . '" alt="barcode"   />'; ?> </p></td>
                      
        </tr>

    </tbody>
</table>


</div>

