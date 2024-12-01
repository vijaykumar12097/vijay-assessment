<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $admin = Role::create(['name' => 'Admin']);
        $user = Role::create(['name' => 'User']);
        $viewer = Role::create(['name' => 'Viewer']);

        // Create permissions
        $permissions = ['view documents', 'create documents', 'edit documents', 'delete documents'];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign permissions to roles
        $admin->givePermissionTo($permissions);
        $user->givePermissionTo(['view documents', 'create documents']);
        $viewer->givePermissionTo(['view documents']);
    }
}
