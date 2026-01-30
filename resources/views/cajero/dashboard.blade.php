<!DOCTYPE html>
<html>
<body style="font-family: sans-serif; padding: 20px; background-color: #f0fdf4;">
    <h1>🛒 Punto de Venta: {{ Auth::user()->sucursal->nombre }}</h1>
    <p>Hola Cajero: {{ Auth::user()->name }}</p>
    <p>Aquí registrarás los pedidos de pollos y papas.</p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Cerrar Turno</button>
    </form>
</body>
</html>