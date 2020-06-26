<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\ExistenciaProductoVenta;
use App\ProductoVenta;
use Illuminate\Http\Request;

class ExistenciaProductoVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       

        $depositos_count = ExistenciaProductoVenta::where('producto_id',$request->get('producto') )->where('deposito_id',$request->get('deposito'))->get();

        if($depositos_count->count() == 0 )
        {
            $deposito_agr = ExistenciaProductoVenta::create([
                'deposito_id' => $request->get('deposito'),
                'producto_id' => $request->get('producto'),
                'cantidad'    => 0,   
            ]);

            if($deposito_agr){
                return response()->json([
                    //'success'=>'Got Simple Ajax Request.',
                    'id' => $deposito_agr->id,
                    'deposito' =>$deposito_agr->deposito->nombre,
                    'cantidad' => $deposito_agr->cantidad,
        
                    ]); 
            }
        }
        else{
            return $gdgdgdg;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExistenciaProductoVenta  $existenciaProductoVenta
     * @return \Illuminate\Http\Response
     */
    public function show(ExistenciaProductoVenta $existenciaProductoVenta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExistenciaProductoVenta  $existenciaProductoVenta
     * @return \Illuminate\Http\Response
     */
    public function edit(ExistenciaProductoVenta $existenciaProductoVenta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExistenciaProductoVenta  $existenciaProductoVenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExistenciaProductoVenta $existenciaProductoVenta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExistenciaProductoVenta  $existenciaProductoVenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $existencia = ExistenciaProductoVenta::find($request->get('item'));
        $existencia->delete();

        return response()->json([
            'success'=>'Got Simple Ajax Request.',
           

            ]); 


    }


    public function sumar(Request $request){

        $existencia = ExistenciaProductoVenta::find($request->get('item'));

        $existencia->update([
            'cantidad' => (float)$existencia->cantidad + (float)$request->get('valor') , 
        ]);

        $producto = ProductoVenta::find($existencia->producto_id);

    
        return response()->json([
            'success'=>'Got Simple Ajax Request.',
            'cantidad' => $existencia->cantidad,
            'stock_min' => $producto->stock_seguridad,
            'stock_actual' => $producto->existencias->sum('cantidad'),
           
            ]); 

    }


    public function restar(Request $request){

        $existencia = ExistenciaProductoVenta::find($request->get('item'));

        if( ((float)$existencia->cantidad - (float)$request->get('valor')) >= 0){

            $existencia->update([
                'cantidad' => (float)$existencia->cantidad - (float)$request->get('valor') , 
            ]);

        }  

        $producto = ProductoVenta::find($existencia->producto_id);     
    
        return response()->json([
            'success'=>'Got Simple Ajax Request.',
            'cantidad' => $existencia->cantidad,
            'stock_min' => $producto->stock_seguridad,
            'stock_actual' => $producto->existencias->sum('cantidad'),
           
            ]); 

    }


}
