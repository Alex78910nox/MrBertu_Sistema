<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sucursal;
use App\Models\Insumo;
use App\Models\InventarioSucursal; // Asegúrate de tener este modelo creado

class AdminInventarioController extends Controller
{
    // 1. Ver el stock de una sucursal específica
    public function index(Request $request)
    {
        // Si no selecciona sucursal, cargamos la primera que encuentre o null
        $sucursalId = $request->get('sucursal_id');
        
        $sucursales = Sucursal::all();
        $sucursalSeleccionada = null;
        $inventario = [];

        if ($sucursalId) {
            $sucursalSeleccionada = Sucursal::findOrFail($sucursalId);
            // Usamos la relación que definimos en el Modelo Sucursal
            $inventario = $sucursalSeleccionada->insumos; 
        }

        return view('admin.inventario.index', compact('sucursales', 'sucursalSeleccionada', 'inventario'));
    }

    // 2. Mostrar formulario para agregar stock (Comprar insumos)
    public function create()
    {
        $sucursales = Sucursal::all();
        $insumos = Insumo::orderBy('nombre')->get();
        return view('admin.inventario.create', compact('sucursales', 'insumos'));
    }

    // 3. Guardar el nuevo stock (¡Aquí ocurre la magia del FIFO!)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sucursal_id' => 'required|exists:sucursales,id',
            'insumo_id' => 'required|exists:insumos,id',
            'cantidad' => 'required|integer|min:1',
            'fecha_vencimiento' => 'required|date',
        ], [
            'sucursal_id.required' => 'La sucursal es obligatoria.',
            'sucursal_id.exists' => 'La sucursal seleccionada no existe.',
            'insumo_id.required' => 'El insumo es obligatorio.',
            'insumo_id.exists' => 'El insumo seleccionado no existe.',
            'cantidad.required' => 'La cantidad es obligatoria.',
            'cantidad.integer' => 'La cantidad debe ser un número entero sin decimales.',
            'cantidad.min' => 'La cantidad debe ser mayor a 0.',
            'fecha_vencimiento.required' => 'La fecha de vencimiento es obligatoria.',
            'fecha_vencimiento.date' => 'La fecha de vencimiento debe ser una fecha válida.',
            'fecha_vencimiento.after_or_equal' => 'La fecha de vencimiento debe ser hoy o posterior.',
        ], [
            'sucursal_id' => 'Sucursal',
            'insumo_id' => 'Insumo',
            'cantidad' => 'Cantidad',
            'fecha_vencimiento' => 'Fecha de vencimiento',
        ]);

        // Creamos el registro en la tabla pivote
        // OJO: No usamos update, usamos create porque cada lote es único (FIFO)
        InventarioSucursal::create([
            'sucursal_id' => $validated['sucursal_id'],
            'insumo_id' => $validated['insumo_id'],
            'stock_actual' => $validated['cantidad'], // Al inicio el stock es igual a lo que compraste
            'fecha_ingreso' => now(),
            'fecha_vencimiento' => $validated['fecha_vencimiento'],
        ]);

        return redirect()->route('admin.inventario.index', ['sucursal_id' => $validated['sucursal_id']])
                         ->with('success', 'Stock agregado correctamente.');
    }
}
