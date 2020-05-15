<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cliente</a>

            <div class="dropdown-menu" style="width:260px;" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.clientes.index') }}">Todos los clientes</a>
                <div class="row">
                    <div class="col">
                    
                        <form action="{{route('admin.clientes.buscar_clientes')}}">

                            <div class="input-group">
                            <input type="search" name="buscar" id="buscar" class="form-control" placeholder=" Buscar por nombre/RUT" />
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

        
    </div>
</li>
