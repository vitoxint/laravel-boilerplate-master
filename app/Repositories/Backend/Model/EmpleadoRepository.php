<?php

namespace App\Repositories\Backend\Model;

use App\Exceptions\GeneralException;
use App\Empleado;

use Carbon\Carbon;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class UserRepository.
 */
class EmpleadoRepository extends BaseRepository
{
    /**
     * OrdenTrabajoRepository constructor.
     *
     * @param  empleado  $model
     */
    public function __construct(Empleado $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */

    public function getActivePaginated($paged = 25, $orderBy = 'codigo', $sort = 'asc'): LengthAwarePaginator
    {
        return $this->model
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    public function getBuscarOperadoresPaginated($paged = 25, $orderBy = 'codigo', $sort = 'asc', $term): LengthAwarePaginator
    {
        return $this->model
            ->where('nombres', 'LIKE', "%{$term}%")->orWhere('apellidos', 'LIKE', "%{$term}%")->orWhere('codigo', 'LIKE', "%{$term}%")
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }


    


 
  

}
