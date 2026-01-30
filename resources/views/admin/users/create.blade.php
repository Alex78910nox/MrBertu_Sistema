<x-layouts.admin>

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
        
        <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Registrar Nuevo Empleado</h2>

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nombre Completo</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2 text-gray-700 focus:outline-none focus:border-orange-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Correo Electrónico</label>
                <input type="email" name="email" class="w-full border rounded px-3 py-2 text-gray-700 focus:outline-none focus:border-orange-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Contraseña Inicial</label>
                <input type="password" name="password" class="w-full border rounded px-3 py-2 text-gray-700 focus:outline-none focus:border-orange-500" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Rol</label>
                    <select name="rol_id" class="w-full border rounded px-3 py-2 text-gray-700 bg-white focus:outline-none focus:border-orange-500">
                        @foreach($roles as $rol)
                            <option value="{{ $rol->id }}">{{ ucfirst($rol->nombre) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Asignar a Sucursal</label>
                    <select name="sucursal_id" class="w-full border rounded px-3 py-2 text-gray-700 bg-white focus:outline-none focus:border-orange-500">
                        <option value="">-- Ninguna (Solo para Admins) --</option>
                        @foreach($sucursales as $sucursal)
                            <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Si es cajero, es obligatorio elegir sucursal.</p>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">Cancelar</a>
                <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                    Guardar Usuario
                </button>
            </div>

        </form>
    </div>

</x-layouts.admin>