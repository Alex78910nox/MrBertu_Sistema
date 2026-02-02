<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminSucursalController;
use App\Http\Controllers\AdminInsumoController;
use App\Http\Controllers\AdminInventarioController;
use App\Http\Controllers\AdminProductoController;

// --- RUTA PÚBLICA (Login) ---
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- RUTAS PROTEGIDAS (Requieren Login) ---
Route::middleware('auth')->group(function () {

    // 1. Rutas de ADMIN (Dueño)
    Route::get('/admin/panel', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    // GESTIÓN DE PERSONAL
    Route::get('/admin/personal', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/personal/crear', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/personal', [AdminUserController::class, 'store'])->name('admin.users.store');

    //NUEVAS RUTAS PARA EDITAR Y ELIMINAR USUARIOS 
    Route::get('/admin/personal/{id}/editar', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/personal/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/personal/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

    // GESTIÓN DE SUCURSALES
    Route::get('/admin/sucursales', [AdminSucursalController::class, 'index'])->name('admin.sucursales.index');
    Route::get('/admin/sucursales/crear', [AdminSucursalController::class, 'create'])->name('admin.sucursales.create');
    Route::post('/admin/sucursales', [AdminSucursalController::class, 'store'])->name('admin.sucursales.store');
    Route::get('/admin/sucursales/{id}/editar', [AdminSucursalController::class, 'edit'])->name('admin.sucursales.edit');
    Route::put('/admin/sucursales/{id}', [AdminSucursalController::class, 'update'])->name('admin.sucursales.update');
    Route::delete('/admin/sucursales/{id}', [AdminSucursalController::class, 'destroy'])->name('admin.sucursales.destroy');

    // GESTIÓN DE INSUMOS
    Route::get('/admin/insumos', [AdminInsumoController::class, 'index'])->name('admin.insumos.index');
    Route::get('/admin/insumos/crear', [AdminInsumoController::class, 'create'])->name('admin.insumos.create');
    Route::post('/admin/insumos', [AdminInsumoController::class, 'store'])->name('admin.insumos.store');
    Route::get('/admin/insumos/{id}/editar', [AdminInsumoController::class, 'edit'])->name('admin.insumos.edit');
    Route::put('/admin/insumos/{id}', [AdminInsumoController::class, 'update'])->name('admin.insumos.update');
    Route::delete('/admin/insumos/{id}', [AdminInsumoController::class, 'destroy'])->name('admin.insumos.destroy');

    // GESTIÓN DE INVENTARIO (ABASTECIMIENTO)
    Route::get('/admin/inventario', [AdminInventarioController::class, 'index'])->name('admin.inventario.index');
    Route::get('/admin/inventario/agregar', [AdminInventarioController::class, 'create'])->name('admin.inventario.create');
    Route::post('/admin/inventario', [AdminInventarioController::class, 'store'])->name('admin.inventario.store');

    // GESTIÓN DEL MENÚ (PRODUCTOS)
    Route::get('/admin/productos', [AdminProductoController::class, 'index'])->name('admin.productos.index');
    Route::get('/admin/productos/crear', [AdminProductoController::class, 'create'])->name('admin.productos.create');
    Route::post('/admin/productos', [AdminProductoController::class, 'store'])->name('admin.productos.store');
    Route::delete('/admin/productos/{id}', [AdminProductoController::class, 'destroy'])->name('admin.productos.destroy');
    
    // 2. Rutas de CAJERO (Ventas)
    Route::get('/cajero/ventas', function () {
        return view('cajero.dashboard');
    })->name('cajero.dashboard');

});