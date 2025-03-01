<?php

namespace App\Http\Controllers;

use App\Http\Requests\Carrito\AgregarProductoRequest;
use App\Http\Requests\Carrito\EliminarProductoRequest;
use App\Http\Resources\CarritoResource;
use App\Models\Carrito;
use App\Services\CarritoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class CarritoController extends Controller
{
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct(
        protected CarritoService $carritoService
    ) {}

    /**
     * Display the specified resource.
     */
    public function show()
    {
        Gate::authorize('view', Carrito::class);

        $carrito = $this->carritoService->obtenerCarritoActivo();

        return new CarritoResource($carrito);
    }

    /**
     * Agregar producto a un carrito
     */
    public function agregarProducto(AgregarProductoRequest $request): JsonResponse
    {
        Gate::authorize('agregarProducto', Carrito::class);

        $carrito = $this->carritoService->agregarProducto($request->validated());

        return response()->json([
            'message' => 'Productos agregados con éxito.',
            'data' => $carrito
        ], 200);
    }

    /**
     * Eliminar producto de un carrito
     */
    public function eliminarProducto(EliminarProductoRequest $request): JsonResponse
    {
        Gate::authorize('eliminarProducto', Carrito::class);

        $this->carritoService->eliminarProducto($request->validated());

        return response()->json([
            'message' => 'Productos eliminados con éxito.',
        ], 200);
    }

    /**
     * Hacer la compra de un carrito
     */
    public function comprar(): JsonResponse
    {
        Gate::authorize('comprar', Carrito::class);

        $this->carritoService->comprarCarrito();

        return response()->json([
            'message' => 'Compra realizada con éxito.',
        ], 201);
    }
}
