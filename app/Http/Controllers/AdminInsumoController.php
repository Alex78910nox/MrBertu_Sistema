<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insumo;

class AdminInsumoController extends Controller
{
    public function index()
    {
        $insumos = Insumo::orderBy('nombre')->get();
        return view('admin.insumos.index', compact('insumos'));
    }

    public function create()
    {
        return view('admin.insumos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:insumos,nombre',
            'unidad_medida' => 'required|in:kg,litro,unidad', // Validamos que elija una válida
        ]);

        Insumo::create($request->all());

        return redirect()->route('admin.insumos.index')->with('success', 'Insumo registrado exitosamente.');
    }

    public function edit($id)
    {
        $insumo = Insumo::findOrFail($id);
        return view('admin.insumos.edit', compact('insumo'));
    }

    public function update(Request $request, $id)
    {
        $insumo = Insumo::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255|unique:insumos,nombre,'.$id,
            'unidad_medida' => 'required|in:kg,litro,unidad',
        ]);

        $insumo->update($request->all());

        return redirect()->route('admin.insumos.index')->with('success', 'Insumo actualizado.');
    }

    public function destroy($id)
    {
        // OJO: Aquí más adelante validaremos que no se borre si tiene stock
        $insumo = Insumo::findOrFail($id);
        $insumo->delete();
        return redirect()->route('admin.insumos.index')->with('success', 'Insumo eliminado.');
    }
}
