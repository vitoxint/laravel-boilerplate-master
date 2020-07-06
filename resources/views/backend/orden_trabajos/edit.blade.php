@extends('backend.layouts.app')

@section('title','Ordenes de Trabajo' . ' | ' . 'Editar OT: '. $trabajo->folio)

@section('content')


        <div class="card">
        {{ html()->modelForm($trabajo, 'PATCH', route('admin.orden_trabajos.update', $trabajo))->class('form-horizontal')->acceptsFiles()->open() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Ordenes de Trabajo
                            <small class="text-muted">Editar OT: {{$trabajo->folio}}</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                        <div class="col">

                    <div class="form-group row">
                        {{ html()->label(__('Cliente '))->class('col-md-2 form-control-label')->for('cliente_id') }}

                        <div class="col-md-6">                       
                            
                            {{ html()->text('cliente_id')
                                    ->class('form-control')
                                    ->value($trabajo->cliente->razon_social)
                                    ->attribute('maxlength', 191)
                                    ->disabled()                                   
                                     }}
                    
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('Contacto cliente'))->class('col-md-2 form-control-label')->for('representante_id') }}

                        <div class="col-md-6">
                            @if($trabajo->representante)
                                                
                            {{ html()->text('representante_id')
                                        ->class('form-control')
                                        ->value($trabajo->representante->nombre)
                                        ->attribute('maxlength', 191)
                                        ->disabled()                                   
                                        }}
                                        
                            @else
              
                            {{ html()->text('representante_id')
                                        ->class('form-control')
                                        ->value('')
                                        ->attribute('maxlength', 191)
                                        ->disabled()                                   
                                        }}              
                            
                            @endif
                                                    
                        </div>
                    </div><!--form-group--> 

                        <div class="form-group row">
                        {{ html()->label('Cotización')->class('col-md-2 form-control-label')->for('cotizacion') }}

                            <div class="col-md-3">
                                {{ html()->text('cotizacion')
                                    ->class('form-control')
                                    ->placeholder('Cotización referencia (opcional)')
                                    ->attribute('maxlength', 191)                                   
                                     }}
                            </div><!--col-->

                            
                        </div><!--form-group-->


                        <div class="form-group row">
                            {{ html()->label('Orden compra')->class('col-md-2 form-control-label')->for('orden_compra') }}

                            <div class="col-md-3">
                                {{ html()->text('orden_compra')
                                    ->class('form-control')
                                    ->placeholder('orden compra referencia (opcional)')
                                    ->attribute('maxlength', 191)      
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->                        
  

                        <div class="form-group row">
                            {{ html()->label('Estado')->class('col-md-2 form-control-label')->for('estado') }}



                            <div class="col-md-2">

                                {{ html()->select('estado',array('1' => 'Sin iniciar', '2' => 'En proceso', '3' =>'Atrasada', '4' => 'Terminada', '5' => 'Entregada',  '6' => 'Anulada'), $trabajo->estado)
                                    ->class('form-control')
                                    ->attribute('maxlength', 191) 
                                    ->required()
                                    
                                }}
                                <div id="statusOt">

                                @switch($trabajo->estado) 
                                        @case ('1') 
                                            <span class="badge btn-secondary" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> Sin Iniciar </p>  </span>
                                        @break;
                                        @case ('2') 
                                            <span class="badge btn-primary" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> En Proceso </p>  </span>
                                        @break;
                                        @case ('3')
                                            <span class="badge btn-danger" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> Atrasada </p>  </span>
                                        @break;
                                        @case ('4') 
                                            <span class="badge btn-success" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> Terminada </p> </span>
                                        @break;
                                        @case ('5') 
                                            <span class="badge btn-dark" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> Entregada </p>  </span>
                                        @break;
                                        @case ('6') 
                                            <span class="badge btn-warning" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> Anulada </p> </span>
                                        @break;

                                        @default
                                            {{$item_ot->trabajo->estado}}
                                        @break;                   
                                @endSwitch  
                                </div>


                            </div><!--col-->

                            {{ html()->label('Usuario digitador :')->class('col-md-2 form-control-label')->for('user_id') }}

                            <div class="col-md-3">
                            
                                {{ html()->text('user_id')
                                    ->class('form-control')
                                    ->value($trabajo->usuario->first_name .' '.$trabajo->usuario->last_name )
                                    ->disabled()
                                    ->attribute('maxlength', 191)      
                                    ->autofocus() }}
                            </div><!--col-->
                            
                        </div><!--form-group-->  

                        <div class="form-group row">
                            {{ html()->label('Fecha compromiso entrega :')->class('col-md-2 form-control-label')->for('entrega_estimada') }}

                            <div class="col-md-2">
                                {{ html()->date('entrega_estimada')
                                    ->class('form-control')
                                    ->value($trabajo->entrega_estimada)
                                    ->attribute('maxlength', 191)      
                                    ->autofocus()
                                    
                                    ->required() }}
                            </div><!--col-->

                            {{ html()->label('Fecha inicio :')->class('col-md-1 form-control-label')->for('fecha_inicio') }}

                            <div class="col-md-2">
                                {{ html()->date('fecha_inicio')
                                    ->class('form-control')
                                    ->attribute('maxlength', 191)      
                                    ->autofocus()
                                    
                                     }}
                            </div><!--col-->

                            {{ html()->label('Fecha de termino :')->class('col-md-1 form-control-label')->for('fecha_termino') }}

                            <div class="col-md-2">
                                {{ html()->date('fecha_termino')
                                    ->class('form-control')
                                    ->attribute('maxlength', 191)      
                                    ->autofocus()
                                    
                                     }}
                            </div><!--col-->

                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Valor Neto :')->class('col-md-2 form-control-label')->for('valor_total') }}

                            <div class="col-md-2">
                                {{ html()->text('valor_total')
                                    ->class('form-control')
                                    ->value('$  '. number_format($trabajo->valor_total,0, ',' , '.'  ))                                   
                                    ->attribute('maxlength', 191)
                                    ->disabled()      
                                    ->autofocus()
                                    
                                    ->required() }}
                            </div><!--col-->

                            {{ html()->label('IVA (19%) :')->class('col-md-1 form-control-label')->for('iva') }}

                            <div class="col-md-2">
                                {{ html()->text('iva')
                                    ->class('form-control')
                                    ->value('$  '.number_format(($trabajo->valor_total * 0.19),0, ',' , '.'  ))      
                                    ->attribute('maxlength', 191)  
                                    ->disabled()      
                                    ->autofocus()
                                    
                                     }}
                            </div><!--col-->

                            {{ html()->label('valor Total :')->class('col-md-1 form-control-label')->for('valor_incluido') }}

                            <div class="col-md-2">
                                {{ html()->text('valor_incluido')
                                    ->class('form-control')
                                    ->attribute('maxlength', 191)
                                    ->value('$  '.number_format(($trabajo->valor_total * 1.19),0, ',' , '.'  ))   
                                    ->disabled()        
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

                    <a href="{{ route('admin.orden_trabajos.printCliente', $trabajo) }}" target="_blank" class="btn btn-default btn-sm btn-bordered" data-toggle="tooltip" data-placement="top" title="Imprimir PDF">
                        <i class="fas fa-file-pdf" style="color:red;"></i> Exportar Cliente
                    </a>

                    <a href="{{ route('admin.orden_trabajos.printTaller', $trabajo) }}" target="_blank" class="btn btn-default btn-sm btn-bordered" data-toggle="tooltip" data-placement="top" title="Imprimir PDF">
                        <i class="fas fa-file-pdf" style="color:red;"></i> Exportar Taller
                    </a>

                    <a href="{{ route('admin.orden_trabajos.send', $trabajo) }}" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Enviar OT">
                        <i class="fas fa-envelope" style="color:green;"></i> Enviar 
                    </a> 

                        
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
                        {{ form_cancel(route('admin.orden_trabajos.index'), __('buttons.general.cancel')) }}
                        
                    </div><!--row-->
                </div><!--row-->
            </div><!--card-footer-->

            {{ html()->closeModelForm() }}    
        </div><!--card-->
    


        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Ítems OT <small class="text-muted">Todos los ítems</small>
                        </h4>
                    </div><!--col-->

                    <div class="col-sm-7">
                        @include('backend.item_ots.includes.header-buttons')
                    </div><!--col-->
                </div><!--row-->

                <div class="row mt-4">
                    <div class="col">
                    <div class="table-responsive" id="no-more-tables">
                    <table class="table col-sm-12 table-bordered table-striped table-condensed cf">
                        <thead class="cf">
                                <tr>
                                    <th>Folio</th>
                                    <th>Cantidad</th>
                                    <th>Descripcion</th>                                   
                                    <th>Val. Unitario</th>
                                    <th>Val. Parcial</th>
                                    <th>Avance</th>
                                    <th>Estado</th>       
                                    <th>@lang('labels.general.actions')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($trabajo->items_ot as $item_ot)
                                    <tr>
                                        <td data-title="Folio:">{{ $item_ot->folio }}</td>
                                        <td data-title="Cantidad:">{{ $item_ot->cantidad }}</td>
                                        <td data-title="Descripción:">{{ $item_ot->descripcion }}</td>
                                        <td align="right" data-title="Valor Unitario:">@money($item_ot->valor_unitario )</td>
                                        <td align="right" data-title="Valor Parcial:"> @money($item_ot->valor_parcial ) </td>
                                        
                                        <td align="center">{{$item_ot->avanceItemOt()}}</td>
                                        <td style="text-align:center;" data-title="Estado ítem OT:" id="itemOt{{$item_ot->id}}">
                                            @switch($item_ot->estado)
                                                @case(1)
                                                    <span class="badge btn-secondary" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Sin Iniciar </p></span>
                                                    @break
                                                    
                                                @case(2)
                                                    <span class="badge btn-primary" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> En Proceso </p></span>
                                                    @break
                                                @case(3)
                                                    <span class="badge btn-danger" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Atrasada </p></span>
                                                    @break
                                                @case(4)
                                                    <span class="badge btn-success" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Terminada </p></span>
                                                    @break  
                                                @case(5)
                                                    <span class="badge btn-dark" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Entregada </p></span>
                                                    @break                                  
                                            
                                                @case(6)
                                                    <span class="badge btn-warning" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Anulada </p></span>
                                                    @break   
                                                @default
                                                <span>Something went wrong, please try again</span>
                                            
                                                    
                                            @endswitch
                                        
                                        </td>                               
                                      
                                        <td class="btn-td" data-title="Acciones:">@include('backend.item_ots.includes.actions', ['item_ot' => $item_ot , 'trabajo' => $trabajo])</td>
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
                            {!! $trabajo->items_ot->count() !!} 
                        </div>
                    </div><!--col-->

                    <div class="col-5">
                        <div class="float-right">
                           
                        </div>
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->
        </div><!--card-->


        <div class="card">
            
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Entregas del trabajo
                           <!--  <small class="text-muted">disponibles</small> -->
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                
                <div class="row mt-4 mb-4">
                    <div class="col">

                    <div class="form-group row">

                        
                            {{ html()->label('Agregar entrega:')->class('col-md-6 form-control-label')->for('') }}  
                        

                    </div>

                    <div class="form-group row" >

                        {{ html()->label('Receptor :')->class('col-md-1 form-control-label')->for('receptor') }}

                        <div class="col-md-3">
                            {{ html()->text('receptor')
                                ->class('form-control')
                                                            
                                ->attribute('maxlength', 191)                                          
                                ->autofocus()
                                ->required()                                   
                                }}
                        </div><!--col-->

                        {{ html()->label('RUT Receptor:')->class('col-md-1 form-control-label')->for('rut_receptor') }}

                        <div class="col-md-2">
                            {{ html()->text('rut_receptor')
                                ->class('form-control')                                
                                ->attribute('maxlength', 12)                                            
                                ->autofocus()

                                }}
                        </div><!--col-->

                        {{ html()->label('Fecha:')->class('col-md-1 form-control-label')->for('hora') }}

                        <div class="col-md-3">
                            <div class='input-group date' id='hora' name="hora">
                            <?php $fecha = Carbon\Carbon::now(); $fecha = $fecha->format('d-m-Y H:i'); ?>
                                <input type='text' class="form-control" required="true" value="{{$fecha}}"/>
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar btn btn-md"></span>
                                </span>
                            </div>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">

                         {{ html()->label('Agregar ítems')->class('col-md-1 form-control-label')->for('items') }}
                        <div class="col-md-7">
                            <select name="items[]" id="items" class="form-control" multiple="multiple" >
                            </select>
                        </div><!--col-->

                   
                        <div class="col col-md-2">
                            <button class="btn btn-dark btn-xs" onclick="añadir_entrega()"><i class="fas fa-check"></i> Registrar </button>
                        </div>

                    </div><!--form-group--> 

                    <div class="form-group row" style="">

                        <div class="col-md-12">
                            <div id="materiales" class="table-responsive">
                                <table class='table table-bordered table-hover' id="tab_logic">
                                    <thead>
                                        <tr class='info'>
                                            <th style='width:7%;'hidden="true">ID entrega.</th>
                                            <th style='width:16%;'>Fecha</th>        
                                            <th style='width:24%;'>Receptor</th>
                                            <th style='width:17%;'>Encargado </th>
                                            <th style='width:40%;'>Ítems</th>
                                           
                                            <th style='width:13%;'>Acción</th>
                                        </tr>
                                    </thead>
                                    <thead id="dynamic_field">

                                    @foreach($trabajo->entregasOt as $entrega)
                                    <tr id="row{{$entrega->id}}">
                                            <td class="custom-tbl" hidden="true"><input class='form-control input-sm'style='width:100%;' type="text"  value="{{$entrega->id}}" id="pr_item{{$entrega->id}}" name="pr_item[]" readonly required></td>
                                            <td> <p id="hora_entrega{{$entrega->id}}" name="entrega_id[]"> {{$entrega->hora_entrega}} </p></td>  
                                            <td><p  id="receptor{{$entrega->id}}"  name="receptor[]">[{{$entrega->rut_receptor}}]-{{$entrega->receptor}}</p></td>
                                            <td><p  id="encargado{{$entrega->id}}"  name="encargado[]">{{$entrega->encargado->first_name}} {{$entrega->encargado->last_name}}</p></td>

                                            <td id="items{{$entrega->id}}"  name="items[]"> 
                                              @foreach($entrega->entregasItemOt as $itemEntrega)
                                                <span><p>[{{$itemEntrega->item_ot->folio}}]-{{$itemEntrega->item_ot->descripcion}}</p><span>
                                              @endforeach                                            
                                            </td>
                                         
                                            <td class="custom-tbl"><!-- <button type="button" id="{{$entrega->id}}" class="btn-info btn-sm btn_add" name="add"><span class="fas fa-sync-alt"></span></button> -->
                                                           
                                                <button type="button" name="remove" id="{{$entrega->id}}" class="btn-danger btn-sm btn_remove"><span class="fas fa-times"></span></button>
                                                           
                                            </td>
                                        </tr>
                                    @endforeach
                                                                   
                                    </thead>
                                </table>
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

  <script src="{{asset('datepicker/js/bootstrap-datetimepicker.js')}}"></script>
  <script src="{{asset('datepicker/js/moments.js')}}"></script>

  
  <script src="{{asset('js/jquery.rut.js')}}" ></script>

    <script>

        $("#rut_receptor")
        .rut({formatOn: 'keyup', validateOn: 'keyup'})
        .on('rutInvalido', function(){ 
            $(this).parents(".control-group").addClass("error")
        })
        .on('rutValido', function(){ 
            $(this).parents(".control-group").removeClass("error")
        });

    </script>


    <script>

        $(document).ready(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
            $('#hora').datetimepicker({
                // Formats
                // follow MomentJS docs: https://momentjs.com/docs/#/displaying/format/
                format: 'DD-MM-YYYY HH:mm',
                locale: 'es',
                
                // Your Icons
                // as Bootstrap 4 is not using Glyphicons anymore
                icons: {
                    time: 'fa fa-clock-o',
                    date: 'fa fa-calendar',
                    up: 'fa fa-chevron-up',
                    down: 'fa fa-chevron-down',
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-check',
                    clear: 'fa fa-trash',
                    close: 'fa fa-times'
                }
            });
        }); 

    </script>


    <script>
        $.fn.select2.defaults.set('language', 'es');
        
        $('#items').select2({
            placeholder: "Seleccionar ítem a entregar...",
            minimumInputLength: 1,
            ajax: {
                url: "{{route('admin.item_ots.dataAjax')}}?id="+ <?php echo $trabajo->id ?>,
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
        });



        function añadir_entrega(){
  
            var ot_id =  <?php echo $trabajo->id; ?>;
            var receptor = $('#receptor').val();
            var rut_receptor = $("#rut_receptor").val();
            var hora = $("#hora").find("input").val();
            var items = $("#items").val();

            //if((itemslength != 0)&&(receptor != "")&&(hora != "")){

                $.ajax({
                type:'POST',
                url:'{{route("admin.entrega_ot.store")}}',
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                data:{ ot_id:ot_id, receptor:receptor, rut_receptor:rut_receptor ,hora:hora , items:items },
                success:function(data){
                    //alert(data.success);
                    $('#dynamic_field').append(
                        '<tr id="row'+data.id+'">'+
                                           ' <td class="custom-tbl" hidden="true"><input class="form-control input-sm" style="width:100%;" type="text"  value="'+data.id+'" id="pr_item'+data.id+'" name="pr_item[]" readonly required></td>'+
                                            ' <td> <p id="hora_entrega'+data.id+'" name="entrega_id[]">'+ data.hora_entrega+' </p></td>'  +
                                            ' <td> <p  id="receptor'+data.id+'"  name="receptor[]"> ['+ data.rut_receptor+']-'+data.receptor + '</p></td>'+
                                            ' <td> <p  id="encargado'+data.id+'"  name="encargado[]">'+data.encargado+'</p></td>'+

                                            ' <td id="items'+data.id+'"  name="items[]"> '+data.items+'</td>'+
  
                                            ' <td class="custom-tbl"><!-- <button type="button" id="" class="btn-info btn-sm btn_add" name="add"><span class="fas fa-sync-alt"></span></button> -->'+
                                                           
                                            '     <button type="button" name="remove" id="'+data.id+'" class="btn-danger btn-sm btn_remove"><span class="fas fa-times"></span></button>  </td></tr>'
                      ); 

                      for (var i=0; i< data.items_id.length; i++)
                            {
                                var id= data.items_id[i];
                                //Para obtener el objeto de tu lista
                                $("#itemOt"+id).html('<span class="badge btn-dark" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Entregado </p>  </span>');
                                
                            }    

                      if(data.estado_ot == '5'){
                              $("#statusOt").html('<span class="badge btn-dark" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> Entregada </p>  </span>');
                              $("#estado").val('5');
                      }    
                      $("#items").empty();   
                
                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }

                });
            /* }else{
                alert('Faltan datos a ingresar');
            } */


        }




        $(document).on('click', '.btn_remove', function(){  
            var button_id = $(this).attr("id");

            $.ajax({
            type:'POST',
            url:'{{route("admin.entrega_ot.destroy")}}',
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            data:{item:button_id},
            success:function(data){
                
                $('#row'+button_id+'').remove(); 

                for (var i=0; i< data.array.length; i++)
                {
                    var id= data.array[i];
                    //Para obtener el objeto de tu lista
                    $("#itemOt"+id).html('<span class="badge btn-success" style="border-radius:10px;"><p style="color:white; margin:3px; font-size:12px;"> Terminado </p>  </span>');
                    
                }

                $("#statusOt").html('<span class="badge btn-success" style="border-radius:12px;"><p style="margin:4px; font-size:16px;"> Terminada </p>  </span>');
                    $("#estado").val('4');  

                    //console.log(data.success);
                     
            },
            error: function() {
                console.log("No se ha podido obtener la información");
            }

            });                      
            
        });  

    </script>




@endsection