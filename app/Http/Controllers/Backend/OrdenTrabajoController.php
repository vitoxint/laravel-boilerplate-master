<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\OrdenTrabajo;
use App\ItemOt;
use App\ImagenItemOt;
use App\PagoOt;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Backend\Model\OrdenTrabajoRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Mail\Backend\SendOtAtrasada;
use App\Mail\Backend\SendOrdenTrabajo;
use Illuminate\Support\Facades\Mail;
use PDF;

use App\Exports\OrdenTrabajosExport;
use Maatwebsite\Excel\Facades\Excel;


class OrdenTrabajoController extends Controller
{


   
    protected $ordenTrabajoRepository;

    public function __construct(OrdenTrabajoRepository $ordenTrabajoRepository)
    {
          // Middleware only applied to these methods
        /*   $this->middleware('permission:administrar ordenes de trabajo', ['only' => [
            'index' // Could add bunch of more methods too
        ]]); */

        $this->middleware('permission:administrar ordenes de trabajo');


        $this->ordenTrabajoRepository = $ordenTrabajoRepository;
    }

    public function index()
    {
        $ot_count = OrdenTrabajo::get()->count('id');
        $count_si = OrdenTrabajo::where('estado','1')->get()->count('id');
        $count_ep = OrdenTrabajo::where('estado','2')->get()->count('id');
        $count_at = OrdenTrabajo::where('estado','3')->get()->count('id');
        $count_te = OrdenTrabajo::where('estado','4')->get()->count('id');
        $count_en = OrdenTrabajo::where('estado','5')->get()->count('id');

        return view('backend.orden_trabajos.index')
        ->withOrdenTrabajos($this->ordenTrabajoRepository->getActivePaginated(50, 'id', 'desc'))->with( 
                                                                                                        ['ot_count'=> $ot_count, 
                                                                                                         'count_si'=> $count_si,
                                                                                                         'count_ep'=> $count_ep,
                                                                                                         'count_at'=> $count_at,
                                                                                                         'count_te'=> $count_te,
                                                                                                         'count_en'=> $count_en ]);
    }

    public function exportarxls(){
        return Excel::download(new OrdenTrabajosExport, 'trabajos.xlsx');
    }

    public function getOtsOfMonthGraph(){

        $fecha = Carbon::now();
        $mfecha = $fecha->format('m');
        //$dfecha = $fecha->day;
        $afecha = $fecha->format('Y');
        
        $dia1= $afecha . '-'.$mfecha .'-1' ;
        $dian= $afecha . '-'.$mfecha .'-1' ;
 
            $oStart = new Carbon($dia1);

            
            //$oStart = $dia1;
            $oEnd = new Carbon($dian);
            $oEnd = $oEnd->addMonth(1);

             //aux prueba 

            /*  $oStart = $oStart->addMonth(-2);
             $oEnd = $oEnd->addMonth(-2); */
             

             //fin auxiliar

             $aData = array() ;
             //$numOts = array() ;

            while ($oStart < $oEnd) {
                
                //array_push($aDates ,$oStart->format('d'));
                //$aDates = $aDates . '/'.$oStart->format('d');
                //$aDates[$i] = $oStart->format('d');

                $otsI = OrdenTrabajo::whereBetween('fecha_inicio' , [$oStart, $oStart])->get('id')
                ->count('id');
                $otsT = OrdenTrabajo::whereBetween('fecha_termino' , [$oStart, $oStart])->get('id')
                ->count('id');

                array_push($aData, [ 'day' => $oStart->format('d'), 'otsI' => $otsI, 'otsT' => $otsT]);
               // $numOts = $numOts .'/'.$ots;
                
                $oStart = $oStart->addDay(1); 
                
            }
            $oStart = $oStart->addMonth(-1);
            $mes = $oStart->translatedFormat('F Y');

            return response()->json([
                'data'=> $aData,
                'mes' => $mes,
               
                ]); 



    }


    public function getOtsOfMonthIngresosGraph(){

        $fecha = Carbon::now();
        $mfecha = $fecha->format('m');
        //$dfecha = $fecha->day;
        $afecha = $fecha->format('Y');
        
        $dia1= $afecha . '-'.$mfecha .'-1' ;
        $dian= $afecha . '-'.$mfecha .'-1' ;
 
            $oStart = new Carbon($dia1);

            
            //$oStart = $dia1;
            $oEnd = new Carbon($dian);
            $oEnd = $oEnd->addMonth(1);

             //aux prueba 

            /*  $oStart = $oStart->addMonth(-2);
             $oEnd = $oEnd->addMonth(-2); */
             

             //fin auxiliar

             $aData = array() ;
             //$numOts = array() ;

            while ($oStart < $oEnd) {
                
                //array_push($aDates ,$oStart->format('d'));
                //$aDates = $aDates . '/'.$oStart->format('d');
                //$aDates[$i] = $oStart->format('d');

                $otsI = OrdenTrabajo::where('fecha_termino' ,'<=', $oStart)->get('valor_total')
                ->sum('valor_total');

                $otsP = PagoOt::where('fecha_abono' , '<=', $oStart)->get('monto')
                ->sum('monto');

                $otsC = (float)$otsP   -  (float)$otsI * 1.19;

                array_push($aData, [ 'day' => $oStart->format('d'), 'otsI' => $otsI, 'otsP' => $otsP , 'otsC' => $otsC]);
               // $numOts = $numOts .'/'.$ots;
                
                $oStart = $oStart->addDay(1); 
                
            }
            $oStart = $oStart->addMonth(-1);
            $mes = $oStart->translatedFormat('F Y');

            return response()->json([
                'data'=> $aData,
                'mes' => $mes,
               
                ]); 

    }


    public function getGraphStatusMes(){

        Carbon::setLocale('es');

        $fecha = Carbon::now();
        $mfecha = $fecha->format('m');
        //$dfecha = $fecha->day;
        $afecha = $fecha->format('Y');
        
        $dia1= $afecha . '-'.$mfecha .'-1' ;
        $dian= $afecha . '-'.$mfecha .'-1' ;
            $firstDay = new Carbon($dia1);
 
            $oStart = new Carbon($dia1);

            
            //$oStart = $dia1;
            $oEnd = new Carbon($dian);
            $oEnd = $oEnd->addMonth(1);

             //aux prueba 

            /*   $oStart = $oStart->addMonth(-2);
             $oEnd = $oEnd->addMonth(-2); */ 
             

             //fin auxiliar

             $aData = array() ;
             //$numOts = array() ;

            while ($oStart < $oEnd) {
                
                //array_push($aDates ,$oStart->format('d'));
                //$aDates = $aDates . '/'.$oStart->format('d');
                //$aDates[$i] = $oStart->format('d');

                if(($oStart->dayOfWeek != 6 )&&($oStart->dayOfWeek != 0 )){

                    $otsSI = OrdenTrabajo::where('created_at' ,'<=', $oStart)->where('estado',1)->get()
                    ->count('id');

                    $otsEP = OrdenTrabajo::where('fecha_inicio' ,'<=', $oStart)->where('estado',2)->get('id')
                    ->count('id');

                    $otsAT = OrdenTrabajo::where('created_at' ,'<=', $oStart)->where('estado',3)->get('id')
                    ->count('id');

                    $otsTE = OrdenTrabajo::where('fecha_termino' , '<=', $oStart)->where('estado',4)->get('id')
                    ->count('id');

                    $otsEN= OrdenTrabajo::where('fecha_termino' , '<=', $oStart)->where('estado',5)->whereBetween('created_at',[$firstDay,$oStart])->get('id')
                    ->count('id');

                    if($oStart <= $fecha){
                        array_push($aData, [
                            'day'  => $oStart->format('d'), 
                            'otsSI' => $otsSI, 
                            'otsEP' => $otsEP, 
                            'otsAT' => $otsAT,
                            'otsTE' => $otsTE,
                            'otsEN' => $otsEN
                            
                            
                        ]);
                    }
                    else{
                        array_push($aData, [
                            'day'  => $oStart->format('d'), 
                            'otsSI' => 0, 
                            'otsEP' => 0, 
                            'otsTE' => 0,
                            'otsEN' => 0
                                                    
                        ]);
                    }
                // $numOts = $numOts .'/'.$ots;
                    }
                    
                    $oStart = $oStart->addDay(1); 
                
            }


            $oStart = $oStart->addMonth(-1);

            $mes = $oStart->translatedFormat('F Y');

            return response()->json([
                'data'=> $aData,
                'mes' => $mes,
               
                ]); 


    }


    public function getGanttOtsMes(){

        $fecha = Carbon::now();
        $mfecha = $fecha->format('m');
        //$dfecha = $fecha->day;
        $afecha = $fecha->format('Y');
        
        $dia1= $afecha . '-'.$mfecha .'-1' ;
        $dian= $afecha . '-'.$mfecha .'-1' ;
        $firstDay = new Carbon($dia1);

        $oStart = new Carbon($dia1);
        
        //$oStart = $dia1;
        $oEnd = new Carbon($dian);
        $oEnd = $oEnd->addMonth(1);

            //aux prueba 

        /*   $oStart = $oStart->addMonth(-2);
            $oEnd = $oEnd->addMonth(-2); */ 
            
            //fin auxiliar

            $aRow = array() ;
            $aItem = array();

            //$numOts = array() ;

        $ots = OrdenTrabajo::where('created_at' ,'<=', $oStart)->whereBetween('estado',[1,5])->get();
                    

/*                     $otsEP = OrdenTrabajo::where('fecha_inicio' ,'<=', $oStart)->where('estado',2)->get('id')
                    ->count('id');

                    $otsAT = OrdenTrabajo::where('created_at' ,'<=', $oStart)->where('estado',3)->get('id')
                    ->count('id');

                    $otsTE = OrdenTrabajo::where('fecha_termino' , '<=', $oStart)->where('estado',4)->get('id')
                    ->count('id');

                    $otsEN= OrdenTrabajo::where('fecha_termino' , '<=', $oStart)->where('estado',5)->whereBetween('created_at',[$firstDay,$oStart])->get('id')
                    ->count('id'); */

            //$oStart = $oStart->addMonth(-1);
            $mes = $oStart->format('M-Y');

            $labels = array();

            $count = 0;

            foreach($ots as $ot){
                //$str = 'gsgsgs';

                array_push($aRow, [ $ot->folio => [
                    'id'  => $ot->folio, 
                    'label' => $ot->cliente->razon_social, ]
               
                  ] );

                array_push($aItem , [ $ot->folio => [
                    'id'  => $ot->folio, 
                    'rowId'  => $ot->folio,
                    'label' => $ot->cliente->razon_social, 
                    'time' => [
                        'start' => $ot->created_at,
                        'end' => $ot->entrega_estimada,
                    ],
                    
                    //'estado' => $ot->estado  
                     ]
                    
                ]);
                $count++;
            }

            return response()->json([
                'aRow'=> $aRow,
                'mes' => $mes,
                'aItem' => $aItem,
            
               
                ]); 


    }




    public function buscar_ot(Request $request)
    {

        $ot_count = OrdenTrabajo::get()->count('id');
        $count_si = OrdenTrabajo::where('estado','1')->get()->count('id');
        $count_ep = OrdenTrabajo::where('estado','2')->get()->count('id');
        $count_at = OrdenTrabajo::where('estado','3')->get()->count('id');
        $count_te = OrdenTrabajo::where('estado','4')->get()->count('id');
        $count_en = OrdenTrabajo::where('estado','5')->get()->count('id');

        $term = $request->input('buscar');
        return view('backend.orden_trabajos.index')
        ->withOrdenTrabajos($this->ordenTrabajoRepository->getBuscarOtPaginated(25, 'id', 'desc', $term))->with( 
            ['ot_count'=> $ot_count, 
             'count_si'=> $count_si,
             'count_ep'=> $count_ep,
             'count_at'=> $count_at,
             'count_te'=> $count_te,
             'count_en'=> $count_en ]);
    }

    public function anuladas()
    {
        $ot_count = OrdenTrabajo::get()->count('id');
        $count_si = OrdenTrabajo::where('estado','1')->get()->count('id');
        $count_ep = OrdenTrabajo::where('estado','2')->get()->count('id');
        $count_at = OrdenTrabajo::where('estado','3')->get()->count('id');
        $count_te = OrdenTrabajo::where('estado','4')->get()->count('id');
        $count_en = OrdenTrabajo::where('estado','5')->get()->count('id');

        return view('backend.orden_trabajos.index')
        ->withOrdenTrabajos($this->ordenTrabajoRepository->getAnuladasPaginated(25, 'id', 'desc'))->with( 
            ['ot_count'=> $ot_count, 
             'count_si'=> $count_si,
             'count_ep'=> $count_ep,
             'count_at'=> $count_at,
             'count_te'=> $count_te,
             'count_en'=> $count_en ]);
    }


    public function entregadas()
    {

        $ot_count = OrdenTrabajo::get()->count('id');
        $count_si = OrdenTrabajo::where('estado','1')->get()->count('id');
        $count_ep = OrdenTrabajo::where('estado','2')->get()->count('id');
        $count_at = OrdenTrabajo::where('estado','3')->get()->count('id');
        $count_te = OrdenTrabajo::where('estado','4')->get()->count('id');
        $count_en = OrdenTrabajo::where('estado','5')->get()->count('id');

        return view('backend.orden_trabajos.index')
        ->withOrdenTrabajos($this->ordenTrabajoRepository->getPendientesPaginated(25, 'id', 'desc'))->with( 
            ['ot_count'=> $ot_count, 
             'count_si'=> $count_si,
             'count_ep'=> $count_ep,
             'count_at'=> $count_at,
             'count_te'=> $count_te,
             'count_en'=> $count_en ]);
    }

    public function pendientes()
    {
        $ot_count = OrdenTrabajo::get()->count('id');
        $count_si = OrdenTrabajo::where('estado','1')->get()->count('id');
        $count_ep = OrdenTrabajo::where('estado','2')->get()->count('id');
        $count_at = OrdenTrabajo::where('estado','3')->get()->count('id');
        $count_te = OrdenTrabajo::where('estado','4')->get()->count('id');
        $count_en = OrdenTrabajo::where('estado','5')->get()->count('id');

        return view('backend.orden_trabajos.index')
        ->withOrdenTrabajos($this->ordenTrabajoRepository->getEntregadasPaginated(50, 'entrega_estimada', 'ASC'))->with( 
            ['ot_count'=> $ot_count, 
             'count_si'=> $count_si,
             'count_ep'=> $count_ep,
             'count_at'=> $count_at,
             'count_te'=> $count_te,
             'count_en'=> $count_en ]);
    }

    public function sin_iniciar()
    {

        $ot_count = OrdenTrabajo::get()->count('id');
        $count_si = OrdenTrabajo::where('estado','1')->get()->count('id');
        $count_ep = OrdenTrabajo::where('estado','2')->get()->count('id');
        $count_at = OrdenTrabajo::where('estado','3')->get()->count('id');
        $count_te = OrdenTrabajo::where('estado','4')->get()->count('id');
        $count_en = OrdenTrabajo::where('estado','5')->get()->count('id');

        return view('backend.orden_trabajos.index')
        ->withOrdenTrabajos($this->ordenTrabajoRepository->getSinIniciarPaginated(25, 'entrega_estimada', 'ASC'))->with( 
            ['ot_count'=> $ot_count, 
             'count_si'=> $count_si,
             'count_ep'=> $count_ep,
             'count_at'=> $count_at,
             'count_te'=> $count_te,
             'count_en'=> $count_en ]);
    }

    public function en_proceso()
    {

        $ot_count = OrdenTrabajo::get()->count('id');
        $count_si = OrdenTrabajo::where('estado','1')->get()->count('id');
        $count_ep = OrdenTrabajo::where('estado','2')->get()->count('id');
        $count_at = OrdenTrabajo::where('estado','3')->get()->count('id');
        $count_te = OrdenTrabajo::where('estado','4')->get()->count('id');
        $count_en = OrdenTrabajo::where('estado','5')->get()->count('id');

        return view('backend.orden_trabajos.index')
        ->withOrdenTrabajos($this->ordenTrabajoRepository->getEnProcesoPaginated(25, 'entrega_estimada', 'ASC'))->with( 
            ['ot_count'=> $ot_count, 
             'count_si'=> $count_si,
             'count_ep'=> $count_ep,
             'count_at'=> $count_at,
             'count_te'=> $count_te,
             'count_en'=> $count_en ]);
    }

    public function atrasadas()
    {
        $ot_count = OrdenTrabajo::get()->count('id');
        $count_si = OrdenTrabajo::where('estado','1')->get()->count('id');
        $count_ep = OrdenTrabajo::where('estado','2')->get()->count('id');
        $count_at = OrdenTrabajo::where('estado','3')->get()->count('id');
        $count_te = OrdenTrabajo::where('estado','4')->get()->count('id');
        $count_en = OrdenTrabajo::where('estado','5')->get()->count('id');

        return view('backend.orden_trabajos.index')
        ->withOrdenTrabajos($this->ordenTrabajoRepository->getAtrasadasPaginated(25, 'entrega_estimada', 'ASC'))->with( 
            ['ot_count'=> $ot_count, 
             'count_si'=> $count_si,
             'count_ep'=> $count_ep,
             'count_at'=> $count_at,
             'count_te'=> $count_te,
             'count_en'=> $count_en ]);
    }

    public function terminadas()
    {
        $ot_count = OrdenTrabajo::get()->count('id');
        $count_si = OrdenTrabajo::where('estado','1')->get()->count('id');
        $count_ep = OrdenTrabajo::where('estado','2')->get()->count('id');
        $count_at = OrdenTrabajo::where('estado','3')->get()->count('id');
        $count_te = OrdenTrabajo::where('estado','4')->get()->count('id');
        $count_en = OrdenTrabajo::where('estado','5')->get()->count('id');

        return view('backend.orden_trabajos.index')
        ->withOrdenTrabajos($this->ordenTrabajoRepository->getTerminadasPaginated(25, 'entrega_estimada', 'ASC'))->with( 
            ['ot_count'=> $ot_count, 
             'count_si'=> $count_si,
             'count_ep'=> $count_ep,
             'count_at'=> $count_at,
             'count_te'=> $count_te,
             'count_en'=> $count_en ]);
    }

    public function px_entregas($dias)
    {
        $ot_count = OrdenTrabajo::get()->count('id');
        $count_si = OrdenTrabajo::where('estado','1')->get()->count('id');
        $count_ep = OrdenTrabajo::where('estado','2')->get()->count('id');
        $count_at = OrdenTrabajo::where('estado','3')->get()->count('id');
        $count_te = OrdenTrabajo::where('estado','4')->get()->count('id');
        $count_en = OrdenTrabajo::where('estado','5')->get()->count('id');

        return view('backend.orden_trabajos.index')
        ->withOrdenTrabajos($this->ordenTrabajoRepository->getProximasEntregasPaginated(25, 'entrega_estimada', 'ASC', $dias))->with( 
            ['ot_count'=> $ot_count, 
             'count_si'=> $count_si,
             'count_ep'=> $count_ep,
             'count_at'=> $count_at,
             'count_te'=> $count_te,
             'count_en'=> $count_en ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.orden_trabajos.create');
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
            'cliente_id' => 'required',
            //'representante_id' => 'required',
            'entrega_estimada' => 'required',
        ]);

        $fecha = Carbon::now();
        $mfecha = $fecha->month;
        $dfecha = $fecha->day;
        $afecha = $fecha->year;  
        
        $maxOt = OrdenTrabajo::max('id');
        $entrega_estimada = new Carbon($request->entrega_estimada);
        $entrega_estimada = $entrega_estimada->format('Y-m-d');

        $trabajo= OrdenTrabajo::create([
            'cliente_id' => $request->input('cliente_id'),
            'representante_id' => $request->input('representante_id'),
            'cotizacion' => $request->input('cotizacion'),
            'orden_compra' => $request->input('orden_compra'),
            
            'estado' => '1',
            'estado_pago' => 1 , 
            'folio' => $maxOt.'/'.$afecha,
            'user_id' => Auth::user()->id, 
            'entrega_estimada' => $entrega_estimada,
            'valor_total' => 0,
            
          ]);

    return redirect()->route('admin.orden_trabajos.edit',$trabajo)->withFlashSuccess('Orden de trabajo registrada | puedes agregar ítems');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdenTrabajo $trabajo)
    {
        //$ordenTrabajo = $trabajo;
        //return view('backend.orden_trabajos.mail.send_ot_noentregadas',compact('ordenTrabajo'));
        //Mail::send(new SendOtAtrasada($trabajo));
        return view('backend.orden_trabajos.edit',compact('trabajo'));
    }

    public function opencode(Request $request){

        $string = str_replace(
            array('-', "'"),
            array('/', '-'),
            $request->input('codigo_id')
        );

        $item_ot    = ItemOt::where('folio', $string)->first();

        if($item_ot){

            $trabajo = $item_ot->ordenTrabajo;

            return view('backend.orden_trabajos.edit',compact('trabajo'));

        }

        return redirect()->route('admin.orden_trabajos.index')->withFlashDanger('No se encontró una OT con el folio del ítem escaneado');


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdenTrabajo $trabajo)
    {
        $this->validate($request, [
            
            //'estado' => 'required',
            'entrega_estimada' => 'required',
        ]);

        $entrega_estimada = new Carbon($request->entrega_estimada);
        $hoy = Carbon::now();
        $estado_nuevo = $trabajo->estado;

        $estado_ant = $trabajo->estado;
        if(($estado_ant == '3')&&($entrega_estimada >= $hoy )){
            if($trabajo->fecha_inicio){
                $estado_nuevo = '2';
            }else{
                $estado_nuevo = '1';
            }
                           
        }


        $entrega_estimada = $entrega_estimada->format('Y-m-d');

        $trabajo->update(
            [                    
                'cotizacion' => $request->input('cotizacion'),
                'orden_compra' => $request->input('orden_compra'),
                'factura' => $request->input('factura'),
                'estado' => $estado_nuevo,
                'entrega_estimada' => $entrega_estimada,
                'representante_id' => $request->input('representante_id'),
            ]
        );

        return redirect()->route('admin.orden_trabajos.edit',$trabajo)->withFlashSuccess('Orden de trabajo actualizada');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdenTrabajo $trabajo)
    {
        ItemOt::where('ot_id' ,'=', $trabajo->id)->delete();

        $trabajo->delete();

        return redirect()->route('admin.orden_trabajos.index')->withFlashSuccess('Orden de trabajo eliminada');
    }

    public function printCliente(OrdenTrabajo $trabajo){

        $usuario = $trabajo->usuario;
        $pdf = PDF::loadView('backend.orden_trabajos.printcliente', compact('trabajo','usuario'));
  
        return $pdf->stream('0rdenTrabajo_'.$trabajo->folio.'.pdf');
    }

    public function printTaller(OrdenTrabajo $trabajo){
       // return 'Funcionalidad pendiente , para control interno';
        $usuario = $trabajo->usuario;
        $pdf = PDF::loadView('backend.orden_trabajos.printTaller', compact('trabajo','usuario'));
  
        return $pdf->stream('OrdenTrabajo_'.$trabajo->folio.'.pdf');
    }


    public function printTallerOp(OrdenTrabajo $trabajo){
        // return 'Funcionalidad pendiente , para control interno';
         //$usuario = $trabajo->usuario;
         //$pdf = PDF::loadView('backend.orden_trabajos.printTaller', compact('trabajo','usuario'));
   
         //return $pdf->stream('OrdenTrabajo_'.$trabajo->folio.'.pdf');
         return view('backend.orden_trabajos.preImpresionTaller',compact('trabajo'));
     }

     public function printTallerOpExportar(Request $request ,OrdenTrabajo $trabajo){

        //return $request->all();


       // return $request->input('img',[]);
        $id_img = $request->input('img',[]);

        $imagenes = ImagenItemOt::whereIn('id' , $id_img)->get();

       // return $imagenes; 

        $usuario = $trabajo->usuario;
        $pdf = PDF::loadView('backend.orden_trabajos.printTaller', compact('trabajo','usuario', 'imagenes'));
  
        return $pdf->stream('OrdenTrabajo_'.$trabajo->folio.'.pdf');
        //return $request->team;

     }









    public function send(OrdenTrabajo $trabajo){

        Mail::send(new SendOrdenTrabajo($trabajo));

        return redirect()->back()->withFlashSuccess(__('Orden de Trabajo enviada'));

    }


    public function get_calendario_ot(){

        //$start = $request->start;

        //$end = $request->end;

 
         //$ots = OrdenTrabajo::whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->get('folio as title' , 'created_at as start' , 'entrega_estimada as end');
            $ots = OrdenTrabajo::get();

        //$data = array();

        $data = array();

         foreach( $ots as $ot ) {
            array_push($data, [
                'id'    => $ot->id,
                'title' => '[ '. $ot->folio .' ]'.  $ot->cliente->razon_social,
                'start' => $ot->fecha_inicio,
                'end'   => $ot->entrega_estimada
                ]
        );
        } 
        
        //return $data;

  /*              
         return response()->json([
             
           'data' =>  $data
        
         ]); */

         return response()->json([
             
            'data' =>  $data
         
          ]);
    
        
    }

    public function calendario_ot(){
        return view('backend.orden_trabajos.calendario');
    }


}
