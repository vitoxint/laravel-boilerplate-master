<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\PagoOt;
use App\OrdenTrabajo;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PagoOtController extends Controller
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

        $pago_fecha = new Carbon();
        $pago_fecha = $pago_fecha->format('Y-m-d H:i');

        $abonoOt = PagoOt::create([
            'medio_pago' => $request->get('medio_pago'),
            'monto' => $request->get('valor'),
            'ot_id' => $ot->id,
            'user_id' => Auth::user()->id, 
            'fecha_abono' => $pago_fecha,

        ]);

        $valor_ot = $ot->valor_total * 1.19 ;

        if($ot->abonosOt->sum('monto') >= $valor_ot){
            $ot->update([
                'estado_pago' => 3
            ]);
        }else{
            $ot->update([
                'estado_pago' => 2          
            ]);

        }

        $medio_pago = "";

        switch($abonoOt->medio_pago){
            case(1):
                $medio_pago = "Efectivo";
            break;
            case(2):
                $medio_pago = "Tarjeta (Transbank)";
            break;
            case(3):
                $medio_pago = "Transferencia bancaria";
            break;
            case(4):
                $medio_pago = "Cuenta cliente";
            break;
  
        }

        $fecha = new Carbon($abonoOt->fecha_abono);
        $fecha = $fecha->format('d-m-Y H:i');
        
        return response()->json([
            'success'=> 'success',
            'monto' => $abonoOt->monto,
            
            'fecha_abono' => $fecha,
            'encargado' => $abonoOt->encargado->first_name . ' '.$abonoOt->encargado->last_name,
            'id' =>$abonoOt->id,
            'estado_ot' => $ot->estado ,
            'medio_pago' => $medio_pago,
            'estado_pago' => $ot->estado_pago,
            'abonos' => $ot->abonosOt->sum('monto'),
            'saldos' =>   (float)$ot->valor_total * 1.19 - (float)$ot->abonosOt->sum('monto'),
                       
            ]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PagoOt  $pagoOt
     * @return \Illuminate\Http\Response
     */
    public function show(PagoOt $pagoOt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PagoOt  $pagoOt
     * @return \Illuminate\Http\Response
     */
    public function edit(PagoOt $pagoOt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PagoOt  $pagoOt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PagoOt $pagoOt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PagoOt  $pagoOt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        $pago = PagoOt::find($request->get('item'));

        $ot = OrdenTrabajo::find($pago->ot_id);

        //$items = EntregaItemOt::where('entregaot_id', $entrega->id)->get();
               
        $pago->delete();

        $valor_ot = $ot->valor_total * 1.19 ;

        if($ot->abonosOt->sum('monto') < $valor_ot){
            $ot->update([
                'estado_pago' => 2
            ]);
        }
        
        if($ot->abonosOt->sum('monto') <= 0){
            $ot->update([
                'estado_pago' => 1          
            ]);

        }


        return response()->json([
            'estado_pago'=> $ot->estado_pago,
            'abonos' => $ot->abonosOt->sum('monto'),
            'saldos' =>   (float)$ot->valor_total * 1.19 - (float)$ot->abonosOt->sum('monto'),
           
            ]); 
    }
}
