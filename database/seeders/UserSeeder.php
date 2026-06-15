<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
        ]);

        $adminRole = Role::where('name', 'Administrador')->first();
        if ($adminRole) {
            $user->roles()->attach($adminRole->id);
        }

        $this->command->info('Usuario admin@admin.com creado con rol Administrador.');
    }
}
