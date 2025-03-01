<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TiendaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tiendas', TiendaController::class);
    Route::apiResource('productos', ProductoController::class);

    Route::post('/carrito/agregar', [CarritoController::class, 'agregarProducto'])->name('carrito.agregar');
    Route::post('/carrito/eliminar', [CarritoController::class, 'eliminarProducto'])->name('carrito.eliminar');
    Route::post('/carrito/comprar', [CarritoController::class, 'comprar'])->name('carrito.comprar');
    Route::get('/carrito', [CarritoController::class, 'show'])->name('carrito.show');

    Route::get('/compras', [CompraController::class, 'index'])->name('compra.historial');
});
