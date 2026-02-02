<x-layouts.admin>

    <div class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Registrar Entrada de Mercadería</h2>

        <form action="{{ route('admin.inventario.store') }}" method="POST">
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                <p class="font-bold">¡Atención!</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Sucursal de Destino</label>
                <select name="sucursal_id" class="w-full border rounded px-3 py-2 text-gray-700 focus:outline-none focus:border-orange-500 @error('sucursal_id') border-red-500 @enderror" required>
                    <option value="">-- Selecciona una sucursal --</option>
                    @foreach($sucursales as $suc)
                        <option value="{{ $suc->id }}" @selected(old('sucursal_id') == $suc->id)>{{ $suc->nombre }}</option>
                    @endforeach
                </select>
                @error('sucursal_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Insumo</label>
                <select name="insumo_id" class="w-full border rounded px-3 py-2 text-gray-700 focus:outline-none focus:border-orange-500 @error('insumo_id') border-red-500 @enderror" required>
                    <option value="">-- Selecciona un insumo --</option>
                    @foreach($insumos as $insumo)
                        <option value="{{ $insumo->id }}" @selected(old('insumo_id') == $insumo->id)>
                            {{ $insumo->nombre }} ({{ $insumo->unidad_medida }})
                        </option>
                    @endforeach
                </select>
                @error('insumo_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Cantidad Comprada</label>
                    <input type="number" step="1" min="1" name="cantidad" value="{{ old('cantidad') }}" class="w-full border rounded px-3 py-2 text-gray-700 focus:outline-none focus:border-orange-500 @error('cantidad') border-red-500 @enderror" placeholder="Ej: 50" required>
                    @error('cantidad')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Fecha de Vencimiento</label>
                    <input type="date" name="fecha_vencimiento" value="{{ old('fecha_vencimiento') }}" class="w-full border rounded px-3 py-2 text-gray-700 focus:outline-none focus:border-orange-500 @error('fecha_vencimiento') border-red-500 @enderror" required>
                    @error('fecha_vencimiento')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">Mira la etiqueta del empaque.</p>
                </div>
            </div>

            <div class="flex justify-end mt-2">
                <a href="{{ route('admin.inventario.index') }}" class="text-gray-500 mr-4 mt-2">Cancelar</a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded shadow">
                    Guardar Stock
                </button>
            </div>
        </form>
    </div>

</x-layouts.admin>