@extends('layouts.app')
@section('title', 'Usuarios - OCP-005')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-people"></i> Usuarios</h5>
        <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Nuevo Usuario</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td><strong>{{ $user->name }}</strong></td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach($user->roles as $role)
                                <span class="badge bg-info">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.usuarios.edit', $user) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                            @if($user->id !== auth()->id())
                            <form action="{{ route('admin.usuarios.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este usuario?')">
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
