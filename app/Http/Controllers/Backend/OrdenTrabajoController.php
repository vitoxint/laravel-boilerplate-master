<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\OrdenTrabajo;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Backend\Model\OrdenTrabajoRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrdenTrabajoController extends Controller
{
   
    protected $ordenTrabajoRepository;

    public function __construct(OrdenTrabajoRepository $ordenTrabajoRepository)
    {
        $this->ordenTrabajoRepository = $ordenTrabajoRepository;
    }

    public function index()
    {

        return view('backend.orden_trabajos.index')
        ->withOrdenTrabajos($this->ordenTrabajoRepository->getActivePaginated(25, 'id', 'asc'));
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

        return redirect()->route('admin.orden_trabajos.index')->withFlashSuccess('Orden de trabajo actualizada');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
