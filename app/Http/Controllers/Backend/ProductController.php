<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Product;
use App\Category;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(){
        $productos = Product::all();
        return $productos;

    }


    public function getLista(){


        $lista      = Product::orderBy('id', 'asc')->get();
        $categorias = Category::orderBy('name', 'asc')->get();
    
    
        $listaProducto   = array();
        $listaCategorias = array();
    
           
        foreach($categorias as $categoria){
    
            array_push( $listaCategorias,[
                'id'        => $categoria->id,
                'nombre'    => $categoria->name,
                
            ]);            
    
        }    

    
        foreach($lista as $producto){
   
            array_push( $listaProducto,[
                'id' =>     $producto->id,
                'nombre' => $producto->name,
                'url_image'    => $producto->url_image,
                'precio'       => $producto->price,
                'descuento'    => $producto->discount,

            ]);
        }
    
        return response()->json([
            'lista' => $listaProducto,
            /* 'lista_marcas'     => $listaMarcas, */
            'lista_categorias' => $listaCategorias            
           
            ]); 
    
    
    }

    public function getListaCategoria(Request $request){


        $categorias  = $request->categorias;
        $arr  = explode(",", $categorias);

        if($arr != []) {
            $lista = Product::whereIn('category', $arr)->get(); 
           
    
        }else{  

            $lista = Product::orderBy('id', 'asc')->get(); 
               
        }

        $listaProducto = array();
        
        foreach($lista as $producto){


            array_push( $listaProducto,[
                'id' =>     $producto->id,
                'nombre' => $producto->name,
                'url_image'    => $producto->url_image,
                'precio'       => $producto->price,
                'descuento'    => $producto->discount,

            ]);
        }

        return response()->json([
            'lista'        => $listaProducto,
            'categorias'  => $arr,
                       
            ]); 



    }


    public function getListaSearch(Request $request){

       
        $term = $request->palabra;

        $categories = Category::where('name', 'LIKE', "%{$term}%")->get('id');
        
        $lista = Product::where('name', 'LIKE', "%{$term}%")->orWhereIn('category', $categories)
        ->orderBy('name', 'asc')->get();

        $listaProducto = array();
        
        foreach($lista as $producto){


            array_push( $listaProducto,[
                'id' =>     $producto->id,
                'nombre' => $producto->name,
                'url_image'    => $producto->url_image,
                'precio'       => $producto->price,
                'descuento'    => $producto->discount,

            ]);
        }

        return response()->json([
            'lista'        => $listaProducto,
            //'categorias'  => $arr,
                       
            ]); 

    }




}


