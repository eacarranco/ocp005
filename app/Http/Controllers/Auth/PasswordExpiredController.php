<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordExpiredController extends Controller
{
    public function showExpiredForm()
    {
        return view('auth.passwords.expired');
    }

    public function updateExpired(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();

        if ($user->isPasswordReused($request->password)) {
            return back()->withErrors([
                'password' => 'No puedes usar una contraseña que ya hayas utilizado anteriormente.',
            ]);
        }

        $user->password = Hash::make($request->password);
        $user->password_changed_at = now();
        $user->save();

        $user->storePasswordHistory();

        return redirect()->intended(route('cobros.index'))
            ->with('success', 'Contraseña cambiada correctamente.');
    }
}
