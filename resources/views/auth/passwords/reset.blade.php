@extends('layouts.app')
@section('title', 'Restablecer Contraseña - OCP-005')
@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="col-12 col-md-6 col-lg-4">
        <div class="card shadow">
            <div class="card-header text-center">
                <h5 class="mb-0"><i class="bi bi-key"></i> Restablecer Contraseña</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $email ?? old('email') }}" required readonly>
                        @error('email')
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
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Restablecer Contraseña</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
