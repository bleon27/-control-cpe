<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    public function run()
    {

        //Role::create(['name' => 'Administrador',]);
        //Role::create(['name' => 'Seguridad',]);

        $userAdmin = User::create([
            'names' => 'Bryan',
            'surnames' => 'Leon',
            'ci' => '1722280334',
            'email' => 'bleon27leon@gmail.com',
            'unit' => 'TICS',
            'position' => 'Asistente Electoral Transversal',
            //'role_id' => 1,
            'password' => bcrypt('123456789'),
        ]);

        $roleAdmin = Role::create(['name' => 'Admin']);

        $permissionsAdmin = Permission::pluck('id', 'id')->all();

        $roleAdmin->syncPermissions($permissionsAdmin);

        $userAdmin->assignRole([$roleAdmin->id]);

        $userSeguridad = User::create([
            'names' => 'PEPE',
            'surnames' => 'SMITH',
            'ci' => '1722280335',
            'email' => 'bleon27@hotmail.com',
            'unit' => 'SEGURIDAD',
            'position' => 'SEGURIDAD',
            //'role_id' => 1,
            'password' => bcrypt('123456789'),
        ]);

        $roleSeguridad = Role::create(['name' => 'Seguridad']);

        $permissionsSeguridad = Permission::whereIn('id', [13, 14, 15, 16])->pluck('id', 'id')->all();

        $roleSeguridad->syncPermissions($permissionsSeguridad);

        $userSeguridad->assignRole([$roleSeguridad->id]);

        $userInventario = User::create([
            'names' => 'FANNY VANESSA',
            'surnames' => 'FAJARDO CHELE',
            'ci' => '1722154752',
            'email' => 'vanessafajardo@cne.gob.com',
            'unit' => 'UNIDAD PROVINCIAL DE SEGURIDAD INFORMATICA Y PROYECTOS TECNOLOGICOS ELECTORALES',
            'position' => 'ASISTENTE ELECTORAL TRANSVERSAL',
            //'role_id' => 1,
            'password' => bcrypt('123456789'),
        ]);

        $roleInventario = Role::create(['name' => 'Inventario']);

        $permissionsInventario = Permission::whereIn('id', [17, 18, 19, 20, 21,22, 23, 24])->pluck('id', 'id')->all();

        $roleInventario->syncPermissions($permissionsInventario);

        $userInventario->assignRole([$roleInventario->id]);
    }
}
