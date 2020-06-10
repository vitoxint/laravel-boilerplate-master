<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\EtapaItemOt;
use App\Proceso;
use App\OrdenTrabajo;
use App\ItemOt;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class EtapaItemOtController extends Controller
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
    public function create(ItemOt $item_ot)
    {
        $procs = Proceso::orderBy('codigo')->get();
        return view('backend.etapa_itemots.create2',compact('item_ot','procs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request ,ItemOt $item_ot )
    {

        $this->validate($request, [
            'proceso_id' => 'required',
            'maquina_id' => 'required',
            'proceso_id' => 'required',
            'fh_limiten' => 'required',   
            
        ]);

        $trabajo = $item_ot->ordenTrabajo;

        $fecha = Carbon::now();
        $mfecha = $fecha->month;
        $dfecha = $fecha->day;
        $afecha = $fecha->year;  
        
        $maxPr = EtapaItemOt::max('id');

        $limite = new Carbon( $request->input('fh_limiten'));
        $limite = $limite->format('Y-m-d H:i:s');

        $entregaOt0 = new Carbon( $trabajo->entrega_estimada);
        $entregaOt0 = $entregaOt0->addDays(1);
        $entregaOt1 = $entregaOt0->format('d-m-Y H:i');
        $entregaOt2 = $entregaOt0->format('Y-m-d H:i:s');

        //return $limite .' / '.$entregaOt2;

        if($limite > $entregaOt2){
            return redirect()->back()->withFlashDanger(__('La fecha estimada de termino del proceso no puede ser mayor a la fecha de entrega estimada del trabajo que es el '.$entregaOt1));

        }

        $proc_id = Proceso::find($request->input('proceso_id'));
 
           $proceso = EtapaItemOt::create([
            'itemot_id' => $item_ot->id,
            'codigo' => $proc_id->codigo.'/'.$maxPr,
            'detalle' => $request->input('detalle'),
            'fh_limite'=> $limite,
            'proceso_id' => $request->input('proceso_id'),
            'maquina_id' => $request->input('maquina_id'),
            'empleado_id' => $request->input('operador_id'),
            'tiempo_asignado' => $request->input('tiempo_asignado'),
            'estado_avance' => 1 ,
                       
        ]);  

        return redirect()->route('admin.item_ots.edit',[$item_ot, $item_ot->ordenTrabajo])->withFlashSuccess(__('Proceso agregado'));

     if($proceso != null){
            return response()->json([
                
                'success'=> 'true',
                'mensaje' => 'Proceso agregado'
                
       
                ]); 

                /* $item_ot = ItemOt::find($request->id);
                $trabajo = $item_ot->ordenTrabajo;
                $procs = Proceso::orderBy('codigo')->get(); */

                //return view('backend.item_ots.edit', compact('item_ot','trabajo','procs'));
            }
            else{
                return response()->json([
                    'success'=> 'false',
                    'mensaje' => 'Faltan datos'
                    
           
                    ]); 
            }
   


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EtapaItemOt  $etapaItemOt
     * @return \Illuminate\Http\Response
     */
    public function show(EtapaItemOt $etapaItemOt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EtapaItemOt  $etapaItemOt
     * @return \Illuminate\Http\Response
     */
    public function edit(EtapaItemOt $etapaItemOt)
    {
        $procs = Proceso::orderBy('codigo')->get();
        return view('backend.etapa_itemots.edit', compact('etapaItemOt','procs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EtapaItemOt  $etapaItemOt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EtapaItemOt $etapaItemOt)
    {
        $this->validate($request, [
            'proceso_id' => 'required',
            'maquina_id' => 'required',
            'proceso_id' => 'required',
            'estado_avance' => 'required'
     
        ]);
        $item_ot = $etapaItemOt->itemOt;
        $trabajo = $item_ot->ordenTrabajo;

        $limite = new Carbon( $request->input('fh_limiten'));
        $limite = $limite->format('Y-m-d H:i:s');

        $entregaOt = new Carbon( $trabajo->entrega_estimada);
        $entregaOt1 = $entregaOt->addDays(1);
        $entregaOt2 = $entregaOt1->format('d-m-Y H:i');

        if($limite > new Carbon($entregaOt1)){
            return redirect()->back()->withFlashDanger(__('La fecha estimada de termino del proceso no puede ser mayor a la fecha de entrega estimada del trabajo que es el '.$entregaOt));

        }

        $estado_proceso_nuevo = $request->input('estado_avance');

        if($estado_proceso_nuevo == 2 && $etapaItemOt->estado_avance == 1){
                $fecha_inicio = Carbon::now();
                $fecha_inicio = $fecha_inicio->format('Y-m-d H:i:s'); 
        }else{
               $fecha_inicio = $etapaItemOt->fh_inicio;
        }

        if($estado_proceso_nuevo == 4  && ($etapaItemOt->estado_avance == 3 || $etapaItemOt->estado_avance == 2 )){
                $fecha_termino = Carbon::now();
                $fecha_termino = $fecha_termino->format('Y-m-d H:i:s'); 
        }else{
               $fecha_termino = null;
        } 

 
           $etapaItemOt->update([
            'itemot_id' => $item_ot->id,
            'detalle' => $request->input('detalle'),
            'fh_limite'=> $limite,
            'proceso_id' => $request->input('proceso_id'),
            'maquina_id' => $request->input('maquina_id'),
            'empleado_id' => $request->input('operador_id'),
            'tiempo_asignado' => $request->input('tiempo_asignado'),
            'estado_avance' => $request->input('estado_avance'),
            'fh_inicio' => $fecha_inicio,
            'fh_termino' => $fecha_termino,
                       
        ]); 
// CONSULTAS DE ACTUALIZACION DE ESTADOS SUPERIORES CASO ITEM OT

        if (EtapaItemOt::where('estado_avance', '=', 2)->where('itemot_id', '=', $item_ot->id)->exists()) {
            $update1 = DB::table('item_ots')
              ->where('id', '=', $item_ot->id)
              ->update([
                  'estado' =>  '2',
                  ]);

            if($item_ot->estado == '1'){
                $update1 = DB::table('item_ots')
                   ->where('id', '=', $item_ot->id)
                   ->update([
                       'fecha_inicio' =>  $fecha_inicio,
                       ]);                
            }
            
         }
        
        if (EtapaItemOt::where('estado_avance', '=', 4)->where('itemot_id', '=', $item_ot->id)->count('id') == 
                EtapaItemOt::where('itemot_id', '=', $item_ot->id)->count('id')) {
            
            $update1 = DB::table('item_ots')
              ->where('id', '=', $item_ot->id)
              ->update([
                  'estado' =>  '4',
                  ]);
            if($item_ot->estado != '4'){
                $update1 = DB::table('item_ots')
                   ->where('id', '=', $item_ot->id)
                   ->update([
                       'fecha_termino' =>  $fecha_termino,
                       ]);                
            }
            
         } 

// CONSULTAS DE ACTUALIZACION DE ESTADOS SUPERIORES CASO ORDEN TRABAJO


        if (ItemOt::where('estado', '=', '2')->where('ot_id', '=', $item_ot->ordenTrabajo->id)->exists()) {
            $update1 = DB::table('orden_trabajos')
            ->where('id', '=', $item_ot->ordenTrabajo->id)
            ->update([
                'estado' =>  '2',
                ]);

            if($item_ot->ordenTrabajo->estado == '1'){
                $update1 = DB::table('orden_trabajos')
                ->where('id', '=', $item_ot->ordenTrabajo->id)
                ->update([
                    'fecha_inicio' =>  $fecha_inicio,
                    ]);                
            }
            
        }

        if (ItemOt::where('estado', '=', '4')->where('ot_id', '=', $item_ot->ordenTrabajo->id)->count('id') == 
                ItemOt::where('ot_id', '=', $item_ot->ordenTrabajo->id)->count('id')) {
            
            $update1 = DB::table('orden_trabajos')
            ->where('id', '=', $item_ot->ordenTrabajo->id)
            ->update([
                'estado' =>  '4',
                ]);
            if($item_ot->ordenTrabajo->estado != '4'){
                $update1 = DB::table('orden_trabajos')
                ->where('id', '=', $item_ot->ordenTrabajo->id)
                ->update([
                    'fecha_termino' =>  $fecha_termino,
                    ]);                
            }
            
        } 


 
/*          if (ItemOt::where('estado', '=', '5')->where('ot_id', '=', $trabajo->id)->count('id') == 
             ItemOt::where('ot_id', '=', $trabajo->id)->count('id')) {
         
                $update1 = DB::table('orden_trabajos')
                ->where('id', '=', $trabajo->id)
                ->update([
                    'estado' =>  '5',
                ]); }  */      


        return redirect()->route('admin.item_ots.edit',[$item_ot, $item_ot->ordenTrabajo])->withFlashSuccess(__('Proceso actualizado'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EtapaItemOt  $etapaItemOt
     * @return \Illuminate\Http\Response
     */
    public function destroy(EtapaItemOt $etapaItemOt)
    {
        $aux = $etapaItemOt;
        $item_ot = $aux->itemOt;
        $trabajo = $item_ot->ordenTrabajo;

        $etapaItemOt->delete();

        $procs = Proceso::orderBy('codigo')->get();

        //return view('backend.item_ots.edit', compact('item_ot','trabajo','procs'));
        return redirect()->back()->withFlashSuccess('Se ha eliminado el proceso');
    }
}
