<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\PagoOt;
use App\OrdenTrabajo;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\CuentaCliente;

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
            'cuenta_cliente_id' => $request->get('cuenta_cl'),
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

        if($abonoOt->medio_pago == 4){
            $cuentaCliente = CuentaCliente::find($abonoOt->cuenta_cliente_id);

            $cuentaCliente->update([
                'saldo' =>  $cuentaCliente->saldo + $abonoOt->monto,

            ]) ;
            
            if($cuentaCliente->abonosCuenta->sum('monto') >= $cuentaCliente->pagosOt->sum('monto')){
                $cuentaCliente->update([
                    'estado_cuenta' => 1
                ]);
            }else{
                $cuentaCliente->update([
                    'estado_cuenta' => 2          
                ]);
    
            }

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

        $medio_pago =    $pago->medio_pago;
        $cuentaCl   = $pago->cuenta_cliente_id;
        $montoPago      = $pago->monto;

        $pago->delete();

        if($medio_pago == 4){
            $cuentaCliente = CuentaCliente::find($cuentaCl);

            $cuentaCliente->update([
                'saldo' =>  $cuentaCliente->saldo - $montoPago,

            ]) ;
            
            if($cuentaCliente->abonosCuenta->sum('monto') >= $cuentaCliente->pagosOt->sum('monto')){
                $cuentaCliente->update([
                    'estado_cuenta' => 1
                ]);
            }else{
                $cuentaCliente->update([
                    'estado_cuenta' => 2          
                ]);
    
            }

        }

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
