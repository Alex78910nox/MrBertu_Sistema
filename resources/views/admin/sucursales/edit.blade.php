<x-layouts.admin>

    <div class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow">
        
        <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">
            Editar Sucursal: <span class="text-orange-600">{{ $sucursal->nombre }}</span>
        </h2>

        <form action="{{ route('admin.sucursales.update', $sucursal->id) }}" method="POST">
            @csrf
            
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nombre de la Sucursal</label>
                <input type="text" name="nombre" 
                       value="{{ old('nombre', $sucursal->nombre) }}" 
                       class="w-full border rounded px-3 py-2 text-gray-700 focus:border-orange-500 focus:outline-none" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Dirección</label>
                <input type="text" name="direccion" 
                       value="{{ old('direccion', $sucursal->direccion) }}"
                       class="w-full border rounded px-3 py-2 text-gray-700 focus:border-orange-500 focus:outline-none">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Teléfono</label>
                <input type="text" name="telefono" 
                       value="{{ old('telefono', $sucursal->telefono) }}"
                       class="w-full border rounded px-3 py-2 text-gray-700 focus:border-orange-500 focus:outline-none">
            </div>

            <div class="flex justify-end items-center">
                <a href="{{ route('admin.sucursales.index') }}" class="text-gray-500 mr-4 hover:text-gray-700 transition">Cancelar</a>
                
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow transition">
                    Actualizar Datos
                </button>
            </div>
        </form>
    </div>

</x-layouts.admin>