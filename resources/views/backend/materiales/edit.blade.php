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
                                {{ html()->text('espesoro')
                                    ->class('form-control')
                                    ->attribute('maxlength', 191)
                                                                              
                                    ->autofocus()
                                    
                                     }}
                            </div><!--col-->

                    </div><!--form-group-->  

                    
                    <div class="form-group row">

                            {{ html()->label('Valor material')->class('col-md-2 form-control-label')->for('') }}                      

                            {{ html()->label('Densidad Kg/cm2')->class('col-md-1 form-control-label')->for('densidad') }}

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

                        </div><!--col-->
                    </div><!--row-->
                </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.maquinas.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
                    </div><!--row-->
                </div><!--row-->
            </div><!--card-footer-->

            {{ html()->closeModelForm() }}    
        </div><!--card-->    
  
</div>



  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" /> -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>
   
  <script>
        $.fn.select2.defaults.set('language', 'es');
        
 /*        $('#operadores').select2({
            placeholder: "Seleccionar...",
            minimumInputLength: 3,
            ajax: {
                url: "{{route('admin.empleados.dataAjax')}}",
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
                },
                cache: true
            },           
        }); *//* .on("select2:unselecting", function(e){
            var op = $('#operadores option:selected').val();
alert(op);
            $.ajax({
                type:'POST',
                url:'{{route("admin.maquinahasoperador.destroy")}}?id='",
                data:{op:op},
                success:function(data){
                    alert('Operador eliminado de la máquina');                
                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }

                })     
        }).trigger('change') */      

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
        
    </script>



@endsection