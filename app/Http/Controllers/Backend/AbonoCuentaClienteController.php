<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\AbonoCuentaCliente;
use App\CuentaCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbonoCuentaClienteController extends Controller
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
        $cuenta = CuentaCliente::find($request->get('cuenta_id'));

        $pago_fecha = new Carbon();
        $pago_fecha = $pago_fecha->format('Y-m-d H:i');

        $abonoCuenta = AbonoCuentaCliente::create([
            'medio_pago' => $request->get('medio_pago'),
            
            'monto' => $request->get('valor'),
            'cuentacl_id' => $cuenta->id,
            'user_id' => Auth::user()->id, 
            'fecha_registro' => $pago_fecha,

        ]);

        //$saldo_cuenta = $cuenta->saldo  ;
          $cuenta->update([
            'saldo' => $cuenta->pagosOt->sum('monto') -  $cuenta->abonosCuenta->sum('monto')   ,
        ]); 

        if($cuenta->abonosCuenta->sum('monto') >= $cuenta->pagosOt->sum('monto')){
            $cuenta->update([
                'estado_cuenta' => 1
            ]);
        }else{
            $cuenta->update([
                'estado_cuenta' => 2          
            ]);

        }


        $medio_pago = "";

        switch($abonoCuenta->medio_pago){
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
                $medio_pago = "Documento";
            break;
  
        }

        $fecha = new Carbon($abonoCuenta->fecha_registro);
        $fecha = $fecha->format('d-m-Y H:i');
        
        return response()->json([
            'success'=> 'success',
            'monto' => $abonoCuenta->monto,
            
            'fecha_registro' => $fecha,
            'encargado' => $abonoCuenta->encargado->first_name . ' '.$abonoCuenta->encargado->last_name,
            'id' => $abonoCuenta->id,
            'estado_cuenta' => $cuenta->estado_cuenta ,
            'medio_pago' => $medio_pago,
            
            //'abonos' => $cuenta->abonosOt->sum('monto'),
            'saldos' =>   (float)$cuenta->saldo,
                       
            ]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AbonoCuentaCliente  $abonoCuentaCliente
     * @return \Illuminate\Http\Response
     */
    public function show(AbonoCuentaCliente $abonoCuentaCliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AbonoCuentaCliente  $abonoCuentaCliente
     * @return \Illuminate\Http\Response
     */
    public function edit(AbonoCuentaCliente $abonoCuentaCliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AbonoCuentaCliente  $abonoCuentaCliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AbonoCuentaCliente $abonoCuentaCliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AbonoCuentaCliente  $abonoCuentaCliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $pago = AbonoCuentaCliente::find($request->get('item'));

        $cuenta = CuentaCliente::find($pago->cuentacl_id);
               
        $pago->delete();

        $cuenta->update([
            'saldo' => $cuenta->pagosOt->sum('monto') -  $cuenta->abonosCuenta->sum('monto')   ,
        ]); 

        if($cuenta->abonosCuenta->sum('monto') >= $cuenta->pagosOt->sum('monto')){
            $cuenta->update([
                'estado_cuenta' => 1
            ]);
        }else{
            $cuenta->update([
                'estado_cuenta' => 2          
            ]);

        }


        return response()->json([
            'estado_cuenta'=> $cuenta->estado_cuenta,           
            'saldos' =>  $cuenta->saldo,
           
            ]); 
    
    }
}
