<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CobroPacificoController;
use App\Http\Controllers\ConsultarController;
use App\Http\Controllers\EnvioLogController;
use Illuminate\Support\Facades\Route;

// Autenticación
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::redirect('/', '/cobros');

Route::middleware('auth')->group(function () {

    // Admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('permission:admin.roles.ver|admin.usuarios.ver');
        Route::resource('roles', RoleController::class)->except(['show'])->middleware('permission:admin.roles.*');
        Route::resource('usuarios', UserController::class)->except(['show'])->middleware('permission:admin.usuarios.*');
    });

    // Cobros
    Route::get('/cobros', [CobroPacificoController::class, 'index'])->name('cobros.index')->middleware('permission:cobros.listar');
    Route::get('/cobros/create', [CobroPacificoController::class, 'create'])->name('cobros.create')->middleware('permission:cobros.ver');
    Route::post('/cobros', [CobroPacificoController::class, 'store'])->name('cobros.store')->middleware('permission:cobros.crear');
    Route::get('/cobros/{cobro}/edit', [CobroPacificoController::class, 'edit'])->name('cobros.edit')->middleware('permission:cobros.editar');
    Route::match(['put', 'patch'], '/cobros/{cobro}', [CobroPacificoController::class, 'update'])->name('cobros.update')->middleware('permission:cobros.actualizar');
    Route::delete('/cobros/{cobro}', [CobroPacificoController::class, 'destroy'])->name('cobros.destroy')->middleware('permission:cobros.eliminar');
    Route::post('/cobros/bulk-destroy', [CobroPacificoController::class, 'bulkDestroy'])->name('cobros.bulkDestroy')->middleware('permission:cobros.eliminar-masivo');
    Route::get('/cobros/export', [CobroPacificoController::class, 'export'])->name('cobros.export')->middleware('permission:cobros.exportar-pendientes|cobros.exportar-seleccionados');

    // Consultar
    Route::get('/consultar', [ConsultarController::class, 'index'])->name('consultar.index')->middleware('permission:consultar.ver');
    Route::get('/consultar/obtener', [ConsultarController::class, 'obtener'])->name('consultar.obtener')->middleware('permission:consultar.obtener');
    Route::post('/consultar/guardar', [ConsultarController::class, 'guardar'])->name('consultar.guardar')->middleware('permission:consultar.guardar');

    // Envíos
    Route::get('/envios', [EnvioLogController::class, 'index'])->name('envios.index')->middleware('permission:envios.listar');
    Route::get('/envios/{envio}/regenerate', [EnvioLogController::class, 'regenerate'])->name('envios.regenerate')->middleware('permission:envios.regenerar');
    Route::delete('/envios/{envio}', [EnvioLogController::class, 'destroy'])->name('envios.destroy')->middleware('permission:envios.eliminar');
});
