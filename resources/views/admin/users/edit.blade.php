<x-layouts.admin>

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
        
        <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Editar Usuario: {{ $user->name }}</h2>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT') <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nombre Completo</label>
                <input type="text" name="name" value="{{ $user->name }}" class="w-full border rounded px-3 py-2 text-gray-700 focus:outline-none focus:border-orange-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Correo Electrónico</label>
                <input type="email" name="email" value="{{ $user->email }}" class="w-full border rounded px-3 py-2 text-gray-700 focus:outline-none focus:border-orange-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nueva Contraseña (Opcional)</label>
                <input type="password" name="password" class="w-full border rounded px-3 py-2 text-gray-700 focus:outline-none focus:border-orange-500" placeholder="Dejar en blanco para mantener la actual">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Rol</label>
                    <select name="rol_id" class="w-full border rounded px-3 py-2 text-gray-700 bg-white">
                        @foreach($roles as $rol)
                            <option value="{{ $rol->id }}" {{ $user->rol_id == $rol->id ? 'selected' : '' }}>
                                {{ ucfirst($rol->nombre) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Sucursal</label>
                    <select name="sucursal_id" class="w-full border rounded px-3 py-2 text-gray-700 bg-white">
                        <option value="">-- Ninguna (Solo Admin) --</option>
                        @foreach($sucursales as $sucursal)
                            <option value="{{ $sucursal->id }}" {{ $user->sucursal_id == $sucursal->id ? 'selected' : '' }}>
                                {{ $sucursal->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">Cancelar</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition">
                    Actualizar Datos
                </button>
            </div>

        </form>
    </div>

</x-layouts.admin>