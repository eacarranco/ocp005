<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'cobros.listar',              'group' => 'Cobros',     'description' => 'Ver el listado de cobros'],
            ['name' => 'cobros.ver',                  'group' => 'Cobros',     'description' => 'Ver formulario de creación'],
            ['name' => 'cobros.crear',                'group' => 'Cobros',     'description' => 'Crear nuevos cobros'],
            ['name' => 'cobros.editar',               'group' => 'Cobros',     'description' => 'Ver formulario de edición'],
            ['name' => 'cobros.actualizar',           'group' => 'Cobros',     'description' => 'Actualizar cobros existentes'],
            ['name' => 'cobros.eliminar',             'group' => 'Cobros',     'description' => 'Eliminar cobros individuales'],
            ['name' => 'cobros.eliminar-masivo',      'group' => 'Cobros',     'description' => 'Eliminación masiva de cobros'],
            ['name' => 'cobros.exportar-pendientes',  'group' => 'Cobros',     'description' => 'Exportar cobros pendientes a TXT'],
            ['name' => 'cobros.exportar-seleccionados','group' => 'Cobros',    'description' => 'Exportar cobros seleccionados a TXT'],
            ['name' => 'consultar.ver',               'group' => 'Consultar',  'description' => 'Ver página de consulta Oracle'],
            ['name' => 'consultar.obtener',           'group' => 'Consultar',  'description' => 'Obtener registros desde Oracle'],
            ['name' => 'consultar.guardar',           'group' => 'Consultar',  'description' => 'Guardar registros Oracle como cobros'],
            ['name' => 'envios.listar',               'group' => 'Envíos',    'description' => 'Ver el log de envíos'],
            ['name' => 'envios.regenerar',            'group' => 'Envíos',    'description' => 'Regenerar y descargar TXT'],
            ['name' => 'envios.eliminar',             'group' => 'Envíos',    'description' => 'Eliminar log de envío (deshacer)'],
            ['name' => 'admin.roles.ver',             'group' => 'Admin',     'description' => 'Ver listado de roles'],
            ['name' => 'admin.roles.crear',           'group' => 'Admin',     'description' => 'Crear roles'],
            ['name' => 'admin.roles.editar',          'group' => 'Admin',     'description' => 'Editar roles y permisos'],
            ['name' => 'admin.roles.eliminar',        'group' => 'Admin',     'description' => 'Eliminar roles'],
            ['name' => 'admin.usuarios.ver',          'group' => 'Admin',     'description' => 'Ver listado de usuarios'],
            ['name' => 'admin.usuarios.crear',        'group' => 'Admin',     'description' => 'Crear usuarios'],
            ['name' => 'admin.usuarios.editar',       'group' => 'Admin',     'description' => 'Editar usuarios y roles asignados'],
            ['name' => 'admin.usuarios.eliminar',     'group' => 'Admin',     'description' => 'Eliminar usuarios'],
        ];

        foreach ($permissions as $perm) {
            Permission::create($perm);
        }

        $this->command->info('Permisos creados: ' . count($permissions));
    }
}
