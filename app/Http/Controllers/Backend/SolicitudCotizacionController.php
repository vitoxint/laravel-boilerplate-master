<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Backend\Model\SolicitudCotizacionRepository;

use App\SolicitudCotizacion;
use App\ItemSc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;
use App\Mail\Backend\SendRespuestaSolicitudCotizacion;
use Carbon\Carbon;

use PDF;

class SolicitudCotizacionController extends Controller
{
   
    protected $s_cotizacionRepository;

    public function __construct(SolicitudCotizacionRepository $s_cotizacionRepository)
    {
        $this->s_cotizacionRepository = $s_cotizacionRepository;
    }

    public function index()
    {

        return view('backend.s_cotizacion.index')
        ->withSolicitudCotizacions($this->s_cotizacionRepository->getActivePaginated(10, 'estado', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function ingresarApi(Request $request){

        $this->validate($request, [
            'name'   =>  'required',
            'email'   => 'required'    , 

        ]); 

        $solicitud = SolicitudCotizacion::create([
            'nombre_solicitante'  => $request->name,
            'email_solicitante'   => $request->email, 
            'telefono_solicitante'=> $request->phone,
            'mensaje'             => $request->message ,
            'estado'              => 1 ,

        ]);


        if($solicitud){
            $items = array();
            
            foreach( $request->get('items') as $aux){
                //array_push($items , $aux);
                $item = ItemSc::create([
                    'sc_id'       => $solicitud->id,
                    'producto_id' => $aux['id'],
                    'cantidad'    => $aux['ctd']

                ]);
            } 

            return response()->json([
                'respuesta'    => 'La solicitud ha sido ingresada, en tiempo breve responderemos a su solicitud , Atentamente Orecal Ltda',
                                          
                ]); 

        }
                                
        return response()->json([
            'respuesta'    => 'La solicitud no ha sido ingresada debido a un problema. Favor ingresarla nuevamente',
            
                      
            ]); 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SolicitudCotizacion  $solicitudCotizacion
     * @return \Illuminate\Http\Response
     */
    public function show(SolicitudCotizacion $solicitudCotizacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SolicitudCotizacion  $solicitudCotizacion
     * @return \Illuminate\Http\Response
     */
    public function edit(SolicitudCotizacion $cotizacion)
    {
        return view('backend.s_cotizacion.edit',compact('cotizacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SolicitudCotizacion  $solicitudCotizacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SolicitudCotizacion $cotizacion)
    {
        $this->validate($request, [
            'estado'   =>  'required',
            'validez'   => 'required|numeric'    , 

        ]); 

        $cotizacion->update([
            'estado' => $request->input('estado'),
            'validez' => $request->input('validez'),
            'mensaje_respuesta' => $request->input('mensaje_respuesta')

        ]);

        return redirect()->route('admin.s_cotizaciones.edit',$cotizacion)->withFlashSuccess('Se han actualizado los datos a la respuesta de solicitud de cotización');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SolicitudCotizacion  $solicitudCotizacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(SolicitudCotizacion $solicitudCotizacion)
    {
        //
    }


    public function print(SolicitudCotizacion $cotizacion)
    {

        $usuario = $cotizacion->usuario;
        $pdf = PDF::loadView('backend.s_cotizacion.print', compact('cotizacion','usuario'));
  
        return $pdf->stream('cotizacion_'.$cotizacion->id.'.pdf');
    }


    public function send(SolicitudCotizacion $cotizacion){

        $fecha = Carbon::now();

        $cotizacion->update([
            'fecha_envio' => $fecha,
            'estado'      => 3
        ]);


        Mail::send(new SendRespuestaSolicitudCotizacion($cotizacion));

        return redirect()->back()->withFlashSuccess(__('Cotización enviada'));

    }
}
