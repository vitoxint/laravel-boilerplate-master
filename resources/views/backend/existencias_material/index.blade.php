@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Existencia de materiales (metálicos)')


@section('content')
<div class="card">
    <div class="card-body">


    <div class="row mt-0 mb-4">
            <div class="col border border-secondary">

            <div class="col-sm-5">
                <h4 class="card-title mb-0" >
                    Depositar corte de material
                </h4>
            </div><!--col-->
            <hr/>

            <div class="form-group row">
                {{ html()->label(__('Seleccionar material *'))->class('col-md-2 form-control-label')->for('material_id') }}

                <div class="col-md-6">                       
                    <select id="material_id" name="material_id" class="form-control" >                                       
                    </select>

                    
            
                </div><!--col-->
                <div  class="col col-md-3"><button class="btn btn-success btn-sm" onclick="calcular()"><i class="fas fa-calculator"></i> Calcular </button>
                <button class="btn btn-primary btn-sm" onclick="editar()"><i class="fas fa-edit"></i> Editar </button></div>
            </div><!--form-group-->

            <div class="form-group row" style="padding-top:10px;">

                    {{ html()->label('Ingresar dimensiones :')->class('col-md-2 form-control-label')->for('') }}

                    {{ html()->label('Largo (mm):')->class('col-md-1 form-control-label')->for('largo') }}

                    <div class="col-md-2">
                        {{ html()->text('largo')
                            ->class('form-control')
                                                        
                            ->attribute('maxlength', 191)                                          
                            ->autofocus()                                   
                            }}
                    </div><!--col-->

                    {{ html()->label('Ancho (mm):')->class('col-md-1 form-control-label')->for('ancho') }}

                    <div class="col-md-2">
                        {{ html()->text('ancho')
                            ->class('form-control')
                            
                            ->attribute('maxlength', 191)                                            
                            ->autofocus()

                            }}
                    </div><!--col-->

                    {{ html()->label('Valor Kg:')->class('col-md-1 form-control-label')->for('valor_unit') }}

                    <div class="col-md-2">
                        {{ html()->text('valor_unit')
                            ->class('form-control')                            
                            ->attribute('maxlength', 191)                                            
                            ->autofocus()
                            }}
                    </div><!--col-->                    

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
                            ->value(0)
                            ->disabled()
                            ->attribute('maxlength',
                                191)                                            
                            ->autofocus()

                            }}
                            <input type="text" id="valor2" hidden="true" />
                    </div><!--col-->
               
            </div><!--form-group-->

            <div class="form-group row" style="padding-top:10px;">
                    {{ html()->label('Origen :')->class('col-md-2 form-control-label')->for('') }}

                    {{ html()->label('Tipo origen:')->class('col-md-1 form-control-label')->for('sistema_medida') }}
                        <div class="col-md-2">

                        {{ html()->select('origen',array('1' => 'Mediante Compra', '2' => 'Retazo' , '3' => 'Proporcionado por cliente'))
                                ->class('form-control')
                                ->attribute('maxlength', 191) 
                                ->value('Seleccione')
                                ->required()
                                
                            }}
                        </div><!--col--> 

                        {{ html()->label('Depósito:')->class('col-md-1 form-control-label')->for('deposito') }}
                        <div class="col-md-3">

                        <?php $depositos = App\Deposito::where('estado_habilitada','1')->get(); ?>

                                <select id="deposito" name="deposito" class="form-control" >
                                        
                                        @foreach($depositos as $deposito)
                                            <option value="{{$deposito->id}}"> {{$deposito->nombre}}</option>
                                        @endforeach
                                </select>
                        </div><!--col--> 

            </div><!--form-group-->

            <div class="form-group row" style="padding-top:10px;">
                    {{ html()->label('')->class('col-md-2 form-control-label')->for('') }}

                    {{ html()->label('Detalle:')->class('col-md-1 form-control-label')->for('detalle_origen') }}

                    <div class="col-md-6">
                        {{ html()->text('detalle_origen')
                            ->class('form-control')
                            ->placeholder('Guía, Factura,  Cliente ,etc')
                            ->attribute('maxlength', 191)                                            
                            ->autofocus()

                            }}
                    </div><!--col-->

            </div><!--form-group-->           


            <div class="form-group row">
                {{ html()->label(__(''))->class('col-md-9 form-control-label')->for('') }}

                <div class="col-md-8">                       

                </div><!--col-->
                <div  class="col col-md-3"><button class="btn btn-dark btn-sm" onclick="depositar()"><i class="fas fa-arrow-down"></i> Depositar </button>
                <!-- <button class="btn btn-danger btn-sm" onclick="consumir()"><i class="fas fa-arrow-up"></i> Consumir </button> --></div>
            </div><!--form-group-->

            

            </div><!--col-->
        </div><!--row-->
    </div>                  
    </div>

<div class="card">
    <div class="card-body">
        <div class="row mt-0 mb-4">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Existencia de materiales <small class="text-muted">Todos los materiales metálicos</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.existencias_material.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
            <div class="table-responsive" id="no-more-tables">
                    <table class="table col-sm-12 table-bordered table-striped table-condensed cf">
                        <thead class="cf">
                        <tr>
                             <th>Material</th>
                             <th>Depósito</th>
                             <th>Dimensión disponible</th>
                             <th>Origen</th> 
                             <th>Descripción origen</th>
                             <th>Valor corte</td>
                             <th>Estado</th>

                             <th style="width:45px;">@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody id="list-table">
                        @foreach($existencias as $existencia)
                            <tr>
                                <td data-title="Material">{{ $existencia->material->material }}</td>
                                <td data-title="Ubicación:">{{ $existencia->deposito->nombre }}</td>
                                
                                
                                <td data-title="Dimensiones"> 
                                    @switch($existencia->material->perfil)

                                        @case(1)
                                             {{$existencia->dimension_largo}} mm
                                        @break;

                                        @case(2)
                                             {{$existencia->dimension_largo}} mm
                                        @break;

                                        @case(3)
                                            {{$existencia->dimension_largo}}  {{ ' x '. $existencia->dimension_ancho}} mm
                                        @break;

                                    @endswitch
                                        
                                   
                                </td>
                                <td data-title="Tipo Origen" align="center">
                                    @switch($existencia->origen_material)  
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
                                 </td>
                                <td data-title="Detalle origen">   
                                    {{$existencia->detalle_origen}}                                    
                                </td>   
                                <td data-title="Valor"> @money($existencia->valor_total)</td>
                                <td style="text-align:center;" data-title="Estado material">
                                    @switch($existencia->estado_consumo)  
                                        @case(1)
                                        <span class="badge btn-success" style="border-radius:10px;"><p style="margin:4px; font-size:12px;"> Disponible </p>  </span>
                                        @break;
                                        @case(2)
                                        <span class="badge btn-warning" style="border-radius:10px;"><p style="margin:4px; font-size:12px;"> Asignado </p>  </span>
                                        @break;
                                        @case(3)
                                        <span class="badge btn-dark" style="border-radius:10px;"><p style="margin:4px; font-size:12px;"> Utilizado </p>  </span>
                                        @break;
                                    
                                    @endswitch

                                </td>  
                                                                                           
                                <td data-title="Acciones" class="btn-td">@include('backend.existencias_material.includes.actions', ['existencia' => $existencia])</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $existencias->count() !!} 
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $existencias->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->



<!-- Script -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" /> -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>
   
  <script>
        $.fn.select2.defaults.set('language', 'es');

        var formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
            });



//variables tabla calculo
        var perfil ;
        var densidad;
        var valor_kg;
        var diam_exterior;
        var diam_interior;
        var espesor;
        var sistema_medida;
        var dimensionado = '';
 
        $('#material_id').select2({
            placeholder: "Seleccionar...",
            minimumInputLength: 3,
            ajax: {
                url: "{{route('admin.materiales.dataAjax')}}",
                dataType: 'json',
                language: "es",
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };

                },
                processResults: function (data) {
                    return {
                        results: data
                    };   
                    let perfil ;
                   
                },
                cache: true
            },           
        });

        $('#valor_unit').on('change', function (){

            calcular();

        });

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
            var precio = masa *( parseFloat( $("#valor_unit").val()  )  / 1000);

            $("#masa").val(masaKg.toFixed(3));
            $("#valor").val(  formatter.format(precio.toFixed(2)));
            $("#valor2").val(precio);
        }


        function editar() {
      
            var materialID = $("#material_id").val(); 
  
            
            if(materialID){
                $.ajax({
                //    type:"GET",
                //    url:"{{url('admin.get-commune-list')}}?region_id="+regionID,
                    url: "{{ route('admin.edit-material') }}?material_id=" + materialID,
                    method: 'GET',
                    success:function(res){               
                    if(res){
                        console.log('success');
                        window.location.replace("{{route('admin.materiales.abrir')}}?material_id="+materialID);


                    }else{
                        // $("#representante_id").empty();
                    }
                    }
                });
            }else{
                //$("#commune_id").empty();
                
            }      
        }


    function editar_deposito(id) {
        
      if(id){
          $.ajax({
          //    type:"GET",
          //    url:"{{url('admin.get-commune-list')}}?region_id="+regionID,
              url: "{{ route('admin.edit-existencia_material') }}?id=" +id,
              method: 'GET',
              success:function(res){               
                if(res){
                    console.log('success');
                    window.location.replace("{{route('admin.existencia_material.abrir')}}?id="+id);


                }else{
                    // $("#representante_id").empty();
                }
                }
            });
        }else{
            //$("#commune_id").empty();
            
        }      
    }

    function eliminar_deposito(id){

        if(id){
          $.ajax({
          //    type:"GET",
          //    url:"{{url('admin.get-commune-list')}}?region_id="+regionID,
              url: "{{ route('admin.eliminar-existencia_material') }}?id=" +id,
              method: 'GET',
              success:function(res){               
                if(res){
                    console.log('success');
                    $("#tr"+id).remove();


                }else{
                    // $("#representante_id").empty();
                }
                }
            });
        }else{
            //$("#commune_id").empty();
            
        }      

    }




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
            
            if(materialID){
                $.ajax({
                //    type:"GET",
                //    url:"{{url('admin.get-commune-list')}}?region_id="+regionID,
                    url: "{{ route('admin.get-datos-material') }}?material_id=" + materialID,
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

                        if(dimensionado != '') {
                            var res = dimensionado.split("x");
                            $("#largo").val(res[0]);
                            $("#ancho").val(res[1]);
                                                       
                                                        
                        }else{
                            $("#largo").val(0);
                            $("#ancho").val(0);
                            //$("#valor_unit").val(valor_kg);   
                        }
                        
                      /*   
                        $("#largo").val(0);
                        $("#ancho").val(0); */
                        $("#valor_unit").val(valor_kg); 
                        $("#volumen").val(0);
                        $("#masa").val(0);
                        $("#valor").val(0);
                        $("#valor2").val(0);

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
            var precio = masa *( parseFloat( $("#valor_unit").val()  )  / 1000);

            $("#masa").val(masaKg.toFixed(3));
            $("#valor").val( formatter.format(precio.toFixed(2)));
            $("#valor2").val(precio);
            
        });

        $('#ancho').on('change', function() {
            
            var volumen ;
 
            if(perfil == 3){
                volumen = volumen_plancha();

                volumenLt = volumen/1000;

                $('#volumen').val(volumenLt.toFixed(3));

                var masa = parseFloat(densidad) * (volumen);
                var masaKg = masa/1000;
                var precio = masa * ( parseFloat(   $("#valor_unit").val()  )  / 1000);

                $("#masa").val(masaKg.toFixed(3));
                $("#valor").val( formatter.format(precio.toFixed(2)));
                $("#valor2").val(precio);

            }
  
        });

        //alert(toDeci("1-1/4"));

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

            function depositar(){

                var materialID = $("#material_id").val(); 
    
                var largo = $('#largo').val();
                var ancho =  $("#ancho").val();
                var cpu =  $("#valor_unit").val();
                var cpi =  $("#valor2").val();
                var origen = $("#origen").val();
                var detalle_origen = $("#detalle_origen").val();
                var deposito = $("#deposito").val();
           
                    if(materialID){
                        $.ajax({                      
                            url: "{{ route('admin.existencia_material.store') }}?material_id=" + materialID,
                            method: 'POST',
                            headers:{
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data:{largo:largo , ancho:ancho , cpu:cpu , cpi:cpi, origen:origen,detalle_origen:detalle_origen, deposito:deposito },
                            success:function(data){               
                            if(data){
                                console.log(data.success);
                                //window.location.replace("{{route('admin.existencia_material.index')}}");
                                //window.location.href = window.location.href;

                                
                                var strEx = data.valor_total;
                                //primer paso: fuera puntos
                                strEx = strEx.replace(",","");
                                //cambiamos la coma por un punto
                                //strEx = strEx.replace(",",".");
                                //listo
                                var numFinal = parseFloat(strEx);

                                $('#list-table').append('<tr id="tr'+data.id+'"><td data-title="Material">'+data.material+'</td> <td data-title="Ubicación:">'+data.deposito+'</td> <td data-title="Dimensiones"> '+data.dimension+'</td><td data-title="Tipo Origen" align="center">'+data.tipo_origen+' </td> <td data-title="Detalle origen">'+data.detalle_origen+'</td>  <td data-title="Valor"> ' +formatter.format(numFinal.toFixed(2))+'</td>'+
                                ' <td style="text-align:center;" data-title="Estado material"> <span class="badge btn-success" style="border-radius:10px;"><p style="margin:4px; font-size:12px;"> Disponible </p>  </span></td>' +
                                '<td data-title="Acciones" > <button class="btn btn-dark btn-sm" onclick="editar_deposito('+data.id+')"><i class="fas fa-sliders-h"></i>  </button> ' +
                                '<button class="btn btn-danger btn-sm" onclick="eliminar_deposito('+data.id+')"><i class="fas fa-trash"></i>  </button></td></tr>'
                                );


                            }else{
                                // $("#representante_id").empty();
                            }
                            },
                            error:function(){
                                console.log('No se puede tener la informacion');
                            }
                        });
                    }else{
                        //$("#commune_id").empty();
                        
                    }      
                    }
            

            function consumir(){
                alert("Consumir");
            }
        
    </script>


@endsection
