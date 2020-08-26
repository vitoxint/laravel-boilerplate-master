@extends('backend.layouts.app')

@section('title','Existencia de materiales' . ' | ' . 'Ajustar existencia')

@section('content')

        <div class="card">
        {{ html()->modelForm($existenciaMaterial, 'PATCH', route('admin.existencia_material.update', $existenciaMaterial))->class('form-horizontal')->acceptsFiles()->open() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Existencias de materiales
                            <small class="text-muted">Ajustar existencia material</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                        <div class="col">

                    <div class="form-group row">
                        {{ html()->label(__('Material'))->class('col-md-2 form-control-label')->for('nombre_material') }}

                        <div class="col-md-6">                       
                                {{ html()->text('nombre_material')
                                    ->class('form-control')
                                    ->value($existenciaMaterial->material->material .'-'. $existenciaMaterial->material->proveedor)
                                    ->attribute('maxlength', 255) 
                                    ->disabled()
                                                                   
                                }}
                    
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('Depósito'))->class('col-md-2 form-control-label')->for('deposito_id') }}

                        <div class="col-md-4">
                                <?php $depositos = App\Deposito::pluck('nombre', 'id') ; ?>           
                                {{ html()->select('deposito_id', $depositos , $existenciaMaterial->deposito_id)
                                        ->class('form-control')
                                        ->placeholder('ubicación, local, sucursal, etc')                                                                       
                                }}
                                                    
                        </div>
                    </div><!--form-group--> 


                    <div class="form-group row" style="padding-top:10px;">
                        {{ html()->label('Origen :')->class('col-md-2 form-control-label')->for('') }}

                        {{ html()->label('Tipo origen:')->class('col-md-1 form-control-label')->for('sistema_medida') }}
                            <div class="col-md-2">

                            {{ html()->select('origen',array('1' => 'Mediante Compra', '2' => 'Retazo' , '3' => 'Proporcionado por cliente'), $existenciaMaterial->origen)
                                    ->class('form-control')
                                    ->attribute('maxlength', 191) 
                                    ->value('Seleccione')
                                    ->required()
                                    
                                }}
                            </div><!--col--> 

                    </div><!--form-group-->

                    <div class="form-group row" style="padding-top:10px;">
                        {{ html()->label('')->class('col-md-2 form-control-label')->for('') }}

                        {{ html()->label('Detalle:')->class('col-md-1 form-control-label')->for('detalle_origen') }}

                        <div class="col-md-5">
                            {{ html()->text('detalle_origen')
                                ->class('form-control')
                                ->placeholder('Guía, Factura,  Cliente ,etc')
                                ->attribute('maxlength', 191)                                            
                                ->autofocus()

                                }}
                        </div><!--col-->

                </div><!--form-group--> 


                <div class="form-group row" style="padding-top:10px;">

                    {{ html()->label('Dimensiones disponibles:')->class('col-md-2 form-control-label')->for('') }}

                    {{ html()->label('Largo (mm):')->class('col-md-1 form-control-label')->for('dimension_largo') }}

                    <div class="col-md-2">
                        {{ html()->text('dimension_largo')
                            ->class('form-control')                                                       
                            ->attribute('maxlength', 191)                                          
                            ->autofocus()                                   
                            }}
                    </div><!--col-->

                    {{ html()->label('Ancho (mm):')->class('col-md-1 form-control-label')->for('dimension_ancho') }}

                    <div class="col-md-2">
                        {{ html()->text('dimension_ancho')
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

                    {{ html()->label('Valor total:')->class('col-md-1 form-control-label')->for('valor_total') }}
                    <div class="col-md-2">
                        {{ html()->text('valor_total')
                            ->class('form-control')
                            ->value( '$  ' . number_format($existenciaMaterial->valor_total, 2) )
                            ->disabled()
                            ->attribute('maxlength',191)                                            
                            ->autofocus()

                            }}
                            <input type="text" id="valor_total2" name="valor_total2" value="{{$existenciaMaterial->valor_total}}" hidden="true" />
                    </div><!--col-->

                    </div><!--form-group-->

                    <div class="form-group row" style="padding-top:10px;">
                        

                        {{ html()->label('Estado consumo:')->class('col-md-2 form-control-label')->for('estado_consumo') }}
                            <div class="col-md-2">

                            {{ html()->select('estado_consumo',array('1' => 'Disponible', '2' => 'Asignado' , '3' => 'Consumido'), $existenciaMaterial->estado_consumo)
                                    ->class('form-control')
                                    ->attribute('maxlength', 191) 
                                   
                                    ->required()
                                    
                                }}
                            </div><!--col--> 

                    </div><!--form-group-->





                        </div><!--col-->
                    </div><!--row-->
                </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.existencia_material.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
                    </div><!--row-->
                </div><!--row-->
            </div><!--card-footer-->

            {{ html()->closeModelForm() }}    
        </div><!--card-->
    
</div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" /> -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>
   
  <script>
        $.fn.select2.defaults.set('language', 'es');

        var densidad = <?php echo $existenciaMaterial->material->densidad ?>;
        var perfil = <?php echo $existenciaMaterial->material->perfil ?>;
        var diam_exterior = <?php echo $existenciaMaterial->material->diam_exterior ?>;
        var diam_interior = <?php echo $existenciaMaterial->material->diam_interior ?>;
        var espesor = <?php echo $existenciaMaterial->material->espesor ?>;
        var sistema_medida = <?php echo $existenciaMaterial->material->sistema_medida ?>;

        
        var formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
            });
        



        $('#dimension_largo').on('change', function() {
           

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
            $("#valor_total").val( formatter.format(precio.toFixed(2)));
            $("#valor_total2").val( precio.toFixed(2));

            //alert($("#valor_total2").val());
            
        });

        $('#dimension_ancho').on('change', function() {
            
            var volumen ;
 
            if(perfil == 3){

              volumen = volumen_plancha();
            }

            volumenLt = volumen/1000;

            $('#volumen').val(volumenLt.toFixed(3));

            var masa = parseFloat(densidad) * (volumen);
            var masaKg = masa/1000;
            var precio = masa * ( parseFloat(   $("#valor_unit").val()  )  / 1000);

            $("#masa").val(masaKg.toFixed(3));
            $("#valor_total").val( formatter.format(precio.toFixed(2)));
            $("#valor_total2").val( precio);

            
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
                    if(sistema_medida == '2') //si es en pulgadas
                    { 
                        var radioExt = (parseFloat(   toDeci(diam_exterior.toString())    ) / parseFloat(2)) *25.4;
                        var radioInt = (parseFloat(   toDeci(diam_interior.toString())    ) / parseFloat(2)) *25.4;
                    }else{   // si es en milimetros

                        var radioExt = parseFloat( diam_exterior ) / parseFloat(2);
                        var radioInt = parseFloat( diam_interior ) / parseFloat(2);
                    }
                    var areaExt = Math.PI * Math.pow(radioExt,2);
                    var areaInt = Math.PI * Math.pow(radioInt,2);

                    var areaTotal = (areaExt - areaInt)/1000;
                    var volumen = areaTotal * parseFloat( $('#dimension_largo').val() )
                    return volumen;
            }

            function volumen_barra(){
                    
                    var dext;
                    dext = diam_exterior;
                   

                    if(sistema_medida == '2') //si es en pulgadas
                    {          
                                       
                        var radioExt =  ( parseFloat( toDeci(diam_exterior.toString()) ) / parseFloat(2) ) * 25.4;
                        
                    }else{   // si es en milimetros

                        var radioExt = parseFloat( diam_exterior ) / parseFloat(2);
                        
                    }
                    //alert(dext);
                    
                    var areaExt = Math.PI * Math.pow(radioExt,2);
                   

                    var areaTotal = areaExt/1000 ;
                    var volumen = areaTotal * parseFloat( $('#dimension_largo').val() ) ;
                    return volumen;
                   //return radioExt;
            }

            function volumen_plancha(){
                    
                if(sistema_medida == '2') //si es en pulgadas
                    { 
                         espesor =   toDeci(espesor) * 25.4;

                    }else{   // si es en milimetros

                        //var espesor = espesor ;  
                                           
                    }
                    //alert(espesor);
                    var areaTotal = parseFloat( $('#dimension_largo').val() ) * parseFloat( $('#dimension_ancho').val() );

                    areaTotal = areaTotal / 1000;

                    var volumen = areaTotal * espesor;

                    
                    return volumen;
                
            }



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

            var masa = parseFloat($('#densidad').val()) * volumen;
            var masaKg = masa/1000
            var precio = masa *( parseFloat( $("#valor_unit").val()  )  / 1000);

            $("#masa").val(masaKg.toFixed(3));
            $("#valor_total").val( formatter.format(precio.toFixed(2)));
            $("#valor_total2").val( precio);
        }
        
    </script>


@endsection