<?php

namespace App\Repositories\Backend\Model;

use App\Exceptions\GeneralException;
use App\ItemOt;

use Carbon\Carbon;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class UserRepository.
 */
class ItemOtRepository extends BaseRepository
{
    /**
     * OrdenTrabajoRepository constructor.
     *
     * @param  itemOt  $model
     */
    public function __construct(ItemOt $model)
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

/*     public function getAnuladasPaginated($paged = 25, $orderBy = 'entrega_estimada', $sort = 'desc'): LengthAwarePaginator
    {
        return $this->model
            ->where('estado','=','6')
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    public function getPendientesPaginated($paged = 25, $orderBy = 'entrega_estimada', $sort = 'asc'): LengthAwarePaginator
    {
        return $this->model
            ->where('estado','=','5')
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    public function getEntregadasPaginated($paged = 25, $orderBy = 'entrega_estimada', $sort = 'desc'): LengthAwarePaginator
    {
        return $this->model
            ->whereBetween('estado', ['1', '4'])
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

   */
    


 
  

}
