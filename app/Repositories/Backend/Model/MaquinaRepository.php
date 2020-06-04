<?php

namespace App\Repositories\Backend\Model;

use App\Exceptions\GeneralException;
use App\Maquina;

use Carbon\Carbon;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class UserRepository.
 */
class MaquinaRepository extends BaseRepository
{
    /**
     * OrdenTrabajoRepository constructor.
     *
     * @param  maquina  $model
     */
    public function __construct(Maquina $model)
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


    


 
  

}
