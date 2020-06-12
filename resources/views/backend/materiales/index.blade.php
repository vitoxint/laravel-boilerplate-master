@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Registro de materiales')

@section('breadcrumb-links')
    @include('backend.materiales.includes.breadcrumb-links')
@endsection


@section('content')
<div class="card">
    <div class="card-body">
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
                             <th>Ø Exterior.</th>
                             <th>Ø Interior.</th>
                             <th>Espesor.</th>
                             <th>Densidad g/cm³</th>
                             <th>Valor Kg</th>

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
                                <td data-title="Código">   {{$material->codigo }}      </td>
                                <td data-title="Ø Exterior" align="center"> {{$material->diam_exterior}} 
                                    @switch($material->sistema_medida)
                                            @case(1)
                                                 mm 
                                            @break
                                            @case(2)
                                                 " 
                                            @break
                                           

                                        @endswitch 
                                </td>
                                <td data-title="Ø Interior" align="center"> {{$material->diam_interior}} </td>
                                <td data-title="Espesor" align="center">  {{$material->espesor}}   </td>
                                <td data-title="Densidad g/cm³" align="center"> {{$material->densidad}}  g/cm³</td>
                                <td data-title="Valor Kg" style="text-align:right;">@money($material->valor_kg) </td>
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
@endsection
