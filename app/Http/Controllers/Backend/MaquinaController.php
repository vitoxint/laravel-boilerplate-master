<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Backend\Model\MaquinaRepository;

use App\Maquina;
use Illuminate\Http\Request;

class MaquinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $maquinaRepository;

    public function __construct(MaquinaRepository $maquinaRepository)
    {
        $this->maquinaRepository = $maquinaRepository;
    }

    public function index()
    {
        return view('backend.maquinas.index')
        ->withMaquinas($this->maquinaRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.maquinas.create');
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
            'codigo' => 'required|unique:maquinas',
            'nombre' => 'required',
            'estado' => 'required'
            
        ]);
             
        $maquina= Maquina::create([
            'codigo' => $request->input('codigo'),
            'nombre' => $request->input('nombre'),
            'especificaciones' => $request->input('especificaciones'),
            'estado' => $request->input('estado'),
                       
          ]);

          return redirect()->route('admin.maquinas.edit',$maquina)->withFlashSuccess('La máquina ha sido registrada'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Maquina  $maquina
     * @return \Illuminate\Http\Response
     */
    public function show(Maquina $maquina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Maquina  $maquina
     * @return \Illuminate\Http\Response
     */
    public function edit(Maquina $maquina)
    {
        return view('backend.maquinas.edit', compact('maquina'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Maquina  $maquina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Maquina $maquina)
    {
        $this->validate($request, [
            'codigo' => 'required',
            'nombre' => 'required',
            'estado' => 'required'
            
        ]);
             
        $maquina->update([
            'codigo' => $request->input('codigo'),
            'nombre' => $request->input('nombre'),
            'especificaciones' => $request->input('especificaciones'),
            'estado' => $request->input('estado'),
                       
          ]);

          return redirect()->route('admin.maquinas.edit',$maquina)->withFlashSuccess('La información de la máquina ha sido editada'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Maquina  $maquina
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maquina $maquina)
    {
        $maquina->delete();
        return redirect()->route('admin.maquinas.index')->withFlashSuccess('La máquina ha sido eliminada de los registros');  
    }
}
