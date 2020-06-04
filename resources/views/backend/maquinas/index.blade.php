@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Registro de máquinas')


@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Registro de máquinas <small class="text-muted">Todas las máquinas</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.maquinas.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
            <div class="table-responsive" id="no-more-tables">
                    <table class="table col-sm-12 table-bordered table-striped table-condensed cf">
                        <thead class="cf">
                        <tr>
                             <th style="width:35px;">Código</th>
                             <th>Nombre máquina</th>
                             <th>Estado</th>

                             <th style="width:45px;">@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($maquinas as $maquina)
                            <tr>
                                <td>{{ $maquina->codigo }}</td>
                                <td>{{ $maquina->nombre }}</td>
                                <td style="text-align:center; width:29px;">
                                    @switch($maquina->estado) 
                                            @case ('1') 
                                               <span class="badge btn-success"> Disponible </span>
                                            @break;
                                            @case ('2') 
                                                <span class="badge btn-danger"> Inhabilitada </span>
                                            @break;
                                            @case ('3')
                                                <span class="badge btn-primary"> En uso </span>
                                            @break;
                                            @case ('4') 
                                                <span class="badge btn-warning"> En mantención </span>
                                            @break;
                                            @default
                                                {{$maquina->estado}}
                                            @break;                   
                                    @endSwitch </td>

                                <td class="btn-td">@include('backend.maquinas.includes.actions', ['maquina' => $maquina])</td>
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
                    {!! $maquinas->count() !!} 
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $maquinas->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
