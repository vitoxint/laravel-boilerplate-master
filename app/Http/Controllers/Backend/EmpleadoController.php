<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Backend\Model\EmpleadoRepository;
use Freshwork\ChileanBundle\Rut;

use App\Empleado;
use App\Maquina;
use App\MaquinaHasOperador;
use Illuminate\Http\Request;
use Str;
use DB;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $empleadoRepository;

    public function __construct(EmpleadoRepository $empleadoRepository)
    {
        $this->empleadoRepository = $empleadoRepository;
    }

    public function index()
    {
        return view('backend.empleados.index')
        ->withEmpleados($this->empleadoRepository->getActivePaginated(25, 'codigo', 'asc'));
    }

    public function buscar_operadores(Request $request)
    {

        $term = $request->input('buscar');

        return view('backend.empleados.index')
            ->withEmpleados($this->empleadoRepository->getBuscarOperadoresPaginated(25, 'codigo', 'asc',$term));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.empleados.create');
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
            'rut' => 'required|unique:empleados|cl_rut',
            'nombres' => 'required',

        ]);

        if($request->input('estado_activo')){
            $estado_activo = 1;
        }else{
            $estado_activo = 0;
        }

        $codigo =  substr(str_replace( ['.','-'], '', $request->input('rut')), 0, -1); 
         
        $empleado= Empleado::create([
            'rut' => $request->input('rut'),
            'codigo' => $codigo,
            'nombres' => $request->input('nombres'),
            'apellidos' => $request->input('apellidos'),
            'ocupacion' => $request->input('ocupacion'),
            'user_id' => $request->input('user_id'),
            'estado_activo' => $estado_activo,                      
          ]);

          return redirect()->route('admin.empleados.edit',$empleado)->withFlashSuccess('El operador ha sido registrado'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
        return view('backend.empleados.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {

        $this->validate($request, [
            'rut' => 'required|cl_rut',
            'nombres' => 'required',

        ]);

        if($request->input('estado_activo')){
            $estado_activo = 1;
        }else{
            $estado_activo = 0;
        }

        $codigo =  substr(str_replace( ['.','-'], '', $request->input('rut')), 0, -1); 
         
        $empleado->update([
            'rut' => $request->input('rut'),
            'codigo' => $codigo,
            'nombres' => $request->input('nombres'),
            'apellidos' => $request->input('apellidos'),
            'ocupacion' => $request->input('ocupacion'),
            'user_id' => $request->input('user_id'),
            'estado_activo' => $estado_activo,                      
          ]);

          return redirect()->route('admin.empleados.edit',$empleado)->withFlashSuccess('Los datos del operador han sido actualizados'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return redirect()->route('admin.empleados.index')->withFlashSuccess('Operador eliminado de los registros');        
    }

    public function dataAjax(Request $request)
    {
       $term = trim($request->q);

       $tags = Empleado::query()
        ->where('nombres', 'LIKE', "%{$term}%")->orWhere('apellidos', 'LIKE', "%{$term}%") 
        ->get();
        $formatted_tags = [];
        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->nombres .' '.$tag->apellidos];
        }
        return \Response::json($formatted_tags);
    }

    public function getOperadorList(Request $request)
    {

      return  $operadores = DB::table('empleados')
        ->leftjoin('maquina_has_operadors', function ($join) {
            $join->on('empleado_id', '=', 'empleados.id');
                 
        })->where('maquina_has_operadors.maquina_id',  $request->maquina_id)->pluck(DB::raw("CONCAT(nombres,' ',apellidos) AS name"),"empleados.id");

        return response()->json($operadores);

    }
}
