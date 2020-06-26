<?php

namespace App\Repositories\Backend\Model;

use App\Exceptions\GeneralException;
use App\ProductoVenta;

use Carbon\Carbon;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class UserRepository.
 */
class ProductoVentaRepository extends BaseRepository
{
    /**
     * OrdenTrabajoRepository constructor.
     *
     * @param    $model
     */
    public function __construct(ProductoVenta $model)
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



    public function getBuscarMaterialesPaginated($paged = 25, $orderBy = 'codigo', $sort = 'asc', $term): LengthAwarePaginator
    {
        return $this->model
            ->where('codigo', 'LIKE', "%{$term}%")->orWhere('descripcion', 'LIKE', "%{$term}%")
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }


    


 
  

}
