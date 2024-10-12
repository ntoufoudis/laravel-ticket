<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        /**
         * Reset cached roles and permissions
         */
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /**
         * Create Permissions
         */
        Permission::create(['name' => 'view tickets']);
        Permission::create(['name' => 'update tickets']);
        Permission::create(['name' => 'delete tickets']);

        Permission::create(['name' => 'view categories']);
        Permission::create(['name' => 'update categories']);
        Permission::create(['name' => 'delete categories']);

        Permission::create(['name' => 'view labels']);
        Permission::create(['name' => 'update labels']);
        Permission::create(['name' => 'delete labels']);

        Permission::create(['name' => 'view agents']);
        Permission::create(['name' => 'create agents']);
        Permission::create(['name' => 'update agents']);
        Permission::create(['name' => 'delete agents']);
        /**
         * Create Roles
         */
        $userRole = Role::create(['name' => 'user']);
        $agentRole = Role::create(['name' => 'agent']);
        $agentAdminRole = Role::create(['name' => 'agent admin']);

        /**
         * Assign Permissions to Roles
         */
        $agentRole->givePermissionTo('view tickets');
        $agentRole->givePermissionTo('update tickets');
        $agentRole->givePermissionTo('view categories');
        $agentRole->givePermissionTo('view labels');

        $agentAdminRole->givePermissionTo('view tickets');
        $agentAdminRole->givePermissionTo('update tickets');
        $agentAdminRole->givePermissionTo('delete tickets');
        $agentAdminRole->givePermissionTo('view categories');
        $agentAdminRole->givePermissionTo('update categories');
        $agentAdminRole->givePermissionTo('delete categories');
        $agentAdminRole->givePermissionTo('view labels');
        $agentAdminRole->givePermissionTo('update labels');
        $agentAdminRole->givePermissionTo('delete labels');
        $agentAdminRole->givePermissionTo('view agents');
        $agentAdminRole->givePermissionTo('create agents');
        $agentAdminRole->givePermissionTo('update agents');
        $agentAdminRole->givePermissionTo('delete agents');

        /**
         * Create Super Admin
         */
        Role::create(['name' => 'Super-Admin']);
    }
}
