<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sucursal;

class AdminSucursalController extends Controller
{
    public function index()
    {
        // Traemos las sucursales y contamos cuántos usuarios tienen (users_count)
        $sucursales = Sucursal::withCount('users')->get();
        return view('admin.sucursales.index', compact('sucursales'));
    }

    public function create()
    {
        return view('admin.sucursales.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        Sucursal::create($request->all());

        return redirect()->route('admin.sucursales.index')->with('success', 'Sucursal inaugurada correctamente.');
    }

    public function edit($id)
    {
        $sucursal = Sucursal::findOrFail($id);
        return view('admin.sucursales.edit', compact('sucursal'));
    }

    public function update(Request $request, $id)
    {
        $sucursal = Sucursal::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        $sucursal->update($request->all());

        return redirect()->route('admin.sucursales.index')->with('success', 'Datos de sucursal actualizados.');
    }

    public function destroy($id)
    {
        $sucursal = Sucursal::withCount('users')->findOrFail($id);

        // PROTECCIÓN: Si hay empleados asignados, NO borrar.
        if ($sucursal->users_count > 0) {
            return back()->with('error', 'No puedes cerrar esta sucursal porque tiene ' . $sucursal->users_count . ' empleados asignados. Reasígnalos primero.');
        }

        $sucursal->delete();
        return redirect()->route('admin.sucursales.index')->with('success', 'Sucursal cerrada permanentemente.');
    }
}
