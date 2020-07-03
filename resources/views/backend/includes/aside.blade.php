<aside class="aside-menu col-md-2">

Tema fondo: 
<select name="select" class="form-control">
    <option value="black" selected>-Seleccione un color para otra cosa-</option> 
    <option value="black">Negro</option> 
    <option value="lavender">Claro</option> 
    <option value="salmon">Salmón</option> 
    <option value="lightpink">Light Pink</option>
    <option value="olive">Olivo</option>
    <option value="orangered">Naranja</option>

    <option value="brown">Marrón</option> 
    <option value="orange">Amarillo</option>
    <option value="magenta">Magenta</option>
    <option value="green">Verde</option> 
    <option value="#004C70">Azul metálico</option> 
    <option value="Blue">Azul</option>
    <option value="Cyan">Cyan</option>
    <option value="darkviolet">Violeta</option> 

    
 </select>


</aside>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" /> -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>

<script>
//localStorage.getItem("Apellido");

$("body").css("background-color",localStorage.getItem("color_app"));

$("select").change(function() {
    $("body").css("background-color",this.value);
    localStorage['color_app'] = this.value; // only strings

});

</script>
