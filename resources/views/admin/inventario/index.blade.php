<x-layouts.admin>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Control de Inventario</h1>
        <a href="{{ route('admin.inventario.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow transition">
            <i class="fas fa-cart-plus mr-2"></i> Registrar Compra
        </a>
    </div>

    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <form action="{{ route('admin.inventario.index') }}" method="GET" class="flex items-center">
            <label class="font-bold text-gray-700 mr-4">Selecciona una Sucursal:</label>
            <select name="sucursal_id" onchange="this.form.submit()" class="border rounded px-3 py-2 text-gray-700 bg-gray-50 focus:outline-none focus:border-orange-500 w-64">
                <option value="">-- Elige una opción --</option>
                @foreach($sucursales as $suc)
                    <option value="{{ $suc->id }}" {{ isset($sucursalSeleccionada) && $sucursalSeleccionada->id == $suc->id ? 'selected' : '' }}>
                        {{ $suc->nombre }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    @if($sucursalSeleccionada)
        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Insumo</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Cantidad (Stock)</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Fecha Vencimiento</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inventario as $item)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-bold text-gray-800">
                                {{ $item->nombre }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ intval($item->pivot->stock_actual) }} {{ $item->unidad_medida }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ \Carbon\Carbon::parse($item->pivot->fecha_vencimiento)->format('d/m/Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-5 py-5 bg-white text-center text-gray-500">
                                La nevera está vacía. ¡Registra una compra!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-10 bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg">
            <p class="text-gray-500 text-lg">Selecciona una sucursal arriba para ver su inventario.</p>
        </div>
    @endif

</x-layouts.admin>