@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>@lang('strings.backend.dashboard.welcome') {{ $logged_in_user->name }}!</strong>
                </div><!--card-header-->
                <div class="card-body" >
                   <!--  {!! __('strings.backend.welcome') !!} -->
 
                    <div id="app">
                        <div class="row mb-4">

                            <div class="col">
                                <graficastatusots-component></graficastatusots-component> 
                               
                            </div>

                        
                        </div> 

                        <div class="row mb-4">

                            <div class="col">                               
                                <grafica-component></grafica-component>
                            </div> 

                            <div class="col">
                                <graficaingresos-component></graficaingresos-component> 
                               
                            </div>
                        </div> 

                        <div class="row mb-4">

                            <div class="col">                               
                               <!--  <ganttots-component></ganttots-component> -->
                            </div> 

                            
                        </div> 

                        

                       

                    </div>

              <!--       <div class="row">
                        <div class="col col-md-5">
                                <grafica-component></grafica-component>
                        </div>
                    </row> -->

                                      


                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
