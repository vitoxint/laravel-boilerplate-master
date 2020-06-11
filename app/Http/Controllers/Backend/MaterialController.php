<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Backend\Model\MaterialRepository;

use App\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $materialRepository;

    public function __construct(MaterialRepository $materialRepository)
    {
        $this->materialRepository = $materialRepository;
    }


    public function index()
    {
        return view('backend.materiales.index')
        ->withMateriales($this->materialRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.materiales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'codigo' => 'required',
            'perfil' => 'required',
            'sistema_medida' => 'required',
            'densidad' => 'required|numeric',
            'valor_kg' => 'required|numeric',
            
        ]);

        $material= Material::create([
            'codigo' => $request->input('codigo'),
            'perfil' => $request->input('perfil'),
            'sistema_medida' => $request->input('sistema_medida'),
            'densidad' => $request->input('densidad'),
            'valor_kg' => $request->input('valor_kg'),
            'diam_exterior' => $request->input('diam_exterior'),
            'diam_interior' => $request->input('diam_interior'),
            'espesor' => $request->input('espesor'),
            
          ]);
        
          return redirect()->route('admin.materiales.edit',$material)->withFlashSuccess('El material ha sido registrado'); 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        return view('backend.materiales.edit', compact('material')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        $this->validate($request, [
            'codigo' => 'required',
            'perfil' => 'required',
            'sistema_medida' => 'required',
            'densidad' => 'required|numeric',
            'valor_kg' => 'required|numeric',
            
        ]);

        $material->update([
            'codigo' => $request->input('codigo'),
            'perfil' => $request->input('perfil'),
            'sistema_medida' => $request->input('sistema_medida'),
            'densidad' => $request->input('densidad'),
            'valor_kg' => $request->input('valor_kg'),
            'diam_exterior' => $request->input('diam_exterior'),
            'diam_interior' => $request->input('diam_interior'),
            'espesor' => $request->input('espesor'),
            
          ]);
        
          return redirect()->route('admin.materiales.edit',$material)->withFlashSuccess('Los datos del material han sido actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        //
    }
}
