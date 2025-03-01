<?php

namespace App\Services;

use App\Models\Carrito;
use App\Models\Compra;
use App\Models\Producto;
use Illuminate\Http\Exceptions\HttpResponseException;

class CarritoService
{
    /**
     * Agregar un producto al carrito
     */
    public function agregarProducto(array $datos): Carrito
    {
        $producto = Producto::find($datos['producto_id']);

        if ($producto->stock < $datos['cantidad']) {
            throw new HttpResponseException(response()->json([
                'message' => 'Error.',
                'errors' => [
                    'cantidad' => ['Stock insuficiente para este producto.'],
                ],
            ], 400));
        }

        $carrito = $this->obtenerCarritoActivo();

        if (is_null($carrito)) {
            $carrito = $this->crearCarrito();
        }

        $productoEnCarrito = $carrito->productos
            ->where('producto_id', $producto->id)
            ->first();

        if (isset($productoEnCarrito)) {
            $productoEnCarrito->pivot->cantidad += $datos['cantidad'];
            $productoEnCarrito->pivot->save();
        } else {
            $carrito->productos()->attach($producto->id, ['cantidad' => $datos['cantidad']]);
        }

        return $carrito;
    }

    /**
     * Remover un producto dentro del carrito
     */
    public function eliminarProducto(array $datos): void
    {
        $carrito = $this->obtenerCarritoActivo();

        if (is_null($carrito)) abort(404, "No hay un carrito activo");

        $carrito->productos()->detach($datos['producto_id']);

        if ($carrito->productos->count() == 0) {
            $this->eliminarCarrito($carrito);
        }
    }

    /**
     * Comprar los productos de un carrito
     */
    public function comprarCarrito(): void
    {
        $carrito = $this->obtenerCarritoActivo();

        if (is_null($carrito)) abort(404, "No hay un carrito activo");

        // Verificar el stock de cada producto
        foreach ($carrito->productos as $producto) {
            if ($producto->stock < $producto->pivot->cantidad) {
                throw new HttpResponseException(response()->json([
                    'message' => 'Error.',
                    'errors' => [
                        'cantidad' => ['Stock insuficiente para el producto ' . $producto->nombre],
                    ],
                ], 400));
            }
        }

        // Crear la compra
        $compra = Compra::create([
            'cliente_id' => $carrito->cliente_id,
            'total' => $carrito->productos->sum(function ($producto) {
                return $producto->precio * $producto->pivot->cantidad;
            }),
        ]);

        // Agregar productos a la compra y descontar el stock
        foreach ($carrito->productos as $producto) {
            $compra->productos()->attach($producto->id, [
                'cantidad' => $producto->pivot->cantidad,
                'precio' => $producto->precio,
            ]);

            $producto->stock -= $producto->pivot->cantidad;
            $producto->save();
        }

        $this->eliminarCarrito($carrito);
    }

    /**
     * Se obtienen todas la tiendas de un usuario vendedor
     */
    public function obtenerCarritoActivo(): ?Carrito
    {
        return Carrito::where('cliente_id', request()->user()->id)->first();
    }

    /**
     * Se crea una tienda para el usuario vendedor
     */
    protected function crearCarrito(): Carrito
    {
        return Carrito::create([
            'cliente_id' => request()->user()->id,
        ]);
    }

    /**
     * Eliminar un carrito
     */
    protected function eliminarCarrito(Carrito $carrito): void
    {
        $carrito->productos()->detach();
        $carrito->delete();
    }
}
