<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Cliente;
use App\Region;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Backend\Model\ClienteRepository;

class ClienteController extends Controller
{

    protected $clienteRepository;

    public function __construct(ClienteRepository $clienteRepository)
    {
        $this->clienteRepository = $clienteRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('backend.clientes.index')
            ->withClientes($this->clienteRepository->getActivePaginated(25, 'id', 'asc'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::orderBy('name','asc')->get();

        return view('backend.clientes.create',compact('regions'));
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
                'razon_social' => 'required|unique:clientes',
                'rut_cliente' => 'required|unique:clientes|cl_rut',
                'direccion' => 'required',
                'region_id' => ['required'],
                'commune_id' => ['required'],
                'telefono' => ['required'],
                'email' => 'email',
    
            ]);

            $cliente= Cliente::create([
                'razon_social' => $request->input('razon_social'),
                'rut_cliente' => $request->input('rut_cliente'),
                'direccion' => $request->input('direccion'),
                'region_id' => $request->input('region_id'),
                'commune_id' => $request->input('commune_id'),
                'telefono' => $request->input('telefono'),
                'celular' => $request->input('celular'),
                'email' => $request->input('email'),
                'giro_comercial' => $request->input('giro_comercial'),
                
              ]);

        return redirect()->route('admin.clientes.index')->withFlashSuccess('Cliente registrado');
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
    public function edit(Cliente $cliente)
    {
    $regions = Region::orderBy('name', 'asc')->get();
        return view('backend.clientes.edit',compact('regions'))->withCliente($cliente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {

        $this->validate($request, [
            'razon_social' => 'required',
            'rut_cliente' => 'required|cl_rut',
            'direccion' => 'required',
            'region_id' => ['required'],
            'commune_id' => ['required'],
            'telefono' => ['required'],
            'email' => 'email',

        ]);

        $cliente->update(
            [    
            'razon_social' => $request->input('razon_social'),
            'rut_cliente' => $request->input('rut_cliente'),
            'direccion' => $request->input('direccion'),
            'region_id' => $request->input('region_id'),
            'commune_id' => $request->input('commune_id'),
            'telefono' => $request->input('telefono'),
            'celular' => $request->input('celular'),
            'email' => $request->input('email'),
            'giro_comercial' => $request->input('giro_comercial'),
            'slug' => $request->input('razon_social'),
            ]
        );

        return redirect()->route('admin.clientes.index')->withFlashSuccess('Cliente actualizado');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('admin.clientes.index')->withFlashSuccess('Cliente eliminado');
    }

    public function dataAjax(Request $request)
    {
       $term = trim($request->q);

       $tags = Cliente::query()
        ->where('razon_social', 'LIKE', "%{$term}%") 
        ->get();
        $formatted_tags = [];
        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->razon_social];
        }
        return \Response::json($formatted_tags);
    }
}
