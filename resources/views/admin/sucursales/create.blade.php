<x-layouts.admin>

    <div class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Inaugurar Nueva Sucursal</h2>

        <form action="{{ route('admin.sucursales.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nombre de la Sucursal</label>
                <input type="text" name="nombre" class="w-full border rounded px-3 py-2 text-gray-700 focus:border-orange-500 focus:outline-none" placeholder="Ej: Sucursal Zona Sur" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Dirección</label>
                <input type="text" name="direccion" class="w-full border rounded px-3 py-2 text-gray-700 focus:border-orange-500 focus:outline-none" placeholder="Calle Falsa 123">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Teléfono</label>
                <input type="text" name="telefono" class="w-full border rounded px-3 py-2 text-gray-700 focus:border-orange-500 focus:outline-none" placeholder="2-223344">
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.sucursales.index') }}" class="text-gray-500 mr-4 mt-2 hover:text-gray-700">Cancelar</a>
                <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-6 rounded shadow">Guardar</button>
            </div>
        </form>
    </div>

</x-layouts.admin>