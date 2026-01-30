<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rol;
use App\Models\Sucursal;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AdminUserController extends Controller
{
    // 1. LISTAR USUARIOS
    public function index()
    {
        // Traemos usuarios con su Rol y Sucursal para no hacer mil consultas
        $users = User::with(['rol', 'sucursal'])->get();
        return view('admin.users.index', compact('users'));
    }

    // 2. MOSTRAR FORMULARIO
    public function create()
    {
        $roles = Rol::all();
        $sucursales = Sucursal::all();
        return view('admin.users.create', compact('roles', 'sucursales'));
    }

    // 3. GUARDAR USUARIO
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'rol_id' => 'required|exists:roles,id',
            'sucursal_id' => 'nullable|exists:sucursales,id', // Puede ser nulo si es Admin
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol_id' => $request->rol_id,
            'sucursal_id' => $request->sucursal_id,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuario creado correctamente.');
    }
    // 4. MOSTRAR FORMULARIO DE EDICIÓN
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Rol::all();
        $sucursales = Sucursal::all();
        
        return view('admin.users.edit', compact('user', 'roles', 'sucursales'));
    }

    // 5. ACTUALIZAR EN BASE DE DATOS
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validamos (el email debe ser único, pero ignorando al usuario actual)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'rol_id' => 'required|exists:roles,id',
            'sucursal_id' => 'nullable|exists:sucursales,id',
        ]);

        // Actualizamos datos básicos
        $user->name = $request->name;
        $user->email = $request->email;
        $user->rol_id = $request->rol_id;
        $user->sucursal_id = $request->sucursal_id;

        // Solo cambiamos contraseña si el admin escribió una nueva
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // 6. ELIMINAR USUARIO
    public function destroy($id)
    {
        // PROTECCIÓN: No eliminar al Super Admin (ID 1) ni a uno mismo
        if ($id == 1 || $id == Auth::id()) {
            return back()->with('error', 'No puedes eliminar a este usuario protegido.');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado correctamente.');
    }
    
}