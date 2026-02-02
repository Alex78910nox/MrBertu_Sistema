<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. TABLAS DEL SISTEMA DE LOGIN (Laravel Default)
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // 2. ROLES (Admin, Cajero, Cocinero)
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); 
            $table->timestamps();
        });

        // 3. SUCURSALES (Tus tiendas físicas)
        Schema::create('sucursales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->timestamps();
        });

        // 4. USUARIOS (Con rol y sucursal asignada)
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rol_id')->constrained('roles');
            // Un admin puede no tener sucursal (null), un cajero sí debería tener
            $table->foreignId('sucursal_id')->nullable()->constrained('sucursales');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // 5. INSUMOS (Materia Prima: Pollo Crudo, Papa Cruda, Aceite, Gaseosa)
        Schema::create('insumos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); 
            $table->string('unidad_medida'); // KG, UNIDAD, LITRO
            $table->decimal('stock_minimo_global', 10, 3)->default(10); // Alerta general
            $table->timestamps();
        });

        // 6. INVENTARIO POR LOTES (La clave para productos perecederos)
        // Permite tener "Pollo que vence hoy" y "Pollo que vence mañana" separados
        Schema::create('inventario_sucursal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sucursal_id')->constrained('sucursales')->onDelete('cascade');
            $table->foreignId('insumo_id')->constrained('insumos')->onDelete('cascade');
            
            $table->decimal('stock_actual')->default(0); 
            $table->date('fecha_ingreso');     
            $table->date('fecha_vencimiento'); // Dato crítico para no vender comida podrida
            
            $table->timestamps();
        });

        // 7. MERMAS (Registro de pérdidas)
        Schema::create('mermas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sucursal_id')->constrained('sucursales');
            $table->foreignId('insumo_id')->constrained('insumos');
            $table->foreignId('user_id')->constrained('users'); // Quién reporta la pérdida
            
            $table->decimal('cantidad', 10, 3);
            $table->string('motivo'); // "Vencimiento", "Accidente", "Mala Calidad"
            $table->date('fecha');
            $table->timestamps();
        });

        // 8. CATEGORIAS DEL MENÚ
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Platos, Bebidas, Extras
            $table->timestamps();
        });

        // 9. PRODUCTOS (Lo que sale en la carta/menú)
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->string('nombre'); // "1/4 Pollo a la Brasa"
            $table->decimal('precio', 10, 2);
            $table->string('imagen')->nullable();
            
            // Si es compuesto (True), usa receta. Si es False (como una Gaseosa), descuenta directo.
            $table->boolean('es_compuesto')->default(false); 
            $table->timestamps();
        });

        // 10. RECETAS (Escandallo)
        // Conecta el Producto del menú con los Insumos del inventario
        Schema::create('recetas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->foreignId('insumo_id')->constrained('insumos')->onDelete('cascade');
            
            // Cuánto insumo se gasta para 1 plato
            // Ej: 0.25 pollos, 0.200 kg papas
            $table->decimal('cantidad_necesaria', 10, 3); 
            $table->timestamps();
        });

        // 11. VENTAS (Cabecera)
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sucursal_id')->constrained('sucursales');
            $table->foreignId('user_id')->constrained('users'); // Cajero
            
            $table->decimal('total', 10, 2);
            
            // Facturación
            $table->string('cliente_nombre')->default('Sin Nombre');
            $table->string('cliente_nit')->nullable();
            $table->string('tipo_comprobante')->default('ticket'); // ticket, factura
            
            // Pasarela de Pagos
            $table->string('metodo_pago')->default('efectivo'); // efectivo, tarjeta, qr
            $table->string('estado_pago')->default('pagado'); // pendiente, pagado
            $table->string('transaccion_id')->nullable(); 
            
            $table->date('fecha_venta'); // Para cortes de caja diarios
            $table->timestamps(); // Hora y minuto exacto
        });

        // 12. DETALLE DE VENTA
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_id')->constrained('ventas')->onDelete('cascade');
            $table->foreignId('producto_id')->constrained('productos');
            
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // El orden de borrado es vital (de abajo hacia arriba)
        Schema::dropIfExists('detalle_ventas');
        Schema::dropIfExists('ventas');
        Schema::dropIfExists('recetas');
        Schema::dropIfExists('productos');
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('mermas');
        Schema::dropIfExists('inventario_sucursal');
        Schema::dropIfExists('insumos');
        Schema::dropIfExists('users');
        Schema::dropIfExists('sucursales');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
    }
};