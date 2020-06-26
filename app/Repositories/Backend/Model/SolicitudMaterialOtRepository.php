<?php

namespace App\Repositories\Backend\Model;

use App\Exceptions\GeneralException;
use App\SolicitudMaterialOt;
use App\ItemOt;

use Carbon\Carbon;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class UserRepository.
 */
class SolicitudMaterialOtRepository extends BaseRepository
{
    /**
     * OrdenTrabajoRepository constructor.
     *
     * @param  material  $model
     */
    public function __construct(SolicitudMaterialOt $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */

    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'asc'): LengthAwarePaginator
    {
        
        return $this->model
            ->where('estado',1)->orWhere('estado',2)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }




}
