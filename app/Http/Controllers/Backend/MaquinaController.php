<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Backend\Model\MaquinaRepository;

use App\Maquina;
use App\MaquinaHasOperador;
use App\Proceso;
use App\ProcesoHasMaquina;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

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

        $operadores = $request->input('operadores',[]);

             
        $maquina= Maquina::create([
            'codigo' => $request->input('codigo'),
            'nombre' => $request->input('nombre'),
            //'valor_hora'=> $request->input('valor_hora'),
            //'especificaciones' => $request->input('especificaciones'),
            'estado' => $request->input('estado'),
                       
        ]);

/*         foreach($operadores as $operador){
            MaquinaHasOperador::create([
                'empleado_id' => $operador,
                'maquina_id' => $maquina->id,

            ]);
        } */


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

        //$operadores = $request->input('operadores',[]);  
                    
        $maquina->update([
            'codigo' => $request->input('codigo'),
            'nombre' => $request->input('nombre'),
           // 'valor_hora'=> $request->input('valor_hora'),
           //'especificaciones' => $request->input('especificaciones'),
            'estado' => $request->input('estado'),
                       
          ]);

        
/*           foreach($operadores as $operador){

            $aux = MaquinaHasOperador::where('maquina_id' ,'=', $maquina->id)->where('empleado_id','=',$operador)->first();
            if($aux == null)
                {
                    MaquinaHasOperador::create([
                        'empleado_id' => $operador,
                        'maquina_id' => $maquina->id,

                    ]);
                }
            }

        foreach($maquina->maquina_has_operador as $maqops){
            $cont = 0;

            foreach($operadores as $operador){
                if($maqops->empleado_id == $operador){
                    $cont++;
                }
            }
            if($cont == 0){
                $maqops->delete();
            }
           
        } */

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



    public function dataAjax(Request $request)
    {
       $term = trim($request->q);

       $tags = Maquina::query()
        ->where('nombre', 'LIKE', "%{$term}%")->orWhere('codigo', 'LIKE', "%{$term}%") 
        ->get();
        $formatted_tags = [];
        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->codigo .': '.$tag->nombre];
        }
        return \Response::json($formatted_tags);
    }

    public function getMaquinaList(Request $request)
    {

       /*  return  $maquinas = DB::table('maquinas')
            ->leftjoin('proceso_has_maquinas', function ($join) {
                $join->on('maquina_id', '=', 'maquinas.id');
                    
            })->where('proceso_has_maquinas.proceso_id',  $request->proceso_id)
            ->where('maquinas.estado', '=', '1')->orWhere('maquinas.estado', '=', '3')
            ->pluck(DB::raw("CONCAT(codigo,' - ',nombre) AS name"),"maquinas.id"); */

            $procesos = ProcesoHasMaquina::where('proceso_id',$request->proceso_id)->get();

            $maquinas = Maquina::join("proceso_has_maquinas","maquinas.id","=","proceso_has_maquinas.maquina_id")
            ->where('proceso_has_maquinas.proceso_id', '=', $request->proceso_id )
            //->where('users.estado','=',1)
            ->pluck('maquinas.nombre', 'maquinas.id');

            return $maquinas;

            //return $procesos->maquina->pluck(DB::raw("CONCAT(codigo,' - ',nombre) AS name"),"maquinas.id");



        //return response()->json($maquinas);

    }


    public function getDisponibilidad(Request $request){

        $maquina = Maquina::where('id' , $request->maquina_id)->first();

        $num_procesos = $maquina->etapaItemOt->whereIn('estado_avance',[2,3])->where('fh_inicio', '!=' ,null)->count('id');
        $num_procesosAt = $maquina->etapaItemOt->whereIn('estado_avance',[3])->where('fh_inicio', '!=' ,null)->count('id');

        $respuesta = "Disponible en este momento";

        if(($num_procesos > 0)&&($num_procesosAt > 0)){
            $f_limit = new Carbon($maquina->etapaItemOt->whereIn('estado_avance',[2,3])->where('fh_inicio', '!=' ,null)->max('fh_limite') );
            
            $respuesta = 'La máquina tiene '.$num_procesos. ' proceso/s en ejecución y '.$num_procesosAt .' proceso/s atrasado y estará disponible a partir del '. $f_limit->format('d/m/Y H:i');

        }

        if(($num_procesos > 0)&&($num_procesosAt == 0)){
            $f_limit = new Carbon($maquina->etapaItemOt->whereIn('estado_avance',[2])->where('fh_inicio', '!=' ,null)->max('fh_limite') );
            
            $respuesta = 'La máquina tiene '.$num_procesos. ' proceso en ejecución y estará disponible a partir del '. $f_limit->format('d/m/Y H:i');

        }

        if(($num_procesos == $num_procesosAt)&&($num_procesos > 0)){
            $f_limit = new Carbon($maquina->etapaItemOt->whereIn('estado_avance',[3])->where('fh_inicio', '!=' ,null)->max('fh_limite') );
            
            $respuesta = 'La máquina tiene ' .$num_procesosAt .' proceso/s atrasado y el ultimo deberia haber terminado el '. $f_limit->format('d/m/Y H:i');

        }
        
        
       

        return response()->json([
            'respuesta'    => $respuesta,
                                      
            ]); 

    }
}
