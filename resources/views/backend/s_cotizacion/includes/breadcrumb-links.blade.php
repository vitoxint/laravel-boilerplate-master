<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Solicitudes</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.s_cotizaciones.index') }}">Todas las solicitudes</a>
                <a class="dropdown-item" href="{{ route('admin.s_cotizaciones.espera') }}">En espera</a>
                <a class="dropdown-item" href="{{ route('admin.s_cotizaciones.resueltas') }}">Resueltas</a>
                <a class="dropdown-item" href="{{ route('admin.s_cotizaciones.enviadas') }}">Enviadas</a>
               
            </div>
        </div><!--dropdown-->

        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Buscar por solicitante &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
               
                <div class="row">
                    <div class="col">
                    
                        <form action="{{route('admin.s_cotizaciones.buscar_cotizacion')}}">

                            <div class="input-group">
                            <input type="search" name="buscar" id="buscar" class="form-control" width="40px" placeholder=" Buscar por solicitante" />
                            <div id="lista" >
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-secondary btn-xs" type="button">
                                <i class="fa fa-search"></i>
                                </button>
                            </div>
                            </div>
                            {{ csrf_field() }}
                        </form>





                    </div>

                </div>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
