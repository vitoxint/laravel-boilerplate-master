<?php

namespace App\Repositories\Backend\Model;

use App\Exceptions\GeneralException;
use App\OrdenTrabajo;

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

    public function getActivePaginated($paged = 25, $orderBy = 'entrega_estimada', $sort = 'desc'): LengthAwarePaginator
    {
        return $this->model
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

  
    


 
  

}
