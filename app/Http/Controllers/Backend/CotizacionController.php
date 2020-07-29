<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Cotizacion; 
use App\ItemCotizacion;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Backend\Model\CotizacionRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Mail\Backend\SendCotizacion;
use Illuminate\Support\Facades\Mail;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

use PDF;

class CotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $cotizacionRepository;

    public function __construct(CotizacionRepository $cotizacionRepository)
    {
        $this->cotizacionRepository = $cotizacionRepository;
    }


    public function index()
    {

        return view('backend.cotizaciones.index')
        ->withCotizaciones($this->cotizacionRepository->getActivePaginated(25, 'id', 'desc'));
    }

    public function vigentes()
    {

        return view('backend.cotizaciones.index')
        ->withCotizaciones($this->cotizacionRepository->getVigentesPaginated(25, 'id', 'desc'));
    }

    public function aceptadas()
    {

        return view('backend.cotizaciones.index')
        ->withCotizaciones($this->cotizacionRepository->getAceptadasPaginated(25, 'id', 'desc'));
    }

    public function buscar_cotizacion(Request $request)
    {
        $term = $request->input('buscar');
        return view('backend.cotizaciones.index')
        ->withCotizaciones($this->cotizacionRepository->getBuscarCotizacionPaginated(25, 'id', 'desc', $term));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.cotizaciones.create');
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
            'empresa' => 'required',
            'dias_validez' => 'required|numeric',
            
        ]);

        $fecha = Carbon::now();
        $mfecha = $fecha->month;
        $dfecha = $fecha->day;
        $afecha = $fecha->year;  
        
        $maxCt = Cotizacion::max('id');
        
        $cotizacion= Cotizacion::create([
            'empresa' => $request->input('empresa'),
            'contacto' => $request->input('contacto'),
            'telefono_contacto' => $request->input('telefono_contacto'),
            'email_contacto' => $request->input('email_contacto'),
            'estado' => '1',
            'condicion_pago' => $request->input('condicion_pago'),
            'forma_pago' => $request->input('forma_pago'),
            'folio' => $maxCt.'/'.$afecha,
            'dias_validez' => $request->input('dias_validez'),
            'user_id' => Auth::user()->id, 
            'valor_neto' => 0,
            'observaciones' => $request->input('observaciones'),
            
          ]);
        
    return redirect()->route('admin.cotizaciones.edit',$cotizacion)->withFlashSuccess('Cotizacion registrada | puedes agregar ítems');        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function print(Cotizacion $cotizacion)
    {

        $usuario = $cotizacion->usuario;
        $pdf = PDF::loadView('backend.cotizaciones.print', compact('cotizacion','usuario'));
  
        return $pdf->stream('cotizacion_'.$cotizacion->folio.'.pdf');
    }

    public function send(Cotizacion $cotizacion){

        Mail::send(new SendCotizacion($cotizacion));

        return redirect()->back()->withFlashSuccess(__('Cotización enviada'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Cotizacion $cotizacion)
    {
        return view('backend.cotizaciones.edit',compact('cotizacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cotizacion $cotizacion)
    {

        $this->validate($request, [
            'empresa' => 'required',
            'dias_validez' => 'required|numeric',
            'estado' => 'required'
            
        ]);


        $cotizacion->update(
            [                    
                'empresa' => $request->input('empresa'),
                'contacto' => $request->input('contacto'),
                'telefono_contacto' => $request->input('telefono_contacto'),
                'email_contacto' => $request->input('email_contacto'),
                'estado' => $request->input('estado'),
                'condicion_pago' => $request->input('condicion_pago'),
                'forma_pago' => $request->input('forma_pago'),
                'dias_validez' => $request->input('dias_validez'),
                'observaciones' => $request->input('observaciones'),
            ]
        );

        return redirect()->route('admin.cotizaciones.edit',$cotizacion)->withFlashSuccess('Información de la cotización está actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cotizacion $cotizacion)
    {
        ItemCotizacion::where('cotizacion_id' ,'=', $cotizacion->id)->delete();

        $cotizacion->delete();

        return redirect()->route('admin.cotizaciones.index')->withFlashSuccess('Cotizacion eliminada');
    }
}
