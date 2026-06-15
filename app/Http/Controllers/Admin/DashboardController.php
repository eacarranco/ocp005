<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CobroPacifico;
use App\Models\EnvioLog;
use App\Models\Role;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalCobros' => CobroPacifico::count(),
            'exportados' => CobroPacifico::whereNotNull('envio_logs_id')->count(),
            'pendientes' => CobroPacifico::whereNull('envio_logs_id')->count(),
            'totalEnvios' => EnvioLog::count(),
            'totalUsuarios' => User::count(),
            'totalRoles' => Role::count(),
        ];

        return view('admin.dashboard', $data);
    }
}
