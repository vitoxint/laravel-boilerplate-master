<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Backend\Model\ExistenciaMaterialRepository;

use App\ExistenciaMaterial;
use App\Deposito;
use App\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ExistenciaMaterialController extends Controller
{
    protected $existenciaMaterialRepository;

    public function __construct(ExistenciaMaterialRepository $existenciaMaterialRepository)
    {
        $this->existenciaMaterialRepository = $existenciaMaterialRepository;
    }

    public function index()
    {
        return view('backend.existencias_material.index')
        ->withExistencias($this->existenciaMaterialRepository->getActivePaginated(25, 'estado_consumo', 'asc'));
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
        $id_material = $request->material_id;

        $deposito = ExistenciaMaterial::create([
            'material_id' => $id_material,
            'deposito_id' => $request->get('deposito'),
            'user_id' => Auth::user()->id, 
            'dimension_largo' => $request->get('largo'),
            'dimension_ancho' => $request->get('ancho'),
            'valor_unit' => $request->get('cpu'),
            'valor_total' => $request->get('cpi'),
            'origen_material' => $request->get('origen'),
            'deposito_id' => $request->get('deposito'),
            'detalle_origen' => $request->get('detalle_origen'),
            'estado_consumo' => 1


        ]);

        $depositoL = Deposito::where('id' ,$request->input('deposito_id'))->first();
        //return $deposito->existencia_material;
        if($depositoL->existencia_material->whereBetween('estado_consumo', [1,2])->count() > 0){
            $depositoL->update([
                'estado_utilizada' => 1,
            ]);
        }else{
            $depositoL->update([
                'estado_utilizada' => null,
            ]);
        }

        if($deposito){
            return response()->json([
                'success'=>'BIEN !.',
                
   
            ]); 

        }else{
            return response()->json([
                'success'=>'ERROR !.',
                   
           ]); 

        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExistenciaMaterial  $existenciaMaterial
     * @return \Illuminate\Http\Response
     */
    public function show(ExistenciaMaterial $existenciaMaterial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExistenciaMaterial  $existenciaMaterial
     * @return \Illuminate\Http\Response
     */
    public function edit(ExistenciaMaterial $existenciaMaterial)
    {
        //return $existenciaMaterial;
        return view('backend.existencias_material.edit', compact('existenciaMaterial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExistenciaMaterial  $existenciaMaterial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExistenciaMaterial $existenciaMaterial)
    {
        $this->validate($request, [
            'dimension_largo' => 'required|numeric',
            'dimension_ancho' => 'numeric',
            'valor_unit' => 'required|numeric',
            'valor_total2' => 'required|numeric',
            'estado_consumo' => 'required',
            'origen' => 'required',
            'deposito_id' => 'required'
            
        ]);

        if($request->input('valor_total2') == '0.00'){
            $valor = 0;
        }else
        {
            $valor = $request->input('valor_total2');
        }

        //return $request;

        $existenciaMaterial->update([
            'dimension_largo' => $request->input('dimension_largo'),
            'dimension_ancho' => $request->input('dimension_ancho'),
            'valor_unit' => $request->input('valor_unit'),
            'valor_total' => $valor,
            'estado_consumo' => $request->input('estado_consumo'),
            'origen' => $request->input('origen'),
            'deposito_id' => $request->input('deposito_id'),
            'detalle_origen' => $request->input('detalle_origen'),

        ]);

        $deposito = Deposito::where('id' ,$request->input('deposito_id'))->first();
        //return $deposito->existencia_material;
        if($deposito->existencia_material->whereBetween('estado_consumo', [1,2])->count() > 0){
            $deposito->update([
                'estado_utilizada' => 1,
            ]);
        }else{
            $deposito->update([
                'estado_utilizada' => null,
            ]);
        }


        return redirect()->route('admin.existencia_material.edit',$existenciaMaterial)->withFlashSuccess('Los datos del corte de material han sido actualizado');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExistenciaMaterial  $existenciaMaterial
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExistenciaMaterial $existenciaMaterial)
    {
        //
    }

    
    public function dataAjax(Request $request)
    {
       $term = trim($request->q);
//  "%{$term}%"
       $tags = Material::query()
        ->where('estado_consumo', '=', 1);
    
        $formatted_tags = [];
        foreach ($tags as $tag) {
            $formatted_tags[] = [
                 'id' => $tag->id_existencia,
                 'text' => $tag->material . ' ('. $tag->dimensionado. 'mm) -'.$tag->proveedor. ' ' .$tag->id_existencia . ' '.$tag->id_material ,
                 'dimension_largo' => $tag->dimension_largo,
                 'diam_interior' => $tag->diam_interior,
                 'espesor' => $tag->espesor, 
                 'valor_kg' => $tag->valor_kg,
                 'densidad' => $tag->densidad,
                 'perfil' => $tag->perfil             
                ];
        }
        return \Response::json($formatted_tags);
    }  


    public function getDatosTrozado(Request $request){

        $trozo = ExistenciaMaterial::where('id', '=', $request->trozado_id)->first();

        $material = Material::where('id', '=', $trozo->material_id)->first();

        return response()->json([
            'id' => $material->id,
            'text' => $material->material . '-'.$material->proveedor,
            'diam_exterior' => $material->diam_exterior,
            'diam_interior' => $material->diam_interior,
            'espesor' => $material->espesor, 
            'valor_kg' => $material->valor_kg,
            'densidad' => $material->densidad,
            'perfil' => $material->perfil  ,
            'sistema_medida' => $material->sistema_medida ,
            'dimensionado' => $material->dimensionado, 
            'dimensionado_corte' => $trozo->dimension_largo.'x'.$trozo->dimension_ancho,
            'valor_kg_corte' => $trozo->valor_unit    
   
            ]); 
    }

}
