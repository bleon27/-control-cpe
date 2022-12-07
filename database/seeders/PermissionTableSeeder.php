<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'access-user-list',
            'access-user-create',
            'access-user-edit',
            'access-user-delete',
            'access-control-list',
            'access-control-create',
            'access-control-edit',
            'access-control-delete',
            'item-list',
            'item-create',
            'item-edit',
            'item-delete',
            'item-access-list',
            'item-access-create',
            'item-access-edit',
            'item-access-delete',
         ];

         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
