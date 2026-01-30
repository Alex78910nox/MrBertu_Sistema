<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Mostrar el formulario
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // 2. Procesar el Login
    public function login(Request $request)
    {
        // a) Validar
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // b) Intentar entrar
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // --- LÓGICA DE REDIRECCIÓN ---
            
            // Si es ADMIN -> Panel General
            if ($user->rol->nombre === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }

            // Si es CAJERO -> Punto de Venta
            if ($user->rol->nombre === 'cajero') {
                return redirect()->intended(route('cajero.dashboard'));
            }

            // Si no tiene rol conocido (por seguridad)
            return redirect('/');
        }

        // c) Si falla la contraseña
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden.',
        ]);
    }

    // 3. Salir
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}