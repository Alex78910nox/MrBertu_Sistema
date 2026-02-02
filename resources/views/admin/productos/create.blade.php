<x-layouts.admin>
    <div class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Agregar Plato al Menú</h2>

        <form action="{{ route('admin.productos.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nombre del Producto</label>
                <input type="text" name="nombre" class="w-full border rounded px-3 py-2 text-gray-700 focus:outline-none focus:border-orange-500" placeholder="Ej: 1/4 de Pollo con Papas" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Precio (Bs.)</label>
                <input type="number" step="0.50" name="precio" class="w-full border rounded px-3 py-2 text-gray-700 focus:outline-none focus:border-orange-500" placeholder="Ej: 25.00" required>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.productos.index') }}" class="text-gray-500 mr-4 mt-2">Cancelar</a>
                <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-6 rounded shadow">Guardar en el Menú</button>
            </div>
        </form>
    </div>
</x-layouts.admin>