<?php

namespace App\Repositories\Backend\Model;

use App\Exceptions\GeneralException;
use App\Deposito;

use Carbon\Carbon;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class UserRepository.
 */
class DepositoRepository extends BaseRepository
{
    /**
     * OrdenTrabajoRepository constructor.
     *
     * @param  itemOt  $model
     */
    public function __construct(Deposito $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */

    public function getActivePaginated($paged = 25, $orderBy = 'nombre', $sort = 'asc'): LengthAwarePaginator
    {
        return $this->model
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }


    


 
  

}
