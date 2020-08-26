@extends('backend.layouts.app')

@section('title','Ordenes de Trabajo' . ' | ' . 'OT: '. $trabajo->folio)

@section('content')


        <div class="card">
        {{ html()->modelForm($trabajo, 'POST', route('admin.orden_trabajos.printTallerOpExportar', $trabajo))->class('form-horizontal')->acceptsFiles()->open() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            
                            <small class="text-muted">Opciones de impresión OT: {{$trabajo->folio}} (control interno)</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>


                <div class="row mt-4 mb-4">
                        <div class="col container-fluid">

                        @foreach($trabajo->items_ot as $item)

                      
                        <label for="item" class="col-md-12 form-control-label" style="color:white; background:blue; padding-top:10px;  padding-bottom:10px; border-radius:5px;"> Item : {{$item->folio}} - {{$item->descripcion}}</label>
                            <div class="row">

                                <div class="col-md-12">

                                </div><!--col-->
                            </div><!--form-group-->


                           <!--  @if($item->imagenes->count() > 0)  --> 
                            <label class="col-md-12 form-control-label" style="margin-top:10px; margin-bottom:10px;"> Seleccionar imágenes a imprimir </label>

                            <div class="row ml-2">

                           
                                @foreach($item->imagenes as $imagen)
                                   <!--  @if($imagen->extension == 'image') -->
                                    <div class="col-md-2 text-xs-center" >
                                        <div class="border border-secondary">
                                            <label class="image-checkbox" title="{{$imagen->image_name}}">
                                                <img src="{{asset('storage/'. $imagen->url)}}" class="center" style=" align-content:center; max-width: 185px; max-height:170px;" />
                                                <input type="checkbox" name="img[]" value="{{$imagen->id}}"  />
                                            </label>
                                        </div>
                                    </div>
                                   <!--  @endif -->

                                @endforeach
                           <!--  @else
                            <p> No existen imágenes para este ítem</p>

                            @endif -->
<!--                                 <div class="col-md-3 text-xs-center">
                                    <label class="image-checkbox" title="Germany">
                                        <img src="http://www.prepbootstrap.com/Content/images/template/gamesschedule/germany.jpg" />
                                        <input type="checkbox" name="team[]" value="germany" />
                                    </label>
                                </div>
                                <div class="col-md-3 text-xs-center">
                                    <label class="image-checkbox" title="Italy">
                                        <img src="http://www.prepbootstrap.com/Content/images/template/gamesschedule/italy.jpg" />
                                        <input type="checkbox" name="team[]" value="italy" />
                                    </label>
                                </div>
                                <div class="col-md-3 text-xs-center">
                                    <label class="image-checkbox" title="Spain">
                                        <img src="http://www.prepbootstrap.com/Content/images/template/gamesschedule/spain.jpg" />
                                        <input type="checkbox" name="team[]" value="spain" />
                                    </label>
                                </div> -->

                            </div><!--form-group-->   
                        @endforeach

                    </div><!--col-->
                </div><!--row-->




                </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">
<!-- 
                    <a href="{{ route('admin.orden_trabajos.printCliente', $trabajo) }}" target="_blank" class="btn btn-default btn-sm btn-bordered" data-toggle="tooltip" data-placement="top" title="Imprimir PDF">
                        <i class="fas fa-file-pdf" style="color:red;"></i> Exportar Cliente
                    </a>

                    <a href="{{ route('admin.orden_trabajos.printTallerOpExportar', $trabajo) }}" target="_blank" class="btn btn-default btn-sm btn-bordered" data-toggle="tooltip" data-placement="top" title="Imprimir PDF">
                        <i class="fas fa-file-pdf" style="color:red;"></i> Exportar Taller
                    </a>

                    <a href="{{ route('admin.orden_trabajos.send', $trabajo) }}" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Enviar OT" 
                        name="confirm_item"
                        data-trans-button-cancel="@lang('buttons.general.cancel')"
                        data-trans-button-confirm="@lang('buttons.general.continue')"
                        data-trans-title="@lang('strings.backend.general.are_you_sure')">
                        <i class="fas fa-envelope" style="color:green;"></i> Enviar 
                    </a>  -->

                        
                    </div><!--col-->

                    <div class="col text-right">
                        
                        <button type="submit" class="btn btn-default btn-sm btn-bordered" data-toggle="tooltip" data-placement="top" title="Exportar PDF">
                        <i class="fas fa-file-pdf" style="color:red;"></i> Exportar Taller
                    </button>                    
                       
                    
                    @can('administrar ordenes de trabajo')   @can('ver trabajos')  

                        {{ form_cancel(route('admin.orden_trabajos.edit' , $trabajo), __('buttons.general.cancel')) }}

                    @endcan @endcan
                                       
                    </div><!--row-->
                </div><!--row-->
            </div><!--card-footer-->

            {{ html()->closeModelForm() }}    
        </div><!--card-->

        </div>
</div>
        


</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>


<script type="text/javascript">
    jQuery(function ($) {
        // init the state from the input
        $(".image-checkbox").each(function () {
            if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
                $(this).addClass('image-checkbox-checked');
            }
            else {
                $(this).removeClass('image-checkbox-checked');
            }
        });

        // sync the state to the input
        $(".image-checkbox").on("click", function (e) {
            if ($(this).hasClass('image-checkbox-checked')) {
                $(this).removeClass('image-checkbox-checked');
                $(this).find('input[type="checkbox"]').first().removeAttr("checked");
            }
            else {
                $(this).addClass('image-checkbox-checked');
                $(this).find('input[type="checkbox"]').first().attr("checked", "checked");
            }

            e.preventDefault();
        });
    });
</script>

<style>
    .image-checkbox
    {
        cursor: pointer;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        border: 4px solid transparent;
       
        outline: 0;
    }

        .image-checkbox input[type="checkbox"]
        {
            display: none;
        }

    .image-checkbox-checked
    {
        border-color: #008723;
    }
</style>





@endsection