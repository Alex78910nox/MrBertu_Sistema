<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Rol;
use App\Models\Sucursal;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Insumo;
use App\Models\InventarioSucursal; // Asegúrate de importar esto

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Roles
        $rolAdmin = Rol::create(['nombre' => 'admin']);
        $rolCajero = Rol::create(['nombre' => 'cajero']);

        // 2. Sucursal
        $sucursal = Sucursal::create(['nombre' => 'El Sabroso - Centro']);

        // 3. Usuario Admin (Patrón)
        User::create([
            'name' => 'Patrón',
            'email' => 'admin@pollos.com',
            'password' => Hash::make('12345678'),
            'rol_id' => $rolAdmin->id,
            'sucursal_id' => null, // El admin no tiene sucursal fija
        ]);
        
        // 4. Usuario Cajero
         User::create([
            'name' => 'Juan Cajero',
            'email' => 'cajero@pollos.com',
            'password' => Hash::make('12345678'),
            'rol_id' => $rolCajero->id,
            'sucursal_id' => $sucursal->id,
        ]);
    }
}