@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Clasificación de procesos')


@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Clasificación de procesos <small class="text-muted">Todos los procesos</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.procesos.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
            <div class="table-responsive" id="no-more-tables">
                    <table class="table col-sm-12 table-bordered table-striped table-condensed cf">
                        <thead class="cf">
                        <tr>
                             <th style="width:35px;">Código</th>
                             <th>Descripción</th>
                             <th style="width:45px;">@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($procesos as $proceso)
                            <tr>
                                <td>{{ $proceso->codigo }}</td>
                                <td>{{ $proceso->descripcion }}</td>                                                               
                                <td class="btn-td">@include('backend.procesos.includes.actions', ['proceso' => $proceso])</td>
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
                    {!! $procesos->count() !!} 
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $procesos->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
