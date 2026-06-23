@extends('layouts.app')
@section('title', 'Nuevo Usuario - OCP-005')
@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Nuevo Usuario</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.usuarios.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required minlength="8">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" class="form-control" required minlength="8">
                </div>
                <div class="col-12">
                    <label class="form-label">Roles</label>
                    @error('roles')<div class="text-danger small mb-2">{{ $message }}</div>@enderror
                    <div class="row">
                        @foreach($roles as $role)
                        <div class="col-md-3">
                            <div class="form-check">
                                <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="form-check-input" id="role_{{ $role->id }}" {{ in_array($role->id, old('roles', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="role_{{ $role->id }}">{{ $role->name }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input type="checkbox" name="force_password_change" value="1" class="form-check-input" id="force_password_change" checked>
                        <label class="form-check-label" for="force_password_change">Cambiar contraseña en próximo inicio</label>
                    </div>
                </div>
                <div class="col-12">
                    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
