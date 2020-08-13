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
use PDF;

use App\Exports\ProductoVentasExport;
use Maatwebsite\Excel\Facades\Excel;


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

    public function exportarxls(){
        return Excel::download(new ProductoVentasExport, 'inventario.xlsx');
    }


    public function getLista(){
        
        $lista      = $this->productoRepository->getApiIndex();
        $marcas     = Marca::orderBy('nombre','asc')->get();
        $categorias = FamiliaProducto::orderBy('nombre', 'asc')->get();


        $listaProducto   = array();
        $listaMarcas     = array();
        $listaCategorias = array();


        foreach($marcas as $marca){

            $cantidad = $marca->producto_ventas->count('id');

            if($cantidad >=1){

                array_push( $listaMarcas,[
                    'id'        => $marca->id,
                    'nombre'    => $marca->nombre,
                    'cantidad'  => $cantidad

                ]);
            }

        }   

        
        foreach($categorias as $categoria){

            $cantidad = $categoria->producto_ventas->count('id');

            if($cantidad >=1){

                array_push( $listaCategorias,[
                    'id'        => $categoria->id,
                    'nombre'    => $categoria->nombre,
                    'cantidad'  => $cantidad

                ]);
            }

        }          

        foreach($lista as $producto){

            $existencias = $producto->existencias->sum('cantidad');

            if($existencias >= 1 ){
                $entrega = 'Inmediata';
                $stock = $existencias;
            }else
            {
                $entrega = 'A pedido';
                $stock = 'Sin Stock';
            }

            array_push( $listaProducto,[
                'id' =>     $producto->id,
                'codigo' => $producto->codigo,
                'descripcion' => $producto->descripcion,
                'marca'       => $producto->marca->nombre,
                'familia'     => $producto->familia->nombre,
                'stock'       => $stock,
                'entrega'     => $entrega,
                'image_url'   => asset( 'storage/'.$producto->imagen_url),
            ]);
        }

        return response()->json([
            'lista'            => $listaProducto,
            'lista_marcas'     => $listaMarcas,
            'lista_categorias' => $listaCategorias            
           
            ]); 

    }

    public function find(Request $request){
        $id = $request->id;

        $producto = ProductoVenta::where('id', $id)->first();

        return response()->json([
            'desc'        => $producto->descripcion,
            'url'         => asset( 'storage/'.$producto->imagen_url),
            'marca'       => $producto->marca->nombre
                      
            ]); 
        
    }


    public function getListaSearch(Request $request){

        //$term = $request->get('buscar');
        $term = $request->buscar;
        
        $lista = $this->productoRepository->getApiSearch($term);
        
        $listaProducto = array();
        

        foreach($lista as $producto){

            $existencias = $producto->existencias->sum('cantidad');

            if($existencias >= 1 ){
                $entrega = 'Inmediata';
                $stock = $existencias;
            }else
            {
                $entrega = 'A pedido';
                $stock = 'Sin Stock';
            }

            array_push( $listaProducto,[
                'id' =>     $producto->id,
                'codigo' => $producto->codigo,
                'descripcion' => $producto->descripcion,
                'marca'       => $producto->marca->nombre,
                'familia'     => $producto->familia->nombre,
                'stock'       => $stock,
                'entrega'     => $entrega,
                'image_url'   => asset( 'storage/'.$producto->imagen_url),
            ]);
        }

        return response()->json([
            'lista'        => $listaProducto,
            
                  
            ]); 

    }


    public function getListaCheck(Request $request){

        //$marcas = array(); 
        $marcas = $request->get('marcas');
        $categorias  = $request->get('categorias');
              

        if(( $marcas != [])  && ($categorias != [])) {
            $lista = ProductoVenta::whereIn('marca_id', $marcas)->whereIn('familia_producto_id', $categorias)->get(); 
            //$lista      = $this->productoRepository->getApiIndex();
    
        }else{

            if($marcas != []){
                $lista = ProductoVenta::whereIn('marca_id', $marcas)->get(); 
                }
                else{
                    if($categorias != []){
                        $lista = ProductoVenta::whereIn('familia_producto_id', $categorias)->get(); 
                    }else{
                        $lista      = $this->productoRepository->getApiIndex();
                    }


            }
        }
        
/*         else{ 
            $lista      = $this->productoRepository->getApiIndex();
        }  */
        
        $listaProducto = array();
        

        foreach($lista as $producto){

            $existencias = $producto->existencias->sum('cantidad');

            if($existencias >= 1 ){
                $entrega = 'Inmediata';
                $stock = $existencias;
            }else
            {
                $entrega = 'A pedido';
                $stock = 'Sin Stock';
            }

            array_push( $listaProducto,[
                'id' =>     $producto->id,
                'codigo' => $producto->codigo,
                'descripcion' => $producto->descripcion,
                'marca'       => $producto->marca->nombre,
                'familia'     => $producto->familia->nombre,
                'stock'       => $stock,
                'entrega'     => $entrega,
                'image_url'   => asset( 'storage/'.$producto->imagen_url),
            ]);
        }

        return response()->json([
            'lista'        => $listaProducto,
            'marcas'  => $marcas
            
           
            ]); 

    }



    public function buscar_producto(Request $request)
    {
        $term = $request->input('buscar');

        return view('backend.productos_venta.index')
            ->withProductoVentas($this->productoRepository->getBuscarProductosPaginated(25, 'codigo', 'asc',$term));

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

    //funcion API RESTS
    public function show(ProductoVenta $producto)
    {
        return $producto;
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
        $producto->delete();
        return redirect()->route('admin.productos-venta.index')->withFlashSuccess('Producto de venta eliminado'); 
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


    public function print_etq(ProductoVenta $producto)
    {
        //return $item_ot;
        $data = ['title' => 'etiqueta producto venta'];
        $customPaper = array(0,0,178.80,145.70 ); // 50 60
        //$customPaper = array(0,0,227.56,332.90); // 70 100
        
        $pdf = PDF::loadView('backend.productos_venta.print_etq', compact('producto'))->setPaper($customPaper, 'portrait');
        
        return $pdf->stream('Producto_'.$producto->codigo.'.pdf');
    }



    public function opencode(Request $request){

        $string = strtoupper(
            
            $request->input('codigo_id')
        );

        $producto   = ProductoVenta::where('codigo', $string)->first();
       

        if($producto){

            return view('backend.productos_venta.edit',compact('producto'));

        }

        return redirect()->route('admin.productos-venta.index')->withFlashDanger('No se encontró el ítem escaneado');


    }

}
