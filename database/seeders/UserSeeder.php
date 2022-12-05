<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {

        Role::create(['name' => 'Administrador',]);
        Role::create(['name' => 'Seguridad',]);

        User::create(
            [
                'names' => 'Bryan',
                'surnames' => 'Leon',
                'ci' => '1722280334',
                'email' => 'bleon27leon@gmail.com',
                'unit' => 'TICS',
                'position' => 'Asistente Electoral Transversal',
                'role_id' => 1,
                'password' => bcrypt('123456789'),
            ]
        );
    }
}
