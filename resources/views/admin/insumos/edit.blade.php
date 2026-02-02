<x-layouts.admin>

    <div class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow">
        
        <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">
            Editar Insumo: <span class="text-orange-600">{{ $insumo->nombre }}</span>
        </h2>

        <form action="{{ route('admin.insumos.update', $insumo->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nombre del Insumo</label>
                <input type="text" name="nombre" 
                       value="{{ old('nombre', $insumo->nombre) }}" 
                       class="w-full border rounded px-3 py-2 text-gray-700 focus:border-orange-500 focus:outline-none" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Unidad de Medida</label>
                <select name="unidad_medida" class="w-full border rounded px-3 py-2 text-gray-700 bg-white focus:outline-none focus:border-orange-500">
                    
                    <option value="kg" {{ $insumo->unidad_medida == 'kg' ? 'selected' : '' }}>
                        Kilogramos (kg)
                    </option>
                    
                    <option value="litro" {{ $insumo->unidad_medida == 'litro' ? 'selected' : '' }}>
                        Litros (L)
                    </option>
                    
                    <option value="unidad" {{ $insumo->unidad_medida == 'unidad' ? 'selected' : '' }}>
                        Unidades (u)
                    </option>

                </select>
                <p class="text-xs text-gray-500 mt-1">Cuidado al cambiar esto si ya tienes inventario registrado.</p>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.insumos.index') }}" class="text-gray-500 mr-4 mt-2 hover:text-gray-700">Cancelar</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow transition">
                    Actualizar Insumo
                </button>
            </div>

        </form>
    </div>

</x-layouts.admin>