<?php

namespace App\Services;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ProductoService
{
    /**
     * Se obtienen todos los productos de un vendedor en sus tiendas
     */
    public function obtenerProductos(User $user): Collection
    {
        $tiendas = $user->tiendas->pluck('id')->toArray();

        return Producto::whereIn('tienda_id', $tiendas)->get();
    }

    /**
     * Se obtienen todos los productos de una tienda
     */
    public function obtenerProductosTienda(string $tienda_id): Collection
    {
        return Producto::where('tienda_id', $tienda_id)->get();
    }

    /**
     * Se crea una tienda para el usuario vendedor
     */
    public function crearProducto(array $datos): Producto
    {
        return Producto::create($datos);
    }

    /**
     * Se actualizan los datos de una tienda de un usuario vendedor
     */
    public function actualizarProducto(Producto $producto, array $datos): void
    {
        $producto->update($datos);
    }

    /**
     * Se elimina una tienda de un usuario vendedor
     */
    public function eliminarProducto(Producto $producto): void
    {
        $producto->delete();
    }
}
