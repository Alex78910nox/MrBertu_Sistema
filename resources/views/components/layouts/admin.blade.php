<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr. Bertu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-100 font-sans">

    <nav class="bg-orange-600 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-drumstick-bite text-white text-2xl mr-2"></i>
                        <span class="font-bold text-white text-lg">Mr. Bertu Panel</span>
                    </div>

                    <div class="hidden md:ml-6 md:flex md:space-x-4 items-center">
                        <a href="{{ route('admin.dashboard') }}" class="text-white hover:bg-orange-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">Dashboard</a>
                        <a href="{{ route('admin.sucursales.index') }}" class="text-orange-100 hover:bg-orange-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">Sucursales</a>
                        <a href="{{ route('admin.users.index') }}" class="text-orange-100 hover:bg-orange-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">Personal</a>
                        <a href="{{ route('admin.insumos.index') }}" class="text-orange-100 hover:bg-orange-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">Insumos</a>
                        <a href="{{ route('admin.inventario.index') }}" class="text-orange-100 hover:bg-orange-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">Inventario</a>
                        <a href="{{ route('admin.productos.index') }}" class="text-orange-100 hover:bg-orange-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">Productos</a>
                    </div>
                </div>

                <div class="hidden md:flex items-center">
                    <span class="text-white text-sm mr-4 font-semibold">{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md text-sm font-medium transition shadow">
                            Salir
                        </button>
                    </form>
                </div>

                <div class="-mr-2 flex items-center md:hidden">
                    <button type="button" onclick="toggleMenu()" class="inline-flex items-center justify-center p-2 rounded-md text-orange-200 hover:text-white hover:bg-orange-700 focus:outline-none transition">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="hidden md:hidden bg-orange-700" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('admin.dashboard') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-orange-800">Dashboard</a>
                <a href="{{ route('admin.sucursales.index') }}" class="text-orange-100 block px-3 py-2 rounded-md text-base font-medium hover:bg-orange-800 hover:text-white">Sucursales</a>
                <a href="{{ route('admin.users.index') }}" class="text-orange-100 block px-3 py-2 rounded-md text-base font-medium hover:bg-orange-800 hover:text-white">Personal</a>
                <a href="{{ route('admin.insumos.index') }}" class="text-orange-100 block px-3 py-2 rounded-md text-base font-medium hover:bg-orange-800 hover:text-white">Insumos</a>
                <a href="{{ route('admin.inventario.index') }}" class="text-orange-100 block px-3 py-2 rounded-md text-base font-medium hover:bg-orange-800 hover:text-white">Inventario</a>
                <a href="{{ route('admin.productos.index') }}" class="text-orange-100 block px-3 py-2 rounded-md text-base font-medium hover:bg-orange-800 hover:text-white">Productos</a>
            </div>
            
            <div class="pt-4 pb-4 border-t border-orange-800">
                <div class="flex items-center px-5">
                    <div class="ml-3">
                        <div class="text-base font-medium leading-none text-white">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium leading-none text-orange-300 mt-1">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 px-2 space-y-1">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-white hover:bg-red-600">
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        {{ $slot }}
    </main>

    <script>
        function toggleMenu() {
            var menu = document.getElementById('mobile-menu');
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
            } else {
                menu.classList.add('hidden');
            }
        }
    </script>
</body>
</html>