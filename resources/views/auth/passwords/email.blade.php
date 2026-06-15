@extends('layouts.auth')
@section('title', 'Recuperar Contraseña - OCP-005')
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-6 col-lg-4">
        <div class="card shadow">
            <div class="card-header text-center">
                <h5 class="mb-0"><i class="bi bi-key"></i> Recuperar Contraseña</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Enviar enlace de recuperación</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-decoration-none small">Volver al inicio de sesión</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
