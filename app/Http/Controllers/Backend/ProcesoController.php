<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Proceso;
use App\ProcesoHasMaquina;
use Illuminate\Http\Request;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Backend\Model\ProcesoRepository;

class ProcesoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $procesoRepository;

    public function __construct(ProcesoRepository $procesoRepository)
    {
        $this->procesoRepository = $procesoRepository;
    }


    public function index()
    {
        return view('backend.procesos.index')
        ->withProcesos($this->procesoRepository->getActivePaginated(25, 'codigo', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.procesos.create');
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
            'codigo' => 'required|unique:procesos',
            'descripcion' => 'required',
            
        ]);

        $maquinas = $request->input('maquinas',[]);
             
        $proceso= Proceso::create([
            'codigo' => $request->input('codigo'),
            'descripcion' => $request->input('descripcion'),
            'tipo_valorizacion' => $request->input('tipo_valorizacion'),
            'valor_unitario' => $request->input('valor_unitario')
                       
          ]);

          foreach($maquinas as $maquina){
            ProcesoHasMaquina::create([
                'proceso_id' => $proceso->id,
                'maquina_id' => $maquina,

            ]);
        }


          return redirect()->route('admin.procesos.edit',$proceso)->withFlashSuccess('Clasificación de proceso registrada'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proceso  $proceso
     * @return \Illuminate\Http\Response
     */
    public function show(Proceso $proceso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proceso  $proceso
     * @return \Illuminate\Http\Response
     */
    public function edit(Proceso $proceso)
    {
        return view('backend.procesos.edit', compact('proceso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proceso  $proceso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proceso $proceso)
    {
        $this->validate($request, [
            'codigo' => 'required',
            'descripcion' => 'required',
            
        ]);

        $maquinas = $request->input('maquinas',[]);
             
        $proceso->update([
            'codigo' => $request->input('codigo'),
            'descripcion' => $request->input('descripcion'),
            'tipo_valorizacion' => $request->input('tipo_valorizacion'),
            'valor_unitario' => $request->input('valor_unitario')
                       
          ]);

          foreach($maquinas as $maquina){

            $aux = ProcesoHasMaquina::where('proceso_id' ,'=', $proceso->id)->where('maquina_id','=',$maquina)->first();
            if($aux == null)
                {
                    ProcesoHasMaquina::create([
                        'maquina_id' => $maquina,
                        'proceso_id' => $proceso->id,
                        

                    ]);
                }
            }

        foreach($proceso->proceso_has_maquina as $promaqs){
            $cont = 0;

            foreach($maquinas as $maquina){
                if($promaqs->maquina_id == $maquina){
                    $cont++;
                }
            }
            if($cont == 0){
                $promaqs->delete();
            }
           
        }

          return redirect()->route('admin.procesos.edit',$proceso)->withFlashSuccess('Clasificación de proceso ha sido editada'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proceso  $proceso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proceso $proceso)
    {
        $proceso->delete();
        return redirect()->route('admin.procesos.index')->withFlashSuccess('Clasificación de proceso eliminada'); 

    }

    public function getValorProceso(Request $request)
    {

        $proceso = Proceso::find($request->proceso_id);

        return response()->json([
                
            'tipo_valorizacion'=> $proceso->tipo_valorizacion,
            'valor_unitario' => $proceso->valor_unitario
            
   
            ]);
    }

}
