<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Insumo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 
        'unidad_medida', // kg, litro, unidad
    ];

    public function sucursales()
    {
        return $this->belongsToMany(Sucursal::class, 'inventario_sucursal')
                    ->withPivot('stock_actual', 'fecha_ingreso', 'fecha_vencimiento');
    }
}
