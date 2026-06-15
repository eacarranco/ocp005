@extends('layouts.auth')
@section('title', 'Cambiar Contraseña - OCP-005')
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-6 col-lg-4">
        <div class="card shadow">
            <div class="card-header text-center">
                <h5 class="mb-0"><i class="bi bi-key"></i> Cambio de Contraseña Requerido</h5>
            </div>
            <div class="card-body">
                <p class="text-muted small">Por seguridad, debes cambiar tu contraseña antes de continuar.</p>
                <form method="POST" action="{{ route('password.expired.update') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Contraseña Actual</label>
                        <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Nueva Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required minlength="8">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">Confirmar Nueva Contraseña</label>
                        <input type="password" name="password_confirmation" id="password-confirm" class="form-control" required minlength="8">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Cambiar Contraseña</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
