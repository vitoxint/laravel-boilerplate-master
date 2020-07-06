<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Backend\Model\ItemOtRepository;
use Illuminate\Http\Request;

use App\ItemOt;
use App\OrdenTrabajo;
use App\ImagenItemOt;
use App\EtapaItemOt;
use App\Proceso;
use DB;
use Carbon\Carbon;
use PDF;



class ItemOtController extends Controller
{

    protected $itemOtRepository;

    public function __construct(ItemOtRepository $itemOtRepository)
    {
        $this->itemOtRepository = $itemOtRepository;
        //$this->middleware('permission:administrar ordenes de trabajo');
            // Middleware only applied to these methods
            $this->middleware('permission:ver trabajos|administrar ordenes de trabajo', ['only' => [
                'index','editTaller','print_etq', 'opencode' // Could add bunch of more methods too
            ]]); 

            $this->middleware('permission:administrar ordenes de trabajo', ['only' => [
                'edit' ,'store' , 'update' ,'destroy' , 'opencode' // Could add bunch of more methods too
            ]]);

        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.item_ots.index')
        ->withItemOts($this->itemOtRepository->getActivePaginated(25, 'folio', 'desc'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(OrdenTrabajo $trabajo)
    {
        return view('backend.item_ots.create' ,compact('trabajo'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, OrdenTrabajo $trabajo)
    {
        $this->validate($request, [
            
            'descripcion' => 'required|min:3',
            'cantidad' => 'required|numeric',
            'valor_unitario' => 'required|numeric',
            'valor_parcial' => 'required|numeric',
            'especificaciones' => '',
            
        ]);   
    
        $ultimoItem  = ItemOt::where('ot_id', $trabajo->id)->max('id');
        
        if(!$ultimoItem){
            $folioNuevoItemOt = $trabajo->folio.'-1';
        }else{

        $itemAntecesor = ItemOt::find($ultimoItem);
        $ultimoItemFolio = substr($itemAntecesor->folio, strpos($itemAntecesor->folio, "-") + 1);   
      
        $folioNuevoItem = intval($ultimoItemFolio) + intval(1) ;
        $folioNuevoItemOt = $trabajo->folio.'-'.$folioNuevoItem;
        }

        $item = ItemOt::create([
           
            'descripcion'=>$request->get('descripcion'),
            'folio' => $folioNuevoItemOt,
            'cantidad'=> $request->get('cantidad'),
            'valor_unitario' => $request->get('valor_unitario'),
            'valor_parcial' => $request->get('valor_parcial'),
            'especificaciones' => $request->get('especificaciones'),
            'estado' => '1',          
            'ot_id' => $trabajo->id,

          ]);  
          
          $valor_total = $request->get('valor_parcial');

          $updates = DB::table('orden_trabajos')
          ->where('id', '=', $trabajo->id)
          ->update([
              'valor_total' => $trabajo->valor_total + $valor_total,
              
              ]);

              return redirect()->route('admin.orden_trabajos.edit',$trabajo)->withFlashSuccess('Se ha agregado un nuevo ítem');
        
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

    public function print_etq(ItemOt $item_ot , OrdenTrabajo $trabajo)
    {
        //return $item_ot;
        $data = ['title' => 'coding driver test title'];
        //$customPaper = array(0,0,141.70,188.80); // 50 60
        $customPaper = array(0,0,227.56,332.90); // 70 100
        
        $pdf = PDF::loadView('backend.item_ots.print_etq', compact('item_ot'))->setPaper($customPaper, 'landscape');
        
        return $pdf->stream('Item OT_'.$item_ot->folio.'.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemOt $item_ot, OrdenTrabajo $trabajo)
    {
        $procs = Proceso::orderBy('codigo')->get();
        return view('backend.item_ots.edit',compact('item_ot','trabajo','procs'));
    }

    public function editTaller(ItemOt $item_ot, OrdenTrabajo $trabajo)
    {
        return view('backend.item_ots.editTaller',compact('item_ot','trabajo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemOt $item_ot, OrdenTrabajo $trabajo)
    {
        
       $this->validate($request, [
           'descripcion' => 'required|min:3',
           'cantidad' => 'required|numeric',
           'valor_unitario' => 'required|numeric',
           'valor_parcial' => 'required|numeric',
           'estado' => 'required',
           'especificaciones' => '',
              
       ]);
  
       $update1 = DB::table('orden_trabajos')
       ->where('id', '=', $trabajo->id)
       ->update([
           'valor_total' =>  $trabajo->valor_total - $item_ot->valor_parcial  + $request->input('valor_parcial'),
   
           ]);

       $estado_item_nuevo = $request->input('estado');
       if($estado_item_nuevo == '2' && $item_ot->estado == '1'){
               $fecha_inicio = Carbon::now();
               $fecha_inicio = $fecha_inicio->format('Y-m-d'); 
       }else{
              $fecha_inicio = null;
       }
       if($estado_item_nuevo == '4' ){
               $fecha_termino = Carbon::now();
               $fecha_termino = $fecha_termino->format('Y-m-d'); 
       }else{
              $fecha_termino = null;
       }       
       
       $update2 = DB::table('item_ots')
       ->where('id', '=', $item_ot->id)
       ->update([
           'descripcion' => $request->input('descripcion'),
           'cantidad' => $request->input('cantidad'),
           'valor_unitario' => $request->input('valor_unitario'),
           'valor_parcial' => $request->input('valor_parcial'),
           'estado' => $request->input('estado'),
           'especificaciones' => $request->input('especificaciones'),
           'fecha_inicio' => $fecha_inicio,
           'fecha_termino' => $fecha_termino,
          
           ]);
       
       if (ItemOt::where('estado', '=', '2')->where('ot_id', '=', $trabajo->id)->exists()) {
           $update1 = DB::table('orden_trabajos')
             ->where('id', '=', $trabajo->id)
             ->update([
                 'estado' =>  '2',
                 ]);
           if($trabajo->estado == '1'){
               $update1 = DB::table('orden_trabajos')
                  ->where('id', '=', $trabajo->id)
                  ->update([
                      'fecha_inicio' =>  $fecha_inicio,
                      ]);                
           }
           
        }
       
       if (ItemOt::where('estado', '=', '4')->where('ot_id', '=', $trabajo->id)->count('id') == 
               ItemOt::where('ot_id', '=', $trabajo->id)->count('id')) {
           
           $update1 = DB::table('orden_trabajos')
             ->where('id', '=', $trabajo->id)
             ->update([
                 'estado' =>  '4',
                 ]);
           if($trabajo->estado != '4'){
               $update1 = DB::table('orden_trabajos')
                  ->where('id', '=', $trabajo->id)
                  ->update([
                      'fecha_termino' =>  $fecha_termino,
                      ]);                
           }
           
        } 

        if (ItemOt::where('estado', '=', '5')->where('ot_id', '=', $trabajo->id)->count('id') == 
            ItemOt::where('ot_id', '=', $trabajo->id)->count('id')) {
        
        $update1 = DB::table('orden_trabajos')
        ->where('id', '=', $trabajo->id)
        ->update([
            'estado' =>  '5',
        ]);
        
/*         if($trabajo->estado != '5'){
            $update1 = DB::table('orden_trabajos')
            ->where('id', '=', $trabajo->id)
            ->update([
                'fecha_termino' =>  $fecha_termino,
                ]);                
        } */
    
 } 
    
        return redirect()->route('admin.orden_trabajos.edit',$trabajo)->withFlashSuccess('Se ha actualizado el ítem de la Orden de Trabajo');
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemOt $item_ot, OrdenTrabajo $trabajo)
    {
           
        $trabajo->update(
            [    
            'valor_total' => $trabajo->valor_total - $item_ot->valor_parcial,        
            ]);   
            
        foreach($item_ot->imagenes() as $imagen){
            Storage::disk('public')->delete($imagen->url);
            $imagen->delete();           
        }

        $item_ot->delete();

        return redirect()->route('admin.orden_trabajos.edit',$trabajo)->withFlashSuccess('Se ha eliminado el ítem');
    }


    public function opencode(Request $request){

        $string = str_replace(
            array('-', "'"),
            array('/', '-'),
            $request->input('codigo_id')
        );

        $item_ot   = ItemOt::where('folio', $string)->first();
        $trabajo = $item_ot->ordenTrabajo;

        if($item_ot){

            return view('backend.item_ots.editTaller',compact('item_ot', 'trabajo'));

        }

        return redirect()->route('admin.item_ots.index')->withFlashDanger('No se encontró un trabajo con el folio del ítem escaneado');


    }


    public function dataAjax(Request $request)
    {
       $term = trim($request->q);

       $tags = ItemOt::query()
        ->where('descripcion', 'LIKE', "%{$term}%")/* ->orWhere('folio', 'LIKE', "%{$term}%") */->where('estado','=', '4')->where('ot_id',$request->id) 
        ->get();
        $formatted_tags = [];
        foreach ($tags as $tag) {
            $formatted_tags[] = [
                 'id' => $tag->id,
                 'text' => '['.$tag->folio.'] '. $tag->descripcion ,           
                ];
        }
        return \Response::json($formatted_tags);
    } 
}
