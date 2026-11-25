<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PedidoAdminController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EsAdmin;
use App\Models\Producto;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
 
// Después de iniciar sesión, cada rol va a su pantalla
Route::get('/dashboard', function () {
    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.productos.index')
        : redirect()->route('cafeteria');
})->middleware('auth')->name('dashboard');

// Menú para clientes (y también lo puede ver el admin)
Route::get('/cafeteria', function () {
    $productos = Producto::where('activo', 1)->latest()->get();

    return view('cafeteria', compact('productos'));
})->middleware('auth')->name('cafeteria');

// Carrito y pedidos: cualquier usuario con sesión
Route::middleware('auth')->group(function () {
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/agregar/{producto}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::patch('/carrito/{producto}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
    Route::delete('/carrito/{producto}', [CarritoController::class, 'quitar'])->name('carrito.quitar');
    Route::delete('/carrito', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');
    Route::post('/carrito/confirmar', [CarritoController::class, 'confirmar'])->name('carrito.confirmar');
    Route::get('/pedidos', [CarritoController::class, 'pedidos'])->name('pedidos');
});

// Zona del admin: productos y pedidos
Route::middleware(['auth', EsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
        Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
        Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
        Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
        Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');

        Route::get('/pedidos', [PedidoAdminController::class, 'index'])->name('pedidos.index');
        Route::patch('/pedidos/{pedido}', [PedidoAdminController::class, 'actualizar'])->name('pedidos.actualizar');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';