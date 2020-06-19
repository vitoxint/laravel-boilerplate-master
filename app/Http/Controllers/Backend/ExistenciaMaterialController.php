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
        ->withExistencias($this->existenciaMaterialRepository->getActivePaginated(25, 'id', 'desc'));
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
        //
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
        //
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
}
