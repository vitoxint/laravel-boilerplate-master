<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\MaquinaHasOperador;
use Illuminate\Http\Request;

class MaquinaHasOperadorController extends Controller
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
     * @param  \App\MaquinaHasOperador  $maquinaHasOperador
     * @return \Illuminate\Http\Response
     */
    public function show(MaquinaHasOperador $maquinaHasOperador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MaquinaHasOperador  $maquinaHasOperador
     * @return \Illuminate\Http\Response
     */
    public function edit(MaquinaHasOperador $maquinaHasOperador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MaquinaHasOperador  $maquinaHasOperador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaquinaHasOperador $maquinaHasOperador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MaquinaHasOperador  $maquinaHasOperador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $operador_maquina = MaquinaHasOperador::where('maquina_id','=', $request->id)->where('empleado_id','=',$request->get('op'))->first();
        
        if($operador_maquina){
            $operador_maquina->delete();
        }
        

        return response()->json([
            'success'=> $request->get('op'),

            ]); 
        
    }    
}
