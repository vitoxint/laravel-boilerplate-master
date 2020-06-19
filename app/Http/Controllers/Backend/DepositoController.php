<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Deposito;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Backend\Model\DepositoRepository;

class DepositoController extends Controller
{

    protected $depositoRepository;

    public function __construct(DepositoRepository $depositoRepository)
    {
        $this->depositoRepository = $depositoRepository;
    }


    public function index()
    {
        return view('backend.depositos.index')
        ->withDepositos($this->depositoRepository->getActivePaginated(25, 'nombre', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('backend.depositos.create');
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
            'nombre' => 'required|unique:depositos',
                    
        ]);

        $deposito= Deposito::create([
            'nombre' => $request->input('nombre'),
            'ubicacion' => $request->input('ubicacion'),
            'estado_habilitada' => $request->input('estado_habilitada'),
            'estado_utilizada' => null,
                       
          ]);

          return redirect()->route('admin.depositos.edit',$deposito)->withFlashSuccess('Deposito de almacenamiento registrada'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deposito  $deposito
     * @return \Illuminate\Http\Response
     */
    public function show(Deposito $deposito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deposito  $deposito
     * @return \Illuminate\Http\Response
     */
    public function edit(Deposito $deposito)
    {
        return view('backend.depositos.edit', compact('deposito'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deposito  $deposito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deposito $deposito)
    {
        $this->validate($request, [
            'nombre' => 'required',
                    
        ]);

        $deposito->update([
            'nombre' => $request->input('nombre'),
            'ubicacion' => $request->input('ubicacion'),
            'estado_habilitada' => $request->input('estado_habilitada'),
            //'estado_utilizada' => null,
                       
          ]);

          return redirect()->route('admin.depositos.edit',$deposito)->withFlashSuccess('Deposito de almacenamiento de material ha sido actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deposito  $deposito
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deposito $deposito)
    {
        if($deposito->estado_utilizada != '1'){
            $deposito->delete();

            return redirect()->route('admin.depositos.index')->withFlashSuccess('Lugar de depósito de materiales eliminada'); 
        }

        return redirect()->route('admin.depositos.index')->withFlashDanger('Lugar de depósito de materiales no puede ser eliminada, porque posee existencias en su lugar'); 
        
    }
}
