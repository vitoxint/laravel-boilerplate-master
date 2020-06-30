<!DOCTYPE html>

<html>
<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<style>
 *{margin:0;padding:0;}
</style>

<div style="margin-top: 2px;">
    <table>
        <tr>
            <td style="text-align: left; width: 100px"><img src="{{ asset('img/backend/brand/marca.png') }}" width="62px" height="20px" /></td>
            <!-- <td style="text-align: right; width: 70px"><p style="font-size: 10px;  "><?php echo $producto->codigo  ?></p></td> -->


        </tr>
    </table>


<table  class="table table-sm" style="border:1px; /* padding-left:10px; padding-right:10px; */ padding-top:-1px;" >


    <tbody>

        <tr>
            <td style="padding-bottom:-15px; padding-top:1px;"> <p style="font-size: 6px; ">DESCRIPCIÓN: </p></td>         
        </tr>
        <tr>            
            <td style="padding-bottom:-15px; padding-top:1px;"> <p style="font-size: 9px;  "><?php echo Str::limit(strtoupper($producto->descripcion),30 )  ?></p></td>
        </tr>
        <tr>
            <td style="padding-bottom:-15px; padding-top:1px;"> <p style="font-size: 6px; ">MARCA: </p></td>           
        </tr>

        <tr>
            <td style="padding-bottom:-15px; padding-top:1px;"> <p style="font-size: 9px;  "><?php echo Str::limit(strtoupper($producto->marca->nombre), 30)  ?></p></td>
        </tr>

        <tr>
            <td  style="padding-bottom:-15px; padding-top:1px; text-align:center;"> <p style="font-size: 7px; font-weight: bold;"><?php echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($producto->codigo, 'C39',1,28,array(1,1,1), true) . '" alt="barcode"   />'; ?> </p></td>                     
        </tr>

    </tbody>
</table>


</div>





<div style="margin-top: -10px;">
    <table>
        <tr>
            <td style="text-align: left; width: 100px"><img src="{{ asset('img/backend/brand/marca.png') }}"  width="62px" height="20px" /></td>
           <!--  <td style="text-align: right; width: 70px"><p style="font-size: 10px;  "><?php echo $producto->codigo  ?></p></td> -->


        </tr>
    </table>


<table  class="table table-sm" style="border:1px; /* padding-left:10px; padding-right:10px; */ padding-top:-1px;" >


    <tbody>

        <tr>
            <td style="padding-bottom:-15px; padding-top:1px;"> <p style="font-size: 6px; ">DESCRIPCIÓN: </p></td>         
        </tr>
        <tr>            
            <td style="padding-bottom:-15px; padding-top:1px;"> <p style="font-size: 9px;  "><?php echo Str::limit(strtoupper($producto->descripcion), 30)  ?></p></td>
        </tr>
        <tr>
            <td style="padding-bottom:-15px; padding-top:1px;"> <p style="font-size: 6px; ">MARCA: </p></td>           
        </tr>

        <tr>
            <td style="padding-bottom:-15px; padding-top:1px;"> <p style="font-size: 9px;  "><?php echo Str::limit(strtoupper($producto->marca->nombre), 30)  ?></p></td>
        </tr>

        <tr>
            <td  style="padding-bottom:-25px; padding-top:1px; text-align:center;"> <p style="font-size: 7px; font-weight: bold;"><?php echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($producto->codigo, 'C39',1,28,array(1,1,1), true) . '" alt="barcode"   />'; ?> </p></td>                     
        </tr>

    </tbody>
</table>


</div>

