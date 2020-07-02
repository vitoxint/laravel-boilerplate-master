<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">

    <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Buscar por cliente</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
               
                <div class="row">
                    <div class="col">
                    
                        <form action="{{route('admin.orden_trabajos.buscar_trabajo')}}">

                            <div class="input-group row has-search">
                            <div class="col-md-3">    
                            <span class="fa fa-search form-control-feedback"></span>    
                            <input type="search" name="buscar" style="width:200px;" id="buscar" class="form-control" placeholder=" Buscar por cliente" />
                            </div>
                         
                            </div>
                            {{ csrf_field() }}
                        </form>
                    </div>

                </div>
            </div>
        </div><!--dropdown-->   

        
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Trabajos</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.orden_trabajos.index') }}">Todas las órdenes</a>
                <a class="dropdown-item" href="{{ route('admin.orden_trabajos.pendientes') }}">Pendientes de entrega</a>
                <a class="dropdown-item" href="{{ route('admin.orden_trabajos.entregadas') }}">Entregadas</a>
                <a class="dropdown-item" href="{{ route('admin.orden_trabajos.anuladas') }}">Anuladas</a>
            </div>
        </div><!--dropdown-->

        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Próximas entregas</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.orden_trabajos.px_entregas',['dias' => 0]) }}">Hoy</a>
                <a class="dropdown-item" href="{{ route('admin.orden_trabajos.px_entregas',['dias' => 1]) }}">Mañana</a>
                <a class="dropdown-item" href="{{ route('admin.orden_trabajos.px_entregas',['dias' => 3]) }}">Próximos 3 días</a>
                <a class="dropdown-item" href="{{ route('admin.orden_trabajos.px_entregas',['dias' => 7]) }}">Próximos 7 días</a>
                <a class="dropdown-item" href="{{ route('admin.orden_trabajos.px_entregas',['dias' => 15]) }}">Próximos 15 días</a>
                <a class="dropdown-item" href="{{ route('admin.orden_trabajos.px_entregas',['dias' => 30]) }}">Próximos 30 días</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
