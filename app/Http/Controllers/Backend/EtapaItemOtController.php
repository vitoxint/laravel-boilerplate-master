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

use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Backend\Model\EtapaItemOtRepository;

use App\Exports\EtapaItemOtExport;
use Maatwebsite\Excel\Facades\Excel;

class EtapaItemOtController extends Controller
{
 
    protected $etapaItemOtRepository;

    public function __construct(EtapaItemOtRepository $etapaItemOtRepository)
    {
        $this->etapaItemOtRepository = $etapaItemOtRepository;
    }

    public function index()
    {
        $et_count = EtapaItemOt::get()->count('id');
        $count_si = EtapaItemOt::where('estado_avance',1)->get()->count('id');
        $count_ep = EtapaItemOt::where('estado_avance',2)->get()->count('id');
        $count_at = EtapaItemOt::where('estado_avance',3)->get()->count('id');
        $count_te = EtapaItemOt::where('estado_avance',4)->get()->count('id');
       

        return view('backend.etapa_itemots.index')
        ->withEtapaOts($this->etapaItemOtRepository->getActivePaginated(50, 'estado_avance', 'asc'))->with( 
                                                                                                        ['et_count'=> $et_count, 
                                                                                                         'count_si'=> $count_si,
                                                                                                         'count_ep'=> $count_ep,
                                                                                                         'count_at'=> $count_at,
                                                                                                         'count_te'=> $count_te
                                                                                                          ]);
    }

    public function sin_iniciar()
    {
        $et_count = EtapaItemOt::get()->count('id');
        $count_si = EtapaItemOt::where('estado_avance',1)->get()->count('id');
        $count_ep = EtapaItemOt::where('estado_avance',2)->get()->count('id');
        $count_at = EtapaItemOt::where('estado_avance',3)->get()->count('id');
        $count_te = EtapaItemOt::where('estado_avance',4)->get()->count('id');
       

        return view('backend.etapa_itemots.index')
        ->withEtapaOts($this->etapaItemOtRepository->getSinIniciarPaginated(50, 'fh_limite', 'asc'))->with( 
                                                                                                        ['et_count'=> $et_count, 
                                                                                                         'count_si'=> $count_si,
                                                                                                         'count_ep'=> $count_ep,
                                                                                                         'count_at'=> $count_at,
                                                                                                         'count_te'=> $count_te
                                                                                                          ]);
    }

    public function en_proceso()
    {

        $et_count = EtapaItemOt::get()->count('id');
        $count_si = EtapaItemOt::where('estado_avance',1)->get()->count('id');
        $count_ep = EtapaItemOt::where('estado_avance',2)->get()->count('id');
        $count_at = EtapaItemOt::where('estado_avance',3)->get()->count('id');
        $count_te = EtapaItemOt::where('estado_avance',4)->get()->count('id');
       

        return view('backend.etapa_itemots.index')
        ->withEtapaOts($this->etapaItemOtRepository->getEnProcesoPaginated(50, 'fh_limite', 'asc'))->with( 
                                                                                                        ['et_count'=> $et_count, 
                                                                                                         'count_si'=> $count_si,
                                                                                                         'count_ep'=> $count_ep,
                                                                                                         'count_at'=> $count_at,
                                                                                                         'count_te'=> $count_te
                                                                                                          ]);
    }

    public function atrasadas()
    {
        $et_count = EtapaItemOt::get()->count('id');
        $count_si = EtapaItemOt::where('estado_avance',1)->get()->count('id');
        $count_ep = EtapaItemOt::where('estado_avance',2)->get()->count('id');
        $count_at = EtapaItemOt::where('estado_avance',3)->get()->count('id');
        $count_te = EtapaItemOt::where('estado_avance',4)->get()->count('id');
       

        return view('backend.etapa_itemots.index')
        ->withEtapaOts($this->etapaItemOtRepository->getAtrasadaPaginated(50, 'fh_limite', 'asc'))->with( 
                                                                                                        ['et_count'=> $et_count, 
                                                                                                         'count_si'=> $count_si,
                                                                                                         'count_ep'=> $count_ep,
                                                                                                         'count_at'=> $count_at,
                                                                                                         'count_te'=> $count_te
                                                                                                          ]);
    }

    public function terminadas()
    {
        $et_count = EtapaItemOt::get()->count('id');
        $count_si = EtapaItemOt::where('estado_avance',1)->get()->count('id');
        $count_ep = EtapaItemOt::where('estado_avance',2)->get()->count('id');
        $count_at = EtapaItemOt::where('estado_avance',3)->get()->count('id');
        $count_te = EtapaItemOt::where('estado_avance',4)->get()->count('id');
       

        return view('backend.etapa_itemots.index')
        ->withEtapaOts($this->etapaItemOtRepository->getTerminadaPaginated(50, 'fh_limite', 'asc'))->with( 
                                                                                                        ['et_count'=> $et_count, 
                                                                                                         'count_si'=> $count_si,
                                                                                                         'count_ep'=> $count_ep,
                                                                                                         'count_at'=> $count_at,
                                                                                                         'count_te'=> $count_te
                                                                                                          ]);
    }


    public function exportarxls(){

        return Excel::download(new EtapaItemOtExport, 'procesosTrabajos.xlsx');

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
            'fh_limiten' => 'required',  
            'valor_unitario' =>'required|numeric',
            'cantidad' => 'required|numeric',
            'valor_proceso' => 'required|numeric',  

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
            'itemot_id'       => $item_ot->id,
            'codigo'          => $proc_id->codigo.'/'.$maxPr,
            'detalle'         => $request->input('detalle'),
            'fh_limite'       => $limite,
            'proceso_id'      => $request->input('proceso_id'),
            'maquina_id'      => $request->input('maquina_id'),
            //'empleado_id' => $request->input('operador_id'),
            'valor_unitario'  => $request->input('valor_unitario'),
            'cantidad'        => $request->input('cantidad'),
            'valor_proceso'   => $request->input('valor_proceso'),
            'tiempo_asignado' => $request->input('tiempo_asignado'),
            'estado_avance'   => 1 ,
                       
        ]);


        $etapas_iniciadas = EtapaItemOt::where('estado_avance',2)->orWhere('estado_avance', 4)->where('itemot_id', $item_ot->id)->count('id');

        if( ($etapas_iniciadas > 0) && ($item_ot->estado != '3') && ($item_ot->estado != '5') ){
         
            $item_ot->update([
                'estado'        => 2,
                'fecha_termino' => NULL,
            ]);

            $item_ot->ordenTrabajo->update([
                'estado'        => 2,
                'fecha_termino' => NULL,
            ]);

        }
        

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

    public function comenzar(EtapaItemOt $etapaItemOt){
 
        $estado_proceso_nuevo = 2;

        $item_ot = $etapaItemOt->itemOt;
        $estado_item_anterior = $item_ot->estado;
        $trabajo = $item_ot->ordenTrabajo;

        if($estado_proceso_nuevo == 2 && $etapaItemOt->estado_avance == 1){
                $fecha_inicio = Carbon::now();
                $fecha_inicio = $fecha_inicio->format('Y-m-d H:i:s'); 
        }else{
               $fecha_inicio = $etapaItemOt->fh_inicio;
        }

        $etapaItemOt->update([

            'estado_avance' => 2,
            'fh_inicio' => $fecha_inicio,
                                 
        ]);

        // CONSULTAS DE ACTUALIZACION DE ESTADOS SUPERIORES CASO ITEM OT

        if (EtapaItemOt::where('estado_avance', '=', 2)->where('itemot_id', '=', $item_ot->id)->exists()) {
            $update1 = DB::table('item_ots')
              ->where('id', '=', $item_ot->id)
              ->update([
                  'estado' =>  '2',
                  ]);

            if($estado_item_anterior == 1){
                $update1 = DB::table('item_ots')
                   ->where('id', '=', $item_ot->id)
                   ->update([
                       'fecha_inicio' =>  $fecha_inicio,
                       ]);                
            }           
         }

        // CONSULTAS DE ACTUALIZACION DE ESTADOS SUPERIORES CASO ORDEN TRABAJO

        $estado_ot_anterior = $item_ot->ordenTrabajo->estado;

        if (ItemOt::where('estado', '=', '2')->where('ot_id', '=', $item_ot->ordenTrabajo->id)->exists()) {
            $update1 = DB::table('orden_trabajos')
            ->where('id', '=', $item_ot->ordenTrabajo->id)
            ->update([
                'estado' =>  '2',
                ]);

            if($estado_ot_anterior == 1){
                $update1 = DB::table('orden_trabajos')
                ->where('id', '=', $item_ot->ordenTrabajo->id)
                ->update([
                    'fecha_inicio' =>  $fecha_inicio,
                    ]);                
            }
            
        } 

        return redirect()->route('admin.item_ots.edit',[$item_ot, $item_ot->ordenTrabajo])->withFlashSuccess(__('Proceso actualizado'));       
    }

  
    public function terminar(EtapaItemOt $etapaItemOt){

        $item_ot = $etapaItemOt->itemOt;
        $trabajo = $item_ot->ordenTrabajo;

        $estado_proceso_nuevo = 4;

        if($estado_proceso_nuevo == 4  && ($etapaItemOt->estado_avance == 3 || $etapaItemOt->estado_avance == 2 )){
                $fecha_termino = Carbon::now();
                $fecha_termino = $fecha_termino->format('Y-m-d H:i:s'); 
        }else{
               $fecha_termino = null;
        } 

        $etapaItemOt->update([

            'estado_avance' => 4,
            'fh_termino' => $fecha_termino,
                                 
        ]);

        // CONSULTAS DE ACTUALIZACION DE ESTADOS SUPERIORES CASO ITEM OT

        $estado_item_anterior = $item_ot->estado;

        if (EtapaItemOt::where('estado_avance', '=', 4)->where('itemot_id', '=', $item_ot->id)->count('id') == 
                EtapaItemOt::where('itemot_id', '=', $item_ot->id)->count('id')) {
            
            $update1 = DB::table('item_ots')
              ->where('id', '=', $item_ot->id)
              ->update([
                  'estado' =>  '4',
                  ]);
            if($estado_item_anterior != 4){
                $update1 = DB::table('item_ots')
                   ->where('id', '=', $item_ot->id)
                   ->update([
                       'fecha_termino' =>  $fecha_termino,
                ]);                
            }
            
         } 

// CONSULTAS DE ACTUALIZACION DE ESTADOS SUPERIORES CASO ORDEN TRABAJO

        $estado_ot_anterior = $item_ot->ordenTrabajo->estado;

        if (ItemOt::where('estado', '=', '4')->where('ot_id', '=', $item_ot->ordenTrabajo->id)->count('id') == 
                ItemOt::where('ot_id', '=', $item_ot->ordenTrabajo->id)->count('id')) {
            
            $update1 = DB::table('orden_trabajos')
            ->where('id', '=', $item_ot->ordenTrabajo->id)
            ->update([
                'estado' =>  '4',
                ]);
            if($estado_ot_anterior != 4){
                $update1 = DB::table('orden_trabajos')
                ->where('id', '=', $item_ot->ordenTrabajo->id)
                ->update([
                    'fecha_termino' =>  $fecha_termino,
                    ]);                
            }
            
        } 
        return redirect()->route('admin.item_ots.edit',[$item_ot, $item_ot->ordenTrabajo])->withFlashSuccess(__('Proceso actualizado'));


    }




    public function comenzarTaller(EtapaItemOt $etapaItemOt){
 
        $estado_proceso_nuevo = 2;
        $estado_item_anterior = $item_ot->estado;

        $item_ot = $etapaItemOt->itemOt;
        $trabajo = $item_ot->ordenTrabajo;

        if($estado_proceso_nuevo == 2 && $etapaItemOt->estado_avance == 1){
                $fecha_inicio = Carbon::now();
                $fecha_inicio = $fecha_inicio->format('Y-m-d H:i:s'); 
        }else{
               $fecha_inicio = $etapaItemOt->fh_inicio;
        }

        $etapaItemOt->update([

            'estado_avance' => 2,
            'fh_inicio' => $fecha_inicio,
                                 
        ]);

        // CONSULTAS DE ACTUALIZACION DE ESTADOS SUPERIORES CASO ITEM OT

        if (EtapaItemOt::where('estado_avance', '=', 2)->where('itemot_id', '=', $item_ot->id)->exists()) {
            $update1 = DB::table('item_ots')
              ->where('id', '=', $item_ot->id)
              ->update([
                  'estado' =>  '2',
                  ]);

            if($estado_item_anterior == 1){
                $update1 = DB::table('item_ots')
                   ->where('id', '=', $item_ot->id)
                   ->update([
                       'fecha_inicio' =>  $fecha_inicio,
                       ]);                
            }           
         }

        // CONSULTAS DE ACTUALIZACION DE ESTADOS SUPERIORES CASO ORDEN TRABAJO

        $estado_ot_anterior = $item_ot->ordenTrabajo->estado;

        if (ItemOt::where('estado', '=', '2')->where('ot_id', '=', $item_ot->ordenTrabajo->id)->exists()) {
            $update1 = DB::table('orden_trabajos')
            ->where('id', '=', $item_ot->ordenTrabajo->id)
            ->update([
                'estado' =>  '2',
                ]);

            if($estado_ot_anterior == 1){
                $update1 = DB::table('orden_trabajos')
                ->where('id', '=', $item_ot->ordenTrabajo->id)
                ->update([
                    'fecha_inicio' =>  $fecha_inicio,
                    ]);                
            }
            
        } 

        return redirect()->route('admin.item_ots.editTaller',[$item_ot, $item_ot->ordenTrabajo])->withFlashSuccess(__('Proceso actualizado'));       
    }

  
    public function terminarTaller(EtapaItemOt $etapaItemOt){

        $item_ot = $etapaItemOt->itemOt;
        $trabajo = $item_ot->ordenTrabajo;

        $estado_proceso_nuevo = 4;

        if($estado_proceso_nuevo == 4  && ($etapaItemOt->estado_avance == 3 || $etapaItemOt->estado_avance == 2 )){
                $fecha_termino = Carbon::now();
                $fecha_termino = $fecha_termino->format('Y-m-d H:i:s'); 
        }else{
               $fecha_termino = null;
        } 

        $etapaItemOt->update([

            'estado_avance' => 4,
            'fh_termino' => $fecha_termino,
                                 
        ]);

        // CONSULTAS DE ACTUALIZACION DE ESTADOS SUPERIORES CASO ITEM OT

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
        return redirect()->route('admin.item_ots.editTaller',[$item_ot, $item_ot->ordenTrabajo])->withFlashSuccess(__('Proceso actualizado'));


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
            'estado_avance' => 'required',
            'valor_unitario' =>'required|numeric',
            'cantidad' => 'required|numeric',
            'valor_proceso' => 'required|numeric',  
     
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
            //'empleado_id' => $request->input('operador_id'),
            'valor_unitario' => $request->input('valor_unitario'),
            'cantidad' => $request->input('cantidad'),
            'valor_proceso' => $request->input('valor_proceso'),
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

        if(($etapaItemOt->estado_avance == 1)||($etapaItemOt->estado_avance == 1)){

            $etapaItemOt->delete();

            //ITEM
            $ep = EtapaItemOt::where('itemot_id', $item_ot->id)->where('estado_avance' , 2)->count('id');
            $te = EtapaItemOt::where('itemot_id', $item_ot->id)->where('estado_avance', 4)->count('id');
            $to = EtapaItemOt::where('itemot_id', $item_ot->id)->count('id');

            $fecha_termino = Carbon::now();
            $fecha_termino = $fecha_termino->format('Y-m-d');

            if(($to == $te)&&($to > 0)){
                $item_ot->estado = '4';
                $item_ot->fecha_termino = $fecha_termino;
                $item_ot->save();
            }

            if(($ep > 0 )&&($te < $to)){
                $item_ot->estado = '2';
                $item_ot->save();
            }

            //OT
            $item_ep = ItemOt::where('ot_id', $trabajo->id)->where('estado' , '2')->count('id');
            $item_te = ItemOt::where('ot_id', $trabajo->id)->where('estado' , '4')->count('id');
            $item_to = ItemOt::where('ot_id', $trabajo->id)->count('id');



            if(($item_to == $item_te)&&($item_to > 0)){
                $trabajo->estado = '4';
                $trabajo->fecha_termino = $fecha_termino;
                $trabajo->save();
            }

            if(($item_ep > 0 )&&($item_te < $item_to)){
                $trabajo->estado = '2';
                $trabajo->save();
            }


            return redirect()->back()->withFlashSuccess('Se ha eliminado el proceso');

        }else{

     
            return redirect()->back()->withFlashSuccess('No se puede eliminar el proceso porque ya está confirmado o terminado');


        }

            

        



        $procs = Proceso::orderBy('codigo')->get();

        //return view('backend.item_ots.edit', compact('item_ot','trabajo','procs'));
        return redirect()->back()->withFlashSuccess('Se ha eliminado el proceso');
    }
}
