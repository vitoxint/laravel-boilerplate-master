<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Auth\User;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        Permission::create([
            'name' => 'administrar cotizaciones',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'administrar ordenes de trabajo',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'ver trabajos',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'administrar clientes',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'administrar contacto clientes',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'registro procesos',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'registro maquinas',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'administracion materiales',
            'guard_name' => 'web'
        ]);


        User::find(1)->assignRole(config('access.users.admin_role'));

        // Assign Permissions to other Roles
        // Note: Admin (User 1) Has all permissions via a gate in the AuthServiceProvider
        // $user->givePermissionTo('view backend');

        $this->enableForeignKeys();
    }
}
