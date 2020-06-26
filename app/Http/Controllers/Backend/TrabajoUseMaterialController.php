<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Backend\Model\TrabajoUseMaterialRepository;

use App\TrabajoUseMaterial;
use App\Material;
use App\ItemOt;
use App\ExistenciaMaterial;
use Illuminate\Http\Request;
use DB;

class TrabajoUseMaterialController extends Controller
{
    protected $trabajoMaterialRepository;

    public function __construct(TrabajoUseMaterialRepository $trabajoMaterialRepository)
    {
        $this->trabajoMaterialRepository = $trabajoMaterialRepository;
    }

    public function index()
    {
        //
    }

    public function index_solicitudes_material(){

        //return $this->trabajoMaterialRepository->getActivePaginated(25, 'created_at', 'asc');
        return view('backend.trabajo_material.index')
        ->withSolicitudes($this->trabajoMaterialRepository->getActivePaginated(25, 'created_at', 'asc'));

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

        $corte = ExistenciaMaterial::where('id',$request->get('material_id'))->first();

        $material = Material::where('id','=', $corte->material_id)->first();

        $material_agr = TrabajoUseMaterial::create([
            'itemot_id' => $request->id,
            'material_id' =>$material->id,
            'dimension_largo' => $request->get('largo'),
            'dimension_ancho' => $request->get('ancho'),
            'valor_unit' => $corte->valor_unit,
            'valor_total' => $request->get('valor'),
            'estado' => 2 ,
            'existencia_material_id' => $corte->id,
            'solicitud_material_id' => $request->get('solicitud'),
        ]);

        $valor_restante = $corte->valor_total - $request->get('valor');

       


        $corte->update([
            'dimension_largo' => $corte->dimension_largo -  $request->get('largo'),
            'dimension_ancho' => $corte->dimension_ancho -  $request->get('ancho'),
            'estado_consumo' => 2,
            'valor_total' => $corte->valor_total - $request->get('valor'),

        ]);


        $item_ot = ItemOt::find($request->id);
        
        $valor_total = DB::table('trabajo_use_materials')
        ->where('itemot_id','=', $item_ot->id)
        ->sum('valor_total');

        if($material_agr){
            return response()->json([
                //'success'=>'Got Simple Ajax Request.',
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
    public function edit(TrabajoUseMaterial $solicitud)
    {
        
        return view('backend.trabajo_material.edit', compact('solicitud'));
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

        $corte = ExistenciaMaterial::where('id', $material_elim->existencia_material_id)->first();

        $item_ot = ItemOt::find($material_elim->itemot_id);

        $corte->update([
            'dimension_largo' => $corte->dimension_largo + $material_elim->dimension_largo,
            'dimension_ancho' => $corte->dimension_ancho + $material_elim->dimension_ancho,
            'valor_total' => $corte->valor_total + $material_elim->valor_total,
        ]);

        if($corte->materialAsignadoOt->count() == 0){
            $corte->update([
                'estado_consumo' => 1,
            ]);

        }


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


        public function consumir(Request $request){


            $consumo = TrabajoUseMaterial::find($request->get('item'));  
            $consumo->update([
                'estado' => 3 ,
            ]) ;  

            $corte = ExistenciaMaterial::where('id', $consumo->existencia_material_id)->first();

            //$item_ot = ItemOt::find($material_elim->itemot_id);
            $consumos = $corte->materialAsignadoOt->where('estado',2)->count();
    
            if($consumos == 0){
                $corte->update([
                    'estado_consumo' => 1,
                ]);
    
            }           
            
            return response()->json([
                'success'=>'Se ha reportado el material como utilizado',
                //'valor_total' => $valor_total,
       
                ]); 


        }

        




}
