<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pollería El Sabroso</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-50 h-screen flex justify-center items-center">

    <div class="bg-white p-8 rounded-lg shadow-lg w-96 border-t-4 border-orange-500">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Mr. Bertu</h2>
        
        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Correo Electrónico</label>
                <input type="email" name="email" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-orange-500" required autofocus>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Contraseña</label>
                <input type="password" name="password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-orange-500" required>
            </div>

            @error('email')
                <p class="text-red-500 text-xs italic mb-4">{{ $message }}</p>
            @enderror

            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                Ingresar al Sistema
            </button>
        </form>
    </div>

</body>
</html>