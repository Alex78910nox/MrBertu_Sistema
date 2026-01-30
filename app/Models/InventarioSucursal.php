<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventarioSucursal extends Model
{
    use HasFactory;

    protected $table = 'inventario_sucursal';

    protected $fillable = [
        'sucursal_id', 
        'insumo_id', 
        'stock_actual', 
        'fecha_ingreso', 
        'fecha_vencimiento'
    ];
}
