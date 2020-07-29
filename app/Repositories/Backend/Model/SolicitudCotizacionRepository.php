<?php

namespace App\Repositories\Backend\Model;

use App\Exceptions\GeneralException;
use App\SolicitudCotizacion;

use Carbon\Carbon;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class UserRepository.
 */
class SolicitudCotizacionRepository extends BaseRepository
{
    /**
     * OrdenTrabajoRepository constructor.
     *
     * @param  SolicitudCotizacion  $model
     */
    public function __construct(SolicitudCotizacion $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */

    public function getActivePaginated($paged = 25, $orderBy = 'estado', $sort = 'asc'): LengthAwarePaginator
    {
        return $this->model
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    

    public function getEsperaPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc'): LengthAwarePaginator
    {
        return $this->model
            ->where('estado','=','1')
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    public function getResueltasPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc'): LengthAwarePaginator
    {
        return $this->model
            //->whereBetween('estado', ['1', '4'])
            ->where('estado','=','2')
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    public function getEnviadasPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc'): LengthAwarePaginator
    {
        return $this->model
            //->whereBetween('estado', ['1', '4'])
            ->where('estado','=','4')
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }   


    public function getBuscarCotizacionPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc', $term): LengthAwarePaginator
    {
        return $this->model
            ->where('nombre_solicitante', 'LIKE', "%{$term}%")
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }
    


 
  

}
