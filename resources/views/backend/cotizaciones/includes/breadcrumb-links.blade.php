<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cotizaciones</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.cotizaciones.index') }}">Todas las cotizaciones</a>
                <a class="dropdown-item" href="{{ route('admin.cotizaciones.vigentes') }}">Cotizaciones vigentes</a>
                <a class="dropdown-item" href="{{ route('admin.cotizaciones.aceptadas') }}">Cotizaciones Aceptadas</a>
               
            </div>
        </div><!--dropdown-->

        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Buscar por cliente / contacto</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
               
                <div class="row">
                    <div class="col">
                    
                        <form action="{{route('admin.cotizaciones.buscar_cotizacion')}}">

                            <div class="input-group">
                            <input type="search" name="buscar" id="buscar" class="form-control" width="40px" placeholder=" Buscar por cliente" />
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
