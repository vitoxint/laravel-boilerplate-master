<?php

namespace App\Repositories\Backend\Model;

use App\Exceptions\GeneralException;
use App\Material;

use Carbon\Carbon;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class UserRepository.
 */
class MaterialRepository extends BaseRepository
{
    /**
     * OrdenTrabajoRepository constructor.
     *
     * @param  material  $model
     */
    public function __construct(Material $model)
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

    public function getMaterialBarras($paged = 25, $orderBy = 'codigo', $sort = 'asc'): LengthAwarePaginator
    {
        return $this->model
            ->where('perfil',1)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);

    }

    public function getMaterialPlanchas($paged = 25, $orderBy = 'codigo', $sort = 'asc'): LengthAwarePaginator
    {
        return $this->model
            ->where('perfil',3)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);

    }

    public function getMaterialPerforadas($paged = 25, $orderBy = 'codigo', $sort = 'asc'): LengthAwarePaginator
    {
        return $this->model
            ->where('perfil',2)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);

    }

    public function getBuscarMaterialesPaginated($paged = 25, $orderBy = 'codigo', $sort = 'asc', $term): LengthAwarePaginator
    {
        return $this->model
            ->where('proveedor', 'LIKE', "%{$term}%")->orWhere('codigo', 'LIKE', "%{$term}%")
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }


    


 
  

}
