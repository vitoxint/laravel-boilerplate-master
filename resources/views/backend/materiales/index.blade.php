@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Registro de materiales')

@section('breadcrumb-links')
    @include('backend.materiales.includes.breadcrumb-links')
@endsection


@section('content')
<div class="card">
    <div class="card-body">
 

        <div class="row mt-0 mb-4">
            <div class="col border border-secondary">

            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Calcular dimensión material 
                </h4>
            </div><!--col-->
            <hr/>

            <div class="form-group row">
                {{ html()->label(__('Seleccionar material *'))->class('col-md-2 form-control-label')->for('material_id') }}

                <div class="col-md-6">                       
                    <select id="material_id" name="material_id" class="form-control" >                                       
                    </select>

                    
            
                </div><!--col-->
                <div class="col col-md-1"><button class="btn btn-success btn-sm" onclick="calcular()"><i class="fas fa-calculator"></i> Calcular </button></div>
                <div class="col col-md-1"><button class="btn btn-primary btn-sm" onclick="editar()"><i class="fas fa-edit"></i> Editar </button></div>
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
                    </div><!--col-->

            </div><!--form-group-->  

                                    

            </div><!--col-->
        </div><!--row-->


        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Registro de materiales <small class="text-muted">Todos los materiales</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.materiales.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
            <div class="table-responsive" id="no-more-tables">
                    <table class="table col-sm-12 table-bordered table-striped table-condensed cf">
                        <thead class="cf">
                        <tr>
                             
                             <!-- <th>Material</th>   -->
                             <th>Perfil</th>
                             <th>Código</th>                                  
                             <th>Medida/s</th>
                            <!--  <th>Ø Interior.</th>
                             <th>Espesor.</th> -->
                             <th>Densidad g/cm³</th>
                             <th>Valor Kg</th>
                             <th>Tipo corte</th>
                             <th>Proveedor</td>

                             <th style="width:45px;">@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($materiales as $material)
                            <tr>
                                
                                <!-- <td data-title="Material:">{{$material->material }} </td> -->
                                
                                <td data-title="Perfil">  
                                    @switch($material->perfil)
                                        @case(1)
                                            <h6>Barra </h6>
                                        @break
                                        @case(2)
                                            <h6>Barra perforada </h6>
                                        @break
                                        @case(3)
                                            <h6>Plancha </h6>
                                        @break

                                    @endswitch 
                           
                                </td>
                                <td data-title="Código">  {{$material->codigo }}   </td>
                                <td data-title="Medida/s" align="center"> 
                                    @switch($material->perfil)

                                        @case(1)
                                           {{$material->diam_exterior}} 
                                        @break;
                                        @case(2)
                                            {{$material->diam_exterior}}  {{ ' x '. $material->diam_interior}}
                                        @break
                                        @case(3)
                                            {{$material->espesor}}

                                    @endswitch

                                    @switch($material->sistema_medida)
                                            @case(1)
                                                 mm 
                                            @break
                                            @case(2)
                                                 " 
                                            @break

                                    @endswitch 

                                </td>
                                <td data-title="Densidad g/cm³" align="center"> {{$material->densidad}}  g/cm³</td>
                                <td data-title="Valor Kg" style="text-align:right;">@money($material->valor_kg) </td>
                                <td data-title="Tipo corte" >                                    
                                    @switch($material->tipo_corte)
                                            @case(1)
                                                 Completo 
                                                 @if($material->dimensionado != null)
                                                 <span> ( {{$material->dimensionado}} mm) </span>
                                                 @endif
                                            @break
                                            @case(2)
                                                 Dimensionado 
                                                 @if($material->dimensionado != null)
                                                 <span> ( {{$material->dimensionado}} mm) </span>
                                                 @endif
                                            @break

                                    @endswitch </td>
                                <td data-title="Proveedor/es" >{{$material->proveedor}}</td>
                                <td data-title="Acciones" class="btn-td">@include('backend.materiales.includes.actions', ['material' => $material])</td>
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
                    {!! $materiales->count() !!} 
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $materiales->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
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
            var precio = masa *( parseFloat( valor_kg  )  / 1000);

            $("#masa").val(masaKg.toFixed(3));
            $("#valor").val(  formatter.format(precio.toFixed(2)));
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
        
    </script>
@endsection
