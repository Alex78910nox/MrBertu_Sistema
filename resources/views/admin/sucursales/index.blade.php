<x-layouts.admin>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Sucursales</h1>
        <a href="{{ route('admin.sucursales.create') }}" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded shadow transition">
            <i class="fas fa-store mr-2"></i> Nueva Sucursal
        </a>
    </div>

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nombre</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Dirección / Teléfono</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Personal</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sucursales as $sucursal)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-bold text-gray-800">
                        {{ $sucursal->nombre }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900">{{ $sucursal->direccion ?? 'Sin dirección' }}</p>
                        <p class="text-gray-500 text-xs">{{ $sucursal->telefono ?? 'Sin teléfono' }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $sucursal->users_count }} Empleados
                        </span>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        <div class="flex justify-center space-x-3">
                            <a href="{{ route('admin.sucursales.edit', $sucursal->id) }}" class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-edit text-lg"></i>
                            </a>
                            
                            <form action="{{ route('admin.sucursales.destroy', $sucursal->id) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres cerrar esta sucursal?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash-alt text-lg"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-layouts.admin>