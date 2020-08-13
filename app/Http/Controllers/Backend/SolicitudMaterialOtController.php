<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Backend\Model\SolicitudMaterialOtRepository;

use App\SolicitudMaterialOt;
use Illuminate\Http\Request;
use App\Material;
use App\ItemOt;
use DB;

class SolicitudMaterialOtController extends Controller
{
    protected $solicitudMaterialOtRepository;

    public function __construct(SolicitudMaterialOtRepository $solicitudMaterialOtRepository)
    {
        $this->solicitudMaterialOtRepository = $solicitudMaterialOtRepository;
    }

    
    public function index()
    {
        //
    }

    public function index_solicitudes_material(){

        //return $this->trabajoMaterialRepository->getActivePaginated(25, 'created_at', 'asc');
        return view('backend.trabajo_material.index')
        ->withSolicitudes($this->solicitudMaterialOtRepository->getActivePaginated(25, 'created_at', 'desc'));

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
        $material = Material::where('id','=', $request->get('material_id'))->first();

        $material_agr = SolicitudMaterialOt::create([
            'itemot_id' => $request->id,
            'material_id' =>$request->get('material_id'),
            'dimension_largo' => $request->get('largo'),
            'dimension_ancho' => $request->get('ancho'),
            'valor_unit' => $material->valor_kg,
            'valor_total' => $request->get('valor'),
            'estado' => 1 ,
        ]);


        $item_ot = ItemOt::find($request->id);
        
        $valor_total = DB::table('trabajo_use_materials')
        ->where('itemot_id','=', $item_ot->id)
        ->sum('valor_total');

        
        $valor_material =  ($item_ot->materialOt->sum('valor_total') + $item_ot->solicitudMaterialOt->sum('valor_total'));
        $valor_delta    =  $item_ot->valor_parcial - ( $item_ot->procesosOt->sum('valor_proceso') + $item_ot->materialOt->sum('valor_total') + $item_ot->solicitudMaterialOt->sum('valor_total') ) ;

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
                'valor_material' => $valor_material,
                'valor_delta' => $valor_delta,
    
                ]); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SolicitudMaterialOt  $solicitudMaterialOt
     * @return \Illuminate\Http\Response
     */
    public function show(SolicitudMaterialOt $solicitudMaterialOt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SolicitudMaterialOt  $solicitudMaterialOt
     * @return \Illuminate\Http\Response
     */
    public function edit(SolicitudMaterialOt $solicitud)
    {
        return view('backend.trabajo_material.edit', compact('solicitud'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SolicitudMaterialOt  $solicitudMaterialOt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SolicitudMaterialOt $solicitudMaterialOt)
    {
        //
    }

    public function cambiarEstado(Request $request){

        $solicitud = SolicitudMaterialOt::find($request->id);

        if(($request->get('mode') == 'true')||($request->get('mode') == 1)){
            $solicitud->update([
                'estado' => 2,
            ]);
            return response()->json([
                'success'=>'Se ha cerrado la solicitud.',
                //'valor_total' => $valor_total,
       
                ]); 
        }else{
            $solicitud->update([
                'estado' => 1,
            ]);

            return response()->json([
                'success'=>'La solicitud esta abierta y en espera.',
                //'valor_total' => $valor_total,
       
                ]); 
        }
        
        return response()->json([
            'success'=>'Hola.',
            //'valor_total' => $valor_total,
   
            ]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SolicitudMaterialOt  $solicitudMaterialOt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $material_elim  = SolicitudMaterialOt::where( 'id','=', $request->get('item'))->first();
        $item_ot = ItemOt::find($material_elim->itemot_id);
        $material_elim->delete();

        $valor_material =  ($item_ot->materialOt->sum('valor_total') + $item_ot->solicitudMaterialOt->sum('valor_total'));
        $valor_delta    =  $item_ot->valor_parcial - ( $item_ot->procesosOt->sum('valor_proceso') + $item_ot->materialOt->sum('valor_total') + $item_ot->solicitudMaterialOt->sum('valor_total') ) ;

        //$valor_total = $item_ot->materialOt->sum('valor_total');

        /* $valor_total = DB::table('trabajo_use_materials')
                ->where('itemot_id', $item_ot->id)
                ->sum('valor_total');
 */
        return response()->json([
            'success'=>'Eliminado.',
            'valor_material' => $valor_material,
            'valor_delta' => $valor_delta,
            //'valor_total' => $valor_total,
   
            ]); 
    }
}
