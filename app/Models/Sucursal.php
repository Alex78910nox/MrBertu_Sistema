<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = 'sucursales'; // <--- Importante

    protected $fillable = ['nombre', 'direccion', 'telefono'];
    // --- AGREGA ESTA FUNCIÓN QUE FALTA ---
    public function users()
    {
        // Una Sucursal TIENE MUCHOS Usuarios (Cajeros)
        return $this->hasMany(User::class);
    }
    // Relación con Insumos (Inventario)
    public function insumos()
    {
        return $this->belongsToMany(Insumo::class, 'inventario_sucursal')
                    ->withPivot('stock_actual', 'stock_minimo', 'fecha_ingreso', 'fecha_vencimiento');
    }
    // Relación con Ventas (Opcional, pero útil a futuro)
    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
}
