@extends('layouts.app')
@section('title', 'Roles - OCP-005')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-shield"></i> Roles</h5>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Nuevo Rol</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Usuarios</th>
                        <th>Permisos</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                    <tr>
                        <td><strong>{{ $role->name }}</strong></td>
                        <td>{{ $role->description ?? '-' }}</td>
                        <td>{{ $role->users_count }}</td>
                        <td>{{ $role->permissions_count }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                            @if($role->name !== 'Administrador')
                            <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este rol?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
