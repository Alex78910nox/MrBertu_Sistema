<x-layouts.admin>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Gestión de Personal</h1>
        <a href="{{ route('admin.users.create') }}" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded shadow transition">
            <i class="fas fa-plus mr-2"></i> Nuevo Usuario
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nombre</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Rol</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Sucursal</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-10 h-10">
                                <div class="w-full h-full rounded-full bg-orange-100 flex items-center justify-center text-orange-500 font-bold">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-gray-900 font-semibold">{{ $user->name }}</p>
                                <p class="text-gray-600 text-xs">{{ $user->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <span class="px-2 py-1 font-semibold leading-tight rounded-full {{ $user->rol->nombre == 'admin' ? 'text-purple-700 bg-purple-100' : 'text-green-700 bg-green-100' }}">
                            {{ ucfirst($user->rol->nombre) }}
                        </span>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $user->sucursal ? $user->sucursal->nombre : 'Global' }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        <div class="flex justify-center space-x-2">
                            
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600 hover:text-blue-900" title="Editar">
                                <i class="fas fa-edit text-lg"></i>
                            </a>

                            @if($user->id !== 1 && $user->id !== Auth::id())
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar a {{ $user->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Eliminar">
                                        <i class="fas fa-trash-alt text-lg"></i>
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-400" title="Protegido"><i class="fas fa-lock"></i></span>
                            @endif

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-layouts.admin>