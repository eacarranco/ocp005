<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::create([
            'name' => 'Administrador',
            'description' => 'Acceso total al sistema',
        ]);

        $admin->permissions()->attach(Permission::all()->pluck('id'));

        $this->command->info('Rol Administrador creado con todos los permisos.');
    }
}
