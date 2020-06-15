@extends('backend.layouts.app')


@section('title', 'Base de materiales' . ' | ' .'Registrar material')

@section('breadcrumb-links')
   

@section('content')
    {{ html()->form('POST', route('admin.materiales.store'))->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Base de materiales
                            <small class="text-muted">Registrar material</small>
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
                                                
                            {{ html()->select('perfil',array('1' => 'Barra', '2' => 'Barra Perforada', '3' =>'Plancha'), null)
                                    ->class('form-control')
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

                        {{ html()->select('sistema_medida',array('1' => 'Milimetros (Internacional)', '2' => 'Pulgadas (Americano)'))
                                ->class('form-control')
                                ->attribute('maxlength', 191) 
                                ->value('Seleccione')
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
                                    ->value(0)                                   
                                    ->attribute('maxlength', 191)                                          
                                    ->autofocus()                                   
                                     }}
                            </div><!--col-->

                            {{ html()->label('Ø Interior')->class('col-md-1 form-control-label')->for('diam_interior') }}

                            <div class="col-md-1">
                                {{ html()->text('diam_interior')
                                    ->class('form-control')
                                    ->value(0)      
                                    ->attribute('maxlength', 191)                                            
                                    ->autofocus()

                                     }}
                            </div><!--col-->

                            {{ html()->label('Espesor')->class('col-md-1 form-control-label')->for('espesor') }}

                            <div class="col-md-1">
                                {{ html()->text('espesor')
                                    ->class('form-control')
                                    ->attribute('maxlength', 191)
                                    ->value(0)                                             
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
                                    ->value(8)                                   
                                    ->attribute('maxlength', 191)    
                                    ->autofocus()                                   
                                     }}
                            </div><!--col-->

                            {{ html()->label('Valor Kg')->class('col-md-1 form-control-label')->for('valor_kg') }}

                            <div class="col-md-1">
                                {{ html()->number('valor_kg')
                                    ->class('form-control')
                                    ->value('0')      
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

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.materiales.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.save')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}




  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" /> -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>
  
 
 
 
<script type="text/javascript">

function forceKeyPressUppercase(e)
{
  var charInput = e.keyCode;
  if((charInput >= 97) && (charInput <= 122)) { // lowercase
    if(!e.ctrlKey && !e.metaKey && !e.altKey) { // no modifier key
      var newChar = charInput - 32;
      var start = e.target.selectionStart;
      var end = e.target.selectionEnd;
      e.target.value = e.target.value.substring(0, start) + String.fromCharCode(newChar) + e.target.value.substring(end);
      e.target.setSelectionRange(start+1, start+1);
      e.preventDefault();
    }
  }
}

document.getElementById("codigo").addEventListener("keypress", forceKeyPressUppercase, false);
document.getElementById("nombre").addEventListener("keypress", forceKeyPressUppercase, false);

</script>
        
    



@endsection
