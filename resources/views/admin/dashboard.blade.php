@extends('layouts.app')
@section('title', 'Panel de Administración - OCP-005')
@section('content')
<div class="row g-3">
    <div class="col-12">
        <h5><i class="bi bi-gear"></i> Panel de Administración</h5>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="text-primary mb-0">{{ $totalCobros }}</h3>
                <small class="text-muted">Total Cobros</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="text-success mb-0">{{ $exportados }}</h3>
                <small class="text-muted">Exportados</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="text-warning mb-0">{{ $pendientes }}</h3>
                <small class="text-muted">Pendientes</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="text-info mb-0">{{ $totalEnvios }}</h3>
                <small class="text-muted">Envíos</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="text-secondary mb-0">{{ $totalUsuarios }}</h3>
                <small class="text-muted">Usuarios</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="text-secondary mb-0">{{ $totalRoles }}</h3>
                <small class="text-muted">Roles</small>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4 g-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><i class="bi bi-shield"></i> Roles</div>
            <div class="card-body">
                <a href="{{ route('admin.roles.index') }}" class="btn btn-primary">Gestionar Roles</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><i class="bi bi-people"></i> Usuarios</div>
            <div class="card-body">
                <a href="{{ route('admin.usuarios.index') }}" class="btn btn-primary">Gestionar Usuarios</a>
            </div>
        </div>
    </div>
</div>
@endsection
