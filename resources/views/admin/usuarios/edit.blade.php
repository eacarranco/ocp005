@extends('layouts.app')
@section('title', 'Editar Usuario - OCP-005')
@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-pencil"></i> Editar Usuario: {{ $usuario->name }}</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.usuarios.update', $usuario) }}">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $usuario->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $usuario->email) }}" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nueva Contraseña <small class="text-muted">(dejar vacío para mantener)</small></label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" minlength="8">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Confirmar Nueva Contraseña</label>
                    <input type="password" name="password_confirmation" class="form-control" minlength="8">
                </div>
                <div class="col-12">
                    <label class="form-label">Roles</label>
                    @error('roles')<div class="text-danger small mb-2">{{ $message }}</div>@enderror
                    <div class="row">
                        @foreach($roles as $role)
                        <div class="col-md-3">
                            <div class="form-check">
                                <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="form-check-input" id="role_{{ $role->id }}" {{ in_array($role->id, $userRoles) ? 'checked' : '' }}>
                                <label class="form-check-label" for="role_{{ $role->id }}">{{ $role->name }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12">
                    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
