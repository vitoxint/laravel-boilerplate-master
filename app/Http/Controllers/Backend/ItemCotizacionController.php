<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\ItemCotizacion;
use App\Cotizacion;
use Illuminate\Http\Request;

class ItemCotizacionController extends Controller
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
        $this->validate($request, [
            
            'item' => 'required',
            'qty' => 'required|numeric',
            'desc' => 'required',
            'cpu' => 'required|numeric',
            'des' => 'required|numeric',
            'cpi' => 'required|numeric',
            
        ]); 

        $item_r = ItemCotizacion::where('cotizacion_id', '=', $request->id)->where('folio','=', '1')->first();
        $cotizacion = Cotizacion::find($request->id);

/*         if($item_r != null){

            $input = $request->all();
            return response()->json([
                'success'=>'Got Simple Ajax Request.',
                'valor_neto' => $cotizacion->valor_neto,
                'iva' => (float)$cotizacion->valor_neto * 0.19,
                'total' => (float)$cotizacion->valor_neto * 1.19,
       
                ]); 

        } */



        $item = ItemCotizacion::create([
           
            'descripcion'=>$request->get('desc'),
            'folio' => $request->get('item'),
            'cantidad'=> $request->get('qty'),
            'valor_unitario' => $request->get('cpu'),
            'descuento' => $request->get('des'),
            'valor_parcial' => $request->get('cpi'),        
            'cotizacion_id' => $cotizacion->id,

          ]);  
          
          
          $cotizacion->valor_neto = $cotizacion->valor_neto + $item->valor_parcial;
          $cotizacion->save();
              
        //$input = $request->all();
        return response()->json([
            'success'=>'Got Simple Ajax Request.',
            'valor_neto' => $cotizacion->valor_neto,
            'iva' => (float)$cotizacion->valor_neto * 0.19,
            'total' => (float)$cotizacion->valor_neto * 1.19,
   
            ]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItemCotizacion  $itemCotizacion
     * @return \Illuminate\Http\Response
     */
    public function show(ItemCotizacion $itemCotizacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemCotizacion  $itemCotizacion
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemCotizacion $itemCotizacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemCotizacion  $itemCotizacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            
            'item' => 'required',
            'qty' => 'required|numeric',
            'cpu' => 'required|numeric',
            'des' => 'required|numeric',
            'cpi' => 'required|numeric',
            'desc' => 'required'
            
        ]);  
        
        $cotizacion   = Cotizacion::where('id', $request->id)->first();
        //$item = ItemCotizacion::where('folio' , '=', $request->get('item'))->first();
        $item = ItemCotizacion::where('cotizacion_id','=', $request->id)->where('folio','=',$request->get('item'))->first();

        $item->update([
            'descripcion'    => $request->get('desc'),
            'valor_unitario' => $request->get('cpu'),
            'descuento'      => $request->get('des'),
            'valor_parcial'  => $request->get('cpi'),
            

        ]);



        $cotizacion->update([
            'valor_neto' => $cotizacion->items_cotizacion->sum('valor_parcial'),
            
        ]);


      return response()->json([
        'success'=>'Got Simple Ajax Request.',
        'valor_neto' => $cotizacion->valor_neto,
        'iva' => (float)$cotizacion->valor_neto * 0.19,
        'total' => (float)$cotizacion->valor_neto * 1.19,
 
          ]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItemCotizacion  $itemCotizacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
             
        $item = ItemCotizacion::where('cotizacion_id','=', $request->id)->where('folio','=',$request->get('item'))->first();
        
        $cotizacion = Cotizacion::find($request->id);

        if($item != null){

            $cotizacion->valor_neto = $cotizacion->valor_neto - $item->valor_parcial;
            $cotizacion->save();
            $item->delete();

            return response()->json([
                'success'=> $request->get('desc'),
                'valor_neto' => $cotizacion->valor_neto,
                'iva' => (float)$cotizacion->valor_neto * 0.19,
                'total' => (float)$cotizacion->valor_neto * 1.19,
       
                ]); 
   
        }

        return response()->json([
            'success'=> $request->get('desc'),
            'valor_neto' => $cotizacion->valor_neto,
            'iva' => (float)$cotizacion->valor_neto * 0.19,
            'total' => (float)$cotizacion->valor_neto * 1.19,
   
            ]); 
        
    }
}
