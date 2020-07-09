<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\EntregaOt;
use App\ItemOt;
use App\OrdenTrabajo;
use App\EntregaItemOt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EntregaOtController extends Controller
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
        $ot = OrdenTrabajo::find($request->get('ot_id'));

        $entrega_fecha = new Carbon($request->get('hora'));
        $entrega_fecha = $entrega_fecha->format('Y-m-d H:i');

        $entregaOt = EntregaOt::create([
            'receptor' => $request->get('receptor'),
            'rut_receptor' => $request->get('rut_receptor'),
            'ot_id' => $ot->id,
            'guia_despacho' => $request->get('guia_despacho'),
            'user_id' => Auth::user()->id, 
            'hora_entrega' => $entrega_fecha,

        ]);

        $items_id = $request->get('items',[]);

        foreach($items_id as $item){
            EntregaItemOt::create([
            'itemot_id' => $item,
            'entregaot_id' => $entregaOt->id,
             ]);

             $aux_item = ItemOt::find($item);
             $aux_item->update([
                'estado' => '5'
             ]);
        }

        if($ot->items_ot->count() == $ot->items_ot->where('estado','=','5')->count()){
            $ot->update([
                'estado' => '5'
            ]);
        }

        $ies = $entregaOt->entregasItemOt;

        $ie_text = '';

        foreach($ies as $ie){
            $ie_text = $ie_text . '['.$ie->item_ot->folio. ']-'.$ie->item_ot->descripcion.' ' ;
        }

        $fecha = new Carbon($entregaOt->hora_entrega);
        $fecha = $fecha->format('d-m-Y H:i');

        
        return response()->json([
            'success'=>'Got Simple Ajax Request.',
            'receptor' => $entregaOt->receptor,
            'rut_receptor' => $entregaOt->rut_receptor,
            'hora_entrega' => $fecha,
            'encargado' => $entregaOt->encargado->first_name . ' '.$entregaOt->encargado->last_name,
            'items' => $ie_text,
            'id' =>$entregaOt->id,
            'items_id' => $items_id,
            'estado_ot' => $ot->estado,
            'guia_despacho' =>  $entregaOt->guia_despacho ? $entregaOt->guia_despacho : 'N/A',
            
           
            ]); 

         
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EntregaOt  $entregaOt
     * @return \Illuminate\Http\Response
     */
    public function show(EntregaOt $entregaOt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EntregaOt  $entregaOt
     * @return \Illuminate\Http\Response
     */
    public function edit(EntregaOt $entregaOt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EntregaOt  $entregaOt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EntregaOt $entregaOt)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EntregaOt  $entregaOt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $entrega = EntregaOt::find($request->get('item'));

        //$ot = $entrega->ot_id;

        $items = EntregaItemOt::where('entregaot_id', $entrega->id)->get();
        
        $array = [];
        foreach($items as $item ){

            $it = ItemOt::find($item->itemot_id);
            $it->update([
                'estado' => '4'
            ]);
            array_push($array,$it->id);
        }

        
        foreach($entrega->entregasItemOt as $et){
            $et->delete();
        }
        $entrega->delete();


        return response()->json([
            'array'=> $array,
           
            ]); 
    }
}
