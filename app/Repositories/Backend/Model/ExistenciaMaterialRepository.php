<?php

namespace App\Repositories\Backend\Model;

use App\Exceptions\GeneralException;
use App\ExistenciaMaterial;

use Carbon\Carbon;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class UserRepository.
 */
class ExistenciaMaterialRepository extends BaseRepository
{
    /**
     * OrdenTrabajoRepository constructor.
     *
     * @param   $model
     */
    public function __construct(ExistenciaMaterial $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */

    public function getActivePaginated($paged = 25, $orderBy = 'id', $sort = 'desc'): LengthAwarePaginator
    {
        return $this->model
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }


    


 
  

}
