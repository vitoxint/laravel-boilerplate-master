<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">

        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categorías</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">

                <a class="dropdown-item" href="{{ route('admin.productos-venta.index') }}">Todos los productos</a>
                <?php $familias = App\FamiliaProducto::orderBy('nombre')->get(); ?>
                @foreach($familias as $familia)
                <a class="dropdown-item" href="">{{$familia->nombre}}</a>

                @endforeach
                
               
            </div>
        </div><!--dropdown-->

        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Buscar ítem &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
               
                <div class="row">
                    <div class="col cold-md-3">
                    
                        <form action="{{route('admin.productos-venta.buscar_producto')}}">

                            <div class="input-group">
                            <input type="search" name="buscar" id="buscar" class="form-control" placeholder=" Buscar por código, descripción, marca " />
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
