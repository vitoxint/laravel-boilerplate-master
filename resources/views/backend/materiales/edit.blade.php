@extends('backend.layouts.app')

@section('title','Base de materiales' . ' | ' . 'Editar datos material')

@section('content')

        <div class="card">
        {{ html()->modelForm($material, 'PATCH', route('admin.materiales.update', $material))->class('form-horizontal')->acceptsFiles()->open() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Base de materiales
                            <small class="text-muted">Editar material / calcular dimensión</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                
                <div class="row mt-4 mb-4">
                        <div class="col">
                        <div class="form-group row">
                        {{ html()->label(__('Código (SAE) *'))->class('col-md-2 form-control-label')->for('codigo') }}

                        <div class="col-md-2">                       
                                {{ html()->text('codigo')
                                    ->class('form-control')
                                    ->placeholder('código SAE o interno')
                                    ->attribute('maxlength', 14)
                                    ->required()                               
                                }}
                    
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('Perfil *'))->class('col-md-2 form-control-label')->for('perfil') }}

                        <div class="col-md-2">
                                                
                            {{ html()->select('perfil',array('1' => 'Barra', '2' => 'Barra Perforada', '3' =>'Plancha'), $material->perfil)
                                    ->class('form-control')
                                    ->value($material->perfil)
                                    ->attribute('maxlength', 191) 
                                    ->required()
                            }}
                                                    
                        </div>

                            {{ html()->label(__('Corte Perfil *'))->class('col-md-1 form-control-label')->for('tipo_corte') }}

                        <div class="col-md-2">
                                                
                            {{ html()->select('tipo_corte',array('1' => 'Completo', '2' => 'Dimensionado'), null)
                                    ->class('form-control')
                                    ->attribute('maxlength', 191) 
                                    ->required()
                            }}

                        </div>
                    </div><!--form-group--> 

                    <div class="form-group row">
                        
                        {{ html()->label('Sistema de medida:')->class('col-md-2 form-control-label')->for('sistema_medida') }}
                        <div class="col-md-2">

                        {{ html()->select('sistema_medida',array('1' => 'Milimetros (Internacional)', '2' => 'Pulgadas (Americano)'), $material->sistema_medida)
                                ->class('form-control')
                                ->attribute('maxlength', 191) 
                                ->value($material->sistema_medida)
                                ->required()
                                
                            }}
                        </div><!--col-->  

                        {{ html()->label('Dimension corte:')->class('col-md-1 form-control-label')->for('dimensionado') }}
                        <div class="col-md-3">

                        {{ html()->text('dimensionado')
                                ->class('form-control')
                                ->attribute('maxlength', 191) 
                                
                                
                            }}
                        </div><!--col-->  

                    </div><!--form-group-->
                    
                    {{ html()->label('')->class('col-md-2 form-control-label')->for('') }}
                    <span > Nota : Para el sistema americano ingresar las medidas de la forma 1-1/2 , si corresponde a 1 1/2"</span>

                    <div class="form-group row" style="padding-top:10px;">
                            {{ html()->label('Medidas :')->class('col-md-2 form-control-label')->for('') }}

                            {{ html()->label('Ø Exterior')->class('col-md-1 form-control-label')->for('diam_exterior') }}

                            <div class="col-md-1">
                                {{ html()->text('diam_exterior')
                                    ->class('form-control')
                                                                     
                                    ->attribute('maxlength', 191)                                          
                                    ->autofocus()                                   
                                     }}
                            </div><!--col-->

                            {{ html()->label('Ø Interior')->class('col-md-1 form-control-label')->for('diam_interior') }}

                            <div class="col-md-1">
                                {{ html()->text('diam_interior')
                                    ->class('form-control')
                                      
                                    ->attribute('maxlength', 191)                                            
                                    ->autofocus()

                                     }}
                            </div><!--col-->

                            {{ html()->label('Espesor')->class('col-md-1 form-control-label')->for('espesor') }}

                            <div class="col-md-1">
                                {{ html()->text('espesor')
                                    ->class('form-control')
                                    ->attribute('maxlength', 191)
                                                                              
                                    ->autofocus()
                                    
                                     }}
                            </div><!--col-->

                    </div><!--form-group-->  

                    
                    <div class="form-group row">

                            {{ html()->label('Valor material')->class('col-md-2 form-control-label')->for('') }}                      

                            {{ html()->label('Densidad g/cm³')->class('col-md-1 form-control-label')->for('densidad') }}

                            <div class="col-md-1">
                                {{ html()->text('densidad')
                                    ->class('form-control')                                                                    
                                    ->attribute('maxlength', 191)    
                                    ->autofocus()                                   
                                     }}
                            </div><!--col-->

                            {{ html()->label('Valor Kg')->class('col-md-1 form-control-label')->for('valor_kg') }}

                            <div class="col-md-1">
                                {{ html()->number('valor_kg')
                                    ->class('form-control')                                       
                                    ->attribute('maxlength', 191)      
                                    ->autofocus()
                                     }}
                            </div><!--col-->
                    </div><!--form-group-->  

                      <div class="form-group row">
                        {{ html()->label(__('Proveedor principal'))->class('col-md-2 form-control-label')->for('proveedor') }}

                        <div class="col-md-4">                       
                                {{ html()->text('proveedor')
                                    ->class('form-control')
                                    ->placeholder('Proveedor del material por costo')
                                    ->attribute('maxlength', 191)
                                                                
                                }}
                    
                        </div><!--col-->
                    </div><!--form-group-->                                 

                        </div><!--col-->
                    </div><!--row-->
                </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.materiales.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
                    </div><!--row-->
                </div><!--row-->
            </div><!--card-footer-->

            {{ html()->closeModelForm() }}    
        </div><!--card-->    


<!-- CALCULAR DIMENSIONADO -->

<div class="card">
        
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Calcular dimensionado de material
                            <!--<small class="text-muted">Editar material / calcular dimensión</small>-->
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                        <div class="col">

                        <div class="form-group row" style="padding-top:10px;">
                                {{ html()->label('Ingresar dimensiones :')->class('col-md-2 form-control-label')->for('') }}

                                {{ html()->label('Largo (mm):')->class('col-md-1 form-control-label')->for('largo') }}
                                <?php $dim = explode('x',$material->dimensionado );  if(sizeof($dim) == 1){$dim[1] = '0';}?>

                                <div class="col-md-1">                                    
                                    <input id="largo" name="largo" class="form-control" value="{{$dim[0]}}"/>
                                </div><!--col-->

                                {{ html()->label('Ancho (mm):')->class('col-md-1 form-control-label')->for('ancho') }}

                                <div class="col-md-1">
                                    <input id="ancho" name="ancho" class="form-control" value="{{$dim[1]}}"/>
                                </div><!--col-->

                                <div class="col col-md-1"><button class="btn btn-success btn-sm" onclick="calcular()"><i class="fas fa-calculator"></i> Calcular </button></div>

                        </div><!--form-group-->    

                        <div class="form-group row" style="padding-top:10px;">
                                {{ html()->label('Resultados :')->class('col-md-2 form-control-label')->for('') }}

                                {{ html()->label('Volumen (Lts):')->class('col-md-1 form-control-label')->for('volumen') }}

                                <div class="col-md-1">
                                    {{ html()->text('volumen')
                                        ->class('form-control')
                                        ->disabled()                          
                                        ->attribute('maxlength', 191)                                          
                                        ->autofocus()                                   
                                        }}
                                </div><!--col-->

                                {{ html()->label('Masa (Kg):')->class('col-md-1 form-control-label')->for('masa') }}

                                <div class="col-md-1">
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
                </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        
                    </div><!--col-->

                    <div class="col text-right">
                        
                    </div><!--row-->
                </div><!--row-->
            </div><!--card-footer-->

             
        </div><!--card-->    
  
</div>



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
        
        function calcular(){
            var volumen ;
 
            if($('#perfil').val() == '1'){
                volumen = volumen_barra();
            }

            if($('#perfil').val() == '2'){
                volumen = volumen_bocina();
            }

            if($('#perfil').val() == '3'){
                volumen = volumen_plancha();
            }

            volumenLt = volumen/1000;

            $('#volumen').val(volumenLt.toFixed(3));

            var masa = parseFloat($('#densidad').val()) * volumen;
            var masaKg = masa/1000
            var precio = masa *( parseFloat( $("#valor_kg").val()  )  / 1000);

            $("#masa").val(masaKg.toFixed(3));
            $("#valor").val( formatter.format(precio.toFixed(2)));
        }


        $('#largo').on('change', function() {

            var volumen ;
 
            if($('#perfil').val() == '1'){
                volumen = volumen_barra();
            }

            if($('#perfil').val() == '2'){
                volumen = volumen_bocina();
            }

            if($('#perfil').val() == '3'){
                volumen = volumen_plancha();
            }

            volumenLt = volumen/1000;

            $('#volumen').val(volumenLt.toFixed(3));

            var masa = parseFloat($('#densidad').val()) * volumen;
            var masaKg = masa/1000
            var precio = masa *( parseFloat( $("#valor_kg").val()  )  / 1000);

            $("#masa").val(masaKg.toFixed(3));
            $("#valor").val( formatter.format(precio.toFixed(2)));
            
        });

        $('#ancho').on('change', function() {
            
            var volumen ;
 
            if($('#perfil').val() == '3'){
                volumen = volumen_plancha();
            }

            volumenLt = volumen/1000;

            $('#volumen').val(volumenLt.toFixed(3));

            var masa = parseFloat($('#densidad').val()) * (volumen);
            var masaKg = masa/1000;
            var precio = masa * ( parseFloat(   $("#valor_kg").val()  )  / 1000);

            $("#masa").val(masaKg.toFixed(3));
            $("#valor").val( formatter.format(precio.toFixed(2)));

            
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
                    if($('#sistema_medida').val() == '2') //si es en pulgadas
                    { 
                        var radioExt = (parseFloat(   toDeci($('#diam_exterior').val())    ) / parseFloat(2)) *25.4;
                        var radioInt = (parseFloat(   toDeci($('#diam_interior').val())    ) / parseFloat(2)) *25.4;
                    }else{   // si es en milimetros

                        var radioExt = parseFloat( $('#diam_exterior').val() ) / parseFloat(2);
                        var radioInt = parseFloat( $('#diam_interior').val() ) / parseFloat(2);
                    }
                    var areaExt = Math.PI * Math.pow(radioExt,2);
                    var areaInt = Math.PI * Math.pow(radioInt,2);

                    var areaTotal = (areaExt - areaInt)/1000;
                    var volumen = areaTotal * parseFloat( $('#largo').val() )
                    return volumen;
            }

            function volumen_barra(){

                if($('#sistema_medida').val() == '2') //si es en pulgadas
                    { 
                        var radioExt =  ( parseFloat(   toDeci($('#diam_exterior').val())    ) / parseFloat(2) ) * 25.4;
                        //var radioInt = parseFloat(   toDeci($('#diam_interior').val())    ) / parseFloat(2);
                    }else{   // si es en milimetros

                        var radioExt = parseFloat( $('#diam_exterior').val() ) / parseFloat(2);
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

                if($('#sistema_medida').val() == '2') //si es en pulgadas
                    { 
                        var espesor =   parseFloat( toDeci($('#espesor').val()) ) * 25.4;

                    }else{   // si es en milimetros

                        var espesor = parseFloat( $('#espesor').val() );                      
                    }
                    var areaTotal = parseFloat( $('#largo').val() ) * parseFloat( $('#ancho').val() );

                    areaTotal = areaTotal / 1000;

                    var volumen = areaTotal * parseFloat( $('#espesor').val() )
                    return volumen;
                
            }
        
    </script>



@endsection