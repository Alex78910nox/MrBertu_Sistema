<x-layouts.admin>
    <div class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Registrar Nuevo Insumo</h2>

        <form action="{{ route('admin.insumos.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nombre del Insumo</label>
                <input type="text" name="nombre" class="w-full border rounded px-3 py-2 text-gray-700 focus:border-orange-500 focus:outline-none" placeholder="Ej: Papa Holandesa" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Unidad de Medida</label>
                <select name="unidad_medida" class="w-full border rounded px-3 py-2 text-gray-700 bg-white focus:outline-none focus:border-orange-500">
                    <option value="kg">Kilogramos (kg) - Para carne, papa, arroz</option>
                    <option value="litro">Litros (L) - Para aceite, salsas</option>
                    <option value="unidad">Unidades (u) - Para gaseosas, servilletas</option>
                </select>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.insumos.index') }}" class="text-gray-500 mr-4 mt-2">Cancelar</a>
                <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-6 rounded shadow">Guardar</button>
            </div>
        </form>
    </div>
</x-layouts.admin>