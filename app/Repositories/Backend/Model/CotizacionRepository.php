<?php

namespace App\Repositories\Backend\Model;

use App\Exceptions\GeneralException;
use App\Cotizacion;

use Carbon\Carbon;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class UserRepository.
 */
class CotizacionRepository extends BaseRepository
{
    /**
     * OrdenTrabajoRepository constructor.
     *
     * @param  Cotizacion  $model
     */
    public function __construct(Cotizacion $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */

    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc'): LengthAwarePaginator
    {
        return $this->model
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    

    public function getVigentesPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc'): LengthAwarePaginator
    {
        return $this->model
            ->where('estado','=','1')
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    public function getAceptadasPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc'): LengthAwarePaginator
    {
        return $this->model
            //->whereBetween('estado', ['1', '4'])
            ->where('estado','=','2')
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }


    public function getBuscarCotizacionPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc', $term): LengthAwarePaginator
    {
        return $this->model
            ->where('empresa', 'LIKE', "%{$term}%")->orWhere('contacto', 'LIKE', "%{$term}%")
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }
    


 
  

}
