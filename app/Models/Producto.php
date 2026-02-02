<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'precio'];

    // Relación: Un producto tiene muchos ingredientes (Receta)
    // Ejemplo: 1/4 de Pollo usa -> 0.25 Pollo Entero + 0.3 Papa
    public function insumos()
    {
        return $this->belongsToMany(Insumo::class, 'producto_insumo')
                    ->withPivot('cantidad_necesaria');
    }
}
