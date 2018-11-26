<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

        // create permissions

        Permission::create(['name' => 'create books']);
        Permission::create(['name' => 'delete books']);
        Permission::create(['name' => 'edit books']);

        Permission::create(['name' => 'create categories']);
        Permission::create(['name' => 'delete categories']);
        Permission::create(['name' => 'edit categories']);

        Permission::create(['name' => 'view transactions']);
        Permission::create(['name' => 'complete transactions']);

        // create roles and assign created permissions

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo([
            'create books', 'delete books', 'edit books',
            'view transactions', 'complete transactions'
        ]);
    }
}
