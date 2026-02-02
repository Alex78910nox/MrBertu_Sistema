<x-layouts.admin>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Catálogo de Insumos</h1>
        <a href="{{ route('admin.insumos.create') }}" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded shadow transition">
            <i class="fas fa-box-open mr-2"></i> Nuevo Insumo
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nombre</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Unidad</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($insumos as $insumo)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-bold text-gray-800">
                        {{ $insumo->nombre }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        <span class="bg-gray-200 text-gray-700 py-1 px-3 rounded-full text-xs font-bold">
                            {{ strtoupper($insumo->unidad_medida) }}
                        </span>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        <div class="flex justify-center space-x-3">
                            <a href="{{ route('admin.insumos.edit', $insumo->id) }}" class="text-blue-600 hover:text-blue-900"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.insumos.destroy', $insumo->id) }}" method="POST" onsubmit="return confirm('¿Borrar este insumo del catálogo?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.admin>