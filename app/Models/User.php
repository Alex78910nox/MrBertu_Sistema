<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'rol_id',       // <--- Asegúrate que esto esté aquí
        'sucursal_id',  // <--- Y esto
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- ¡ESTO ES LO QUE TE FALTA! --- (Copia desde aquí)

    // 1. Relación con ROL
    public function rol()
    {
        // Le decimos: "Este usuario pertenece a un Rol"
        // Y especificamos 'rol_id' porque o si no Laravel buscaría 'rol_id' (en inglés role_id)
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    // 2. Relación con SUCURSAL
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }
}
