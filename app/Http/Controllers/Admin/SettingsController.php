<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $expiryDays = Setting::getValue('password_expiry_days', '90');
        return view('admin.settings.index', compact('expiryDays'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'password_expiry_days' => 'required|integer|min:1|max:365',
        ]);

        Setting::setValue('password_expiry_days', $validated['password_expiry_days']);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Configuración actualizada. La contraseña expirará cada ' . $validated['password_expiry_days'] . ' días.');
    }
}
