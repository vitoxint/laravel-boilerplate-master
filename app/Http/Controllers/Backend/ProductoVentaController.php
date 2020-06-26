<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Backend\Model\ProductoVentaRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use App\ProductoVenta;
use App\Marca;
use App\FamiliaProducto;
use Illuminate\Http\Request;



class ProductoVentaController extends Controller
{
    
    protected $productoRepository;

    public function __construct(ProductoVentaRepository $productoRepository)
    {
        $this->productoRepository = $productoRepository;
    }

    public function index()
    {

        //return $this->productoRepository->getActivePaginated(15, 'id', 'asc')  ;
        return view('backend.productos_venta.index')
        ->withProductoVentas($this->productoRepository->getActivePaginated(10, 'codigo', 'asc'));
    }


    public function buscar_producto(Request $request)
    {
        $term = $request->input('buscar');

        return view('backend.productos_venta.index')
            ->withProductoVentas($this->productoRepository->getBuscarMaterialesPaginated(25, 'codigo', 'asc',$term));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('backend.productos_venta.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'imagen_url'   =>  'required|max:32048',
            'familia_producto_id'   => 'required'    , 
            'descripcion'  => 'required' ,
            'codigo'       => 'required',
            'stock_seguridad' => 'required|numeric',
            'precio_lista' => 'required|numeric',
           
        ]); 

        $file   =   $request->file('imagen_url');
        //$name = $file->store('/uploads/logo_marcas', 'public'); 
        
        $name = $file->store('/imagen_productos/', 'public'); 
     

        $marca = Marca::query()->where('id','=',$request->input('marca_id'))->get();

        if( $marca->count() == 0){
            $nueva_marca = Marca::create([
                'nombre' => $request->input('marca_id'),                                       
            ]); 
            $marca_id = $nueva_marca->id;
        }else{

            $marca_id = $request->input('marca_id');
        }

        $familia = FamiliaProducto::query()->where('id','=',$request->input('familia_producto_id'))->get();

        if( $marca->count() == 0){
            $nueva_familia = FamiliaProducto::create([
                'nombre' => $request->input('familia_producto_id'),                                       
            ]); 
            $familia_id = $nueva_familia->id;
        }else{

            $familia_id = $request->input('familia_producto_id');
        }


        $producto = ProductoVenta::create([
            'imagen_url' => $name,
            'familia_producto_id'   => $request->input('familia_producto_id')    , 
            'descripcion'           => $request->input('descripcion') ,
            'codigo'                => $request->input('codigo') ,
            'stock_seguridad'          => $request->input('stock_seguridad') ,
            'precio_lista'          => $request->input('precio_lista') ,
            'marca_id'              => $marca_id,
            'familia_producto_id'   => $familia_id,

        ]);

        //return view('backend.productos_venta.index')->withFlashSuccess('producto registrado');
        return redirect()->route('admin.productos-venta.index')->withFlashSuccess('El producto se ha registrado correctamente');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductoVenta  $productoVenta
     * @return \Illuminate\Http\Response
     */
    public function show(ProductoVenta $productoVenta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductoVenta  $productoVenta
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductoVenta $producto)
    {
            //return $producto->existencias;
        return view('backend.productos_venta.edit',compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductoVenta  $productoVenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductoVenta $producto)
    {

        $this->validate($request, [
           // 'imagen_url'   =>  'required|max:32048',
            'familia_producto_id'   => 'required'    , 
            'descripcion'  => 'required' ,
            'codigo'       => 'required',
            'stock_seguridad' => 'required|numeric',
            'precio_lista' => 'required|numeric',
           
        ]); 

        if($request->file('imagen_url') != null ){
            $file   =   $request->file('imagen_url');
            $name = $file->store('/imagen_productos/', 'public');

            Storage::disk('public')->delete($producto->imagen_url);       

        }else{
            $name = $producto->imagen_url;
        }


        $marca = Marca::query()->where('id','=',$request->input('marca_id'))->get();

        if( $marca->count() == 0){
            $nueva_marca = Marca::create([
                'nombre' => $request->input('marca_id'),                                       
            ]); 
            $marca_id = $nueva_marca->id;
        }else{

            $marca_id = $request->input('marca_id');
        }

        $familia = FamiliaProducto::query()->where('id','=',$request->input('familia_producto_id'))->get();

        if( $marca->count() == 0){
            $nueva_familia = FamiliaProducto::create([
                'nombre' => $request->input('familia_producto_id'),                                       
            ]); 
            $familia_id = $nueva_familia->id;
        }else{

            $familia_id = $request->input('familia_producto_id');
        }

        $producto->update([

            'imagen_url' => $name,
            'familia_producto_id'   => $request->input('familia_producto_id')    , 
            'descripcion'           => $request->input('descripcion') ,
            'codigo'                => $request->input('codigo') ,
            'stock_seguridad'          => $request->input('stock_seguridad') ,
            'precio_lista'          => $request->input('precio_lista') ,
            'marca_id'              => $marca_id,
            'familia_producto_id'   => $familia_id,

        ]);

        return redirect()->route('admin.productos-venta.edit', $producto)->withFlashSuccess('Los datos del producto se han actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductoVenta  $productoVenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductoVenta $productoVenta)
    {
        //
    }


    public function marcaSelect2(Request $request){

        $term = trim($request->q);

        $tags = Marca::query()
            ->where('nombre', 'LIKE', "%{$term}%")
            ->get(); 

       $formatted_tags = [];

       foreach ($tags as $tag) {
           $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->nombre];
       }

       return \Response::json($formatted_tags);

    }


    public function familiaSelect2(Request $request){

        $term = trim($request->q);

        $tags = FamiliaProducto::query()
            ->where('nombre', 'LIKE', "%{$term}%")
            ->get(); 

       $formatted_tags = [];
       
       foreach ($tags as $tag) {
           $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->nombre];
       }

       return \Response::json($formatted_tags);

    }

}
