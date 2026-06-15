@extends('layouts.app')
@section('title', 'Nuevo Rol - OCP-005')
@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Nuevo Rol</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.roles.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nombre del Rol</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Descripción</label>
                    <input type="text" name="description" class="form-control" value="{{ old('description') }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Permisos</label>
                    @error('permissions')<div class="text-danger small mb-2">{{ $message }}</div>@enderror
                    @foreach($permissions as $group => $perms)
                    <div class="card mb-3">
                        <div class="card-header py-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input group-checkbox" data-group="{{ $group }}">
                                <label class="form-check-label fw-bold">{{ $group }}</label>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($perms as $perm)
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" name="permissions[]" value="{{ $perm->id }}" class="form-check-input permission-checkbox" data-group="{{ $group }}" id="perm_{{ $perm->id }}">
                                        <label class="form-check-label small" for="perm_{{ $perm->id }}">{{ $perm->description }}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-12">
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Rol</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
document.querySelectorAll('.group-checkbox').forEach(function(cb) {
    cb.addEventListener('change', function() {
        document.querySelectorAll('.permission-checkbox[data-group="' + this.dataset.group + '"]').forEach(function(p) {
            p.checked = cb.checked;
        });
    });
});
</script>
@endpush
