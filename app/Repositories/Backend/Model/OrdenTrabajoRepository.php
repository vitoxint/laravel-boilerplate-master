<?php

namespace App\Repositories\Backend\Model;

use App\Exceptions\GeneralException;
use App\OrdenTrabajo;
use App\Cliente;
use App\ClienteRepresentante;

use Carbon\Carbon;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class UserRepository.
 */
class OrdenTrabajoRepository extends BaseRepository
{
    /**
     * OrdenTrabajoRepository constructor.
     *
     * @param  OrdenTrabajo  $model
     */
    public function __construct(OrdenTrabajo $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */

    public function getActivePaginated($paged = 50, $orderBy = 'entrega_estimada', $sort = 'desc'): LengthAwarePaginator
    {
        return $this->model
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    public function getAnuladasPaginated($paged = 25, $orderBy = 'entrega_estimada', $sort = 'desc'): LengthAwarePaginator
    {
        return $this->model
            ->where('estado','=','6')
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    public function getPendientesPaginated($paged = 50, $orderBy = 'entrega_estimada', $sort = 'asc'): LengthAwarePaginator
    {
        return $this->model
            ->where('estado','=','5')
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    public function getEntregadasPaginated($paged = 25, $orderBy = 'entrega_estimada', $sort = 'desc'): LengthAwarePaginator
    {
        return $this->model
            ->whereNotIn('estado', ['5'])
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    public function getSinIniciarPaginated($paged = 25, $orderBy = 'entrega_estimada', $sort = 'asc'): LengthAwarePaginator
    {
        return $this->model
            ->where('estado', 1)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    public function getEnProcesoPaginated($paged = 25, $orderBy = 'entrega_estimada', $sort = 'asc'): LengthAwarePaginator
    {
        return $this->model
            ->where('estado',2)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    public function getAtrasadasPaginated($paged = 25, $orderBy = 'entrega_estimada', $sort = 'asc'): LengthAwarePaginator
    {
        return $this->model
            ->where('estado',3)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    public function getTerminadasPaginated($paged = 25, $orderBy = 'fecha_termino', $sort = 'asc'): LengthAwarePaginator
    {
        return $this->model
            ->where('estado', 4)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    public function getProximasEntregasPaginated($paged = 25, $orderBy = 'entrega_estimada', $sort = 'ASC' , $dias): LengthAwarePaginator
    {
        $fecha = Carbon::now()->addDay($dias)->format('Y-m-d');

        return $this->model
            ->whereBetween('estado', ['1', '4'])
            ->where('entrega_estimada' , '<=' , $fecha)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }


    public function getBuscarOtPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc', $term): LengthAwarePaginator
    {
        $clientes = Cliente::where('razon_social', 'LIKE', "%{$term}%")->orWhere('rut_cliente', 'LIKE', "%{$term}%")->get('id');
        $contactos = ClienteRepresentante::where('nombre', 'LIKE', "%{$term}%")->get('id');

        return $this->model
            ->whereIn('cliente_id', $clientes)->orWhereIn('representante_id', $contactos)->orWhere('factura', 'LIKE', "%{$term}%")
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

  
    


 
  

}
