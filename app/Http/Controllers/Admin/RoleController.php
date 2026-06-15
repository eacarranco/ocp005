<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::withCount('users', 'permissions')->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all()->groupBy('group');
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'description' => 'nullable|string|max:255',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
        ]);

        $role->permissions()->attach($validated['permissions']);

        return redirect()->route('admin.roles.index')
            ->with('success', "Rol '{$role->name}' creado exitosamente.");
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all()->groupBy('group');
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, Role $role)
    {
        if ($role->name === 'Administrador') {
            return redirect()->route('admin.roles.index')
                ->with('error', 'No se puede editar el rol Administrador.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'description' => 'nullable|string|max:255',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
        ]);

        $role->permissions()->sync($validated['permissions']);

        return redirect()->route('admin.roles.index')
            ->with('success', "Rol '{$role->name}' actualizado exitosamente.");
    }

    public function destroy(Role $role)
    {
        if ($role->name === 'Administrador') {
            return redirect()->route('admin.roles.index')
                ->with('error', 'No se puede eliminar el rol Administrador.');
        }

        if ($role->users()->count() > 0) {
            return redirect()->route('admin.roles.index')
                ->with('error', 'No se puede eliminar un rol que tiene usuarios asignados.');
        }

        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rol eliminado exitosamente.');
    }
}
