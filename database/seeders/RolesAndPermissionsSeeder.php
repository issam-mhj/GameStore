<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'view_dashboard',
            'view_products',
            'create_products',
            'edit_products',
            'delete_products',
            'view_categories',
            'create_categories',
            'edit_categories',
            'delete_categories',
            'view_users',
            'create_users',
            'edit_users',
            'delete_users',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $superAdminRole = Role::create(['name' => 'super_admin']);
        $productManagerRole = Role::create(['name' => 'product_manager']);
        $userManagerRole = Role::create(['name' => 'user_manager']);

        $superAdminRole->givePermissionTo(Permission::all());

        $productManagerRole->givePermissionTo([
            'view_products',
            'create_products',
            'edit_products',
            'delete_products',
            'view_categories',
            'create_categories',
            'edit_categories',
            'delete_categories'
        ]);

        $userManagerRole->givePermissionTo([
            'view_users',
            'create_users',
            'edit_users',
            'delete_users'
        ]);
    }
}

