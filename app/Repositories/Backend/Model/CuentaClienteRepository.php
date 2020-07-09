<?php

namespace App\Repositories\Backend\Model;

use App\Exceptions\GeneralException;
use App\CuentaCliente;

use Carbon\Carbon;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class CuentaClienteRepository.
 */
class CuentaClienteRepository extends BaseRepository
{
    /**
     * OrdenTrabajoRepository constructor.
     *
     * @param  itemOt  $model
     */
    public function __construct(CuentaCliente $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */

    public function getActivePaginated($paged = 25, $orderBy = 'cliente_id', $sort = 'asc'): LengthAwarePaginator
    {
        return $this->model
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }


    


 
  

}
