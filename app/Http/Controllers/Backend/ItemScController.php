<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\ItemSc;
use Carbon\Carbon;
use App\SolicitudCotizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemScController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItemSc  $itemSc
     * @return \Illuminate\Http\Response
     */
    public function show(ItemSc $itemSc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemSc  $itemSc
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemSc $itemSc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemSc  $itemSc
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
            
        ]);  
        
        $sc   = SolicitudCotizacion::where('id', $request->id)->first();
        $item = ItemSc::where('id' , '=', $request->get('item'))->first();

        $item->update([
            'valor_unitario' => $request->get('cpu'),
            'descuento'      => $request->get('des'),
            'valor_total'    => $request->get('cpi')

        ]);



        $sc->update([
            'valor_total' => $sc->itemsSolicitud->sum('valor_total'),
            'estado'      => 2,
            'user_id' => Auth::user()->id, 
        ]);


      return response()->json([
          'success'=>'Got Simple Ajax Request.',
          'valor_neto' => $sc->valor_total,
          'iva' => (float)$sc->valor_total * 0.19,
          'total' => (float)$sc->valor_total * 1.19,
 
          ]); 




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItemSc  $itemSc
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemSc $itemSc)
    {
        //
    }
}
