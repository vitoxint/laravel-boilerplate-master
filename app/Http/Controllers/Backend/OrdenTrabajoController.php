<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\OrdenTrabajo;
use App\ItemOt;
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

        return view('backend.orden_trabajos.index')
        ->withOrdenTrabajos($this->ordenTrabajoRepository->getActivePaginated(25, 'id', 'desc'));
    }

    public function anuladas()
    {

        return view('backend.orden_trabajos.index')
        ->withOrdenTrabajos($this->ordenTrabajoRepository->getAnuladasPaginated(25, 'id', 'desc'));
    }


    public function entregadas()
    {

        return view('backend.orden_trabajos.index')
        ->withOrdenTrabajos($this->ordenTrabajoRepository->getPendientesPaginated(25, 'id', 'desc'));
    }

    public function pendientes()
    {
        return view('backend.orden_trabajos.index')
        ->withOrdenTrabajos($this->ordenTrabajoRepository->getEntregadasPaginated(25, 'entrega_estimada', 'ASC'));
    }

    public function px_entregas($dias)
    {

        return view('backend.orden_trabajos.index')
        ->withOrdenTrabajos($this->ordenTrabajoRepository->getProximasEntregasPaginated(25, 'entrega_estimada', 'ASC', $dias));
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
            
            'estado' => 'required',
            'entrega_estimada' => 'required',
        ]);

        $entrega_estimada = new Carbon($request->entrega_estimada);
        $entrega_estimada = $entrega_estimada->format('Y-m-d');

        $trabajo->update(
            [                    
                'cotizacion' => $request->input('cotizacion'),
                'orden_compra' => $request->input('orden_compra'),
                'estado' => $request->input('estado'),
                'entrega_estimada' => $entrega_estimada,
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
  
        return $pdf->stream('0rdenTrabajo_'.$trabajo->folio.'.pdf');
    }

    public function send(OrdenTrabajo $trabajo){

        Mail::send(new SendOrdenTrabajo($trabajo));

        return redirect()->back()->withFlashSuccess(__('Orden de Trabajo enviada'));

    }
}
