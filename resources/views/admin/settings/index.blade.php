@extends('layouts.app')
@section('title', 'Configuración - OCP-005')
@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-gear"></i> Configuración del Sistema</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Caducidad de Contraseña (días)</label>
                    <div class="input-group">
                        <input type="number" name="password_expiry_days" id="password_expiry_days" class="form-control @error('password_expiry_days') is-invalid @enderror" value="{{ old('password_expiry_days', $expiryDays) }}" min="1" max="365" required>
                        <span class="input-group-text">días</span>
                        @error('password_expiry_days')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <small class="text-muted">La contraseña expirará después de este número de días. El usuario deberá cambiarla al iniciar sesión.</small>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <div class="form-text">
                        <strong>Equivalencia:</strong>
                        <span id="monthsDisplay">{{ intdiv((int) $expiryDays, 30) }} meses y {{ (int) $expiryDays % 30 }} días</span>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Guardar Configuración</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
document.getElementById('password_expiry_days').addEventListener('input', function() {
    var days = parseInt(this.value) || 0;
    var months = Math.floor(days / 30);
    var remaining = days % 30;
    document.getElementById('monthsDisplay').textContent = months + ' meses y ' + remaining + ' días';
});
</script>
@endpush
