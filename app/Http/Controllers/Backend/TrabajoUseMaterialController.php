<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\TrabajoUseMaterial;
use App\Material;
use App\ItemOt;
use Illuminate\Http\Request;
use DB;

class TrabajoUseMaterialController extends Controller
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

       // material_id:material_id, largo:largo , ancho:ancho , valor:valor
        $material = Material::where('id','=', $request->get('material_id'))->first();

        $material_agr = TrabajoUseMaterial::create([
            'itemot_id' => $request->id,
            'material_id' =>$request->get('material_id'),
            'dimension_largo' => $request->get('largo'),
            'dimension_ancho' => $request->get('ancho'),
            'valor_unit' => $material->valor_kg,
            'valor_total' => $request->get('valor')

        ]);

        $item_ot = ItemOt::find($request->id);

        
        $valor_total = DB::table('trabajo_use_materials')
        ->where('itemot_id','=', $item_ot->id)
        ->sum('valor_total');

        if($material_agr){
            return response()->json([
                'success'=>'Got Simple Ajax Request.',
                'id' => $material_agr->id,
                'material' =>$material->material,
                'dimension_largo' => $material_agr->dimension_largo,
                'dimension_ancho' => $material_agr->dimension_ancho,
                'valor_unit' => $material_agr->valor_unit,
                'valor_total' => $material_agr->valor_total,
                'total' => $valor_total,

    
                ]); 

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TrabajoUseMaterial  $trabajoUseMaterial
     * @return \Illuminate\Http\Response
     */
    public function show(TrabajoUseMaterial $trabajoUseMaterial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TrabajoUseMaterial  $trabajoUseMaterial
     * @return \Illuminate\Http\Response
     */
    public function edit(TrabajoUseMaterial $trabajoUseMaterial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TrabajoUseMaterial  $trabajoUseMaterial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TrabajoUseMaterial $trabajoUseMaterial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TrabajoUseMaterial  $trabajoUseMaterial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $material_elim  = TrabajoUseMaterial::where( 'id','=', $request->get('item'))->first();
        $item_ot = ItemOt::find($material_elim->itemot_id);
        $material_elim->delete();

        //$valor_total = $item_ot->materialOt->sum('valor_total');

        $valor_total = DB::table('trabajo_use_materials')
                ->where('itemot_id', $item_ot->id)
                ->sum('valor_total');

        return response()->json([
            'success'=>'Eliminado.',
            'valor_total' => $valor_total,
   
            ]); 
    }
}
