<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\ClienteRepresentante;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Backend\Model\ClienteRepresentanteRepository;

use App\Cliente;
use DB;


class ClienteRepresentanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ClienteRepresentanteRepository $clienteRepresentanteRepository)
    {
        $this->clienteRepresentanteRepository = $clienteRepresentanteRepository;
    }


    public function index(Request $request)
    {
       
        return view('backend.contacto_clientes.index')
        ->withClienteRepresentantes($this->clienteRepresentanteRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Cliente $cliente)
    {
        
        return view('backend.contacto_clientes.create' ,compact('cliente'));
    }
    
    
    public function addRepresentante($cliente_id)
    {
       
        return view('cliente_representantes.create' ,compact('users','cliente'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , Cliente $cliente)
    {
     
         $this->validate($request, [
            
            'nombre' => 'required|unique:cliente_representantes',
            'funcion_representante' => 'required',
            'telefono' => '',
            'email' => 'required|email|unique:cliente_representantes',
            
        ]);

        $clienteRepresentante= ClienteRepresentante::create([
            'nombre'=>$request->get('nombre'),
            'funcion_representante'=> $request->get('funcion_representante'),
            'telefono' => $request->get('telefono'),
            'email' => $request->get('email'),
            'cliente_id' => $cliente->id,
            'slug' => $request->get('nombre'),
            
          ]);
        

          return redirect()->route('admin.clientes.edit',$cliente)->withFlashSuccess('Contacto registrado');
        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClienteRepresentante  $clienteRepresentante
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $representante = ClienteRepresentante::find($id);
        
        return view('cliente_representantes.show', compact('representante'));
    }


    public function edit(ClienteRepresentante $contacto, Cliente $cliente)
    {
        return view('backend.contacto_clientes.edit',compact('contacto'));
        
       
    }

 
    public function update(Request $request, ClienteRepresentante $contacto, Cliente $cliente)
    {
        
        $this->validate($request, [
            'nombre' => 'required',
            'funcion_representante' => 'required',
            'telefono' => '',
            'email' => 'required|email',
               
        ]);

        $contacto->update(
            [    
                'nombre'=>$request->get('nombre'),
                'funcion_representante'=> $request->get('funcion_representante'),
                'telefono' => $request->get('telefono'),
                'email' => $request->get('email'),
                'slug' => $request->get('nombre'),
            ]
        );

        return redirect()->route('admin.clientes.edit', $cliente)->withFlashSuccess('Contacto cliente actualizado');


    }

 
    public function destroy( ClienteRepresentante $contacto, Cliente $cliente)
    {        
        $contacto->delete();
                
        return redirect()->route('admin.clientes.edit',$cliente)->withFlashSuccess('Contacto eliminado');
    }


    public function getContactoList(Request $request)
    {
        $contactos = DB::table("cliente_representantes")
        ->where("cliente_id",$request->cliente_id)
        ->pluck("nombre","id");
        return response()->json($contactos);
    }
       

}
