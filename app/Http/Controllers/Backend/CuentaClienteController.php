<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Backend\Model\CuentaClienteRepository;

use App\CuentaCliente;
use App\Cliente;
use Illuminate\Http\Request;

class CuentaClienteController extends Controller
{

    protected $cuentaClienteRepository;

    public function __construct(CuentaClienteRepository $cuentaClienteRepository)
    {
        $this->cuentaClienteRepository = $cuentaClienteRepository;
    }


    public function index()
    {
        return view('backend.cuenta_clientes.index')
        ->withCuentaClientes($this->cuentaClienteRepository->getActivePaginated(25, 'cliente_id', 'asc'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.cuenta_clientes.create');
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
            //'descripcion' => 'required',
            
        ]);

        $activa = $request->input('estado_activa') ? $request->input('estado_activa'): 0;

        $cuenta = CuentaCliente::create([

            'cliente_id'    => $request->input('cliente_id'),
            'estado_activa' => $activa,
            'nombre' => $request->input('nombre')
        ]);

        return redirect()->route('admin.cuenta_clientes.edit',$cuenta)->withFlashSuccess('La cuenta de crédito del cliente se ha registrado'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CuentaCliente  $cuentaCliente
     * @return \Illuminate\Http\Response
     */
    public function show(CuentaCliente $cuentaCliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CuentaCliente  $cuentaCliente
     * @return \Illuminate\Http\Response
     */
    public function edit(CuentaCliente $cuenta)
    {
        return view('backend.cuenta_clientes.edit', compact('cuenta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CuentaCliente  $cuentaCliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CuentaCliente $cuentaCliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CuentaCliente  $cuentaCliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(CuentaCliente $cuentaCliente)
    {
        //
    }
}
