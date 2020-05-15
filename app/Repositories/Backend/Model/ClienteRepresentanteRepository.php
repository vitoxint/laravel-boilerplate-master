<?php

namespace App\Repositories\Backend\Model;

use App\Exceptions\GeneralException;
use App\ClienteRepresentante;

use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class UserRepository.
 */
class ClienteRepresentanteRepository extends BaseRepository
{
    /**
     * UserRepository constructor.
     *
     * @param  ClienteRepresentante  $model
     */
    public function __construct(ClienteRepresentante $model)
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

    public function getBuscarClientesPaginated($paged = 25, $orderBy = 'nombre', $sort = 'asc', $term): LengthAwarePaginator
    {
        return $this->model
            ->where('nombre', 'LIKE', "%{$term}%")
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */


    /**
     * @param array $data
     *
     * @throws \Exception
     * @throws \Throwable
     * @return User
     */
    public function create(array $data): Cliente
    {
        return DB::transaction(function () use ($data) {
            $cliente = $this->model::create([
                'razon_social' => $data['razon_social'],
                'rut_cliente' => $data['rut_cliente'],
                'direccion' => $data['direccion'],
                'email' => $data['email'],
                'telefono' => $data['telefono'],
                'celular' => $data['celular'],
                'commune_id' => $data['commune_id'],
                'region_id' => $data['region_id'],
                'slug' => $data['razon_social'],


                
            ]);

    

            if ($user) {
                // User must have at least one role
               

                //event(new ClienteCreated($cliente));

                return $cliente;
            }

            throw new GeneralException('Error al crear el cliente');
        });
    }

    /**
     * @param User  $user
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return User
     */
    public function update(User $user, array $data): User
    {
        $this->checkUserByEmail($user, $data['email']);

        // See if adding any additional permissions
        if (! isset($data['permissions']) || ! count($data['permissions'])) {
            $data['permissions'] = [];
        }

        return DB::transaction(function () use ($user, $data) {
            if ($user->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
            ])) {
                // Add selected roles/permissions
                $user->syncRoles($data['roles']);
                $user->syncPermissions($data['permissions']);

                event(new UserUpdated($user));

                return $user;
            }

            throw new GeneralException(__('exceptions.backend.access.users.update_error'));
        });
    }


 
  

}
