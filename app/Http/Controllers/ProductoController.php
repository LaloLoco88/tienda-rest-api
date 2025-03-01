<?php

namespace App\Http\Controllers;

use App\Http\Requests\Producto\StoreProductoRequest;
use App\Http\Requests\Producto\UpdateProductoRequest;
use App\Http\Resources\ProductoResource;
use App\Models\Producto;
use App\Services\ProductoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductoController extends Controller
{
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct(
        protected ProductoService $productoService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Producto::class);

        if ($request->query("tienda")) {
            $productos = $this->productoService->obtenerProductosTienda($request->tienda);
        } else {
            $productos = $this->productoService->obtenerProductos($request->user());
        }

        return ProductoResource::collection($productos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $request)
    {
        Gate::authorize('create', Producto::class);

        $producto = $this->productoService->crearProducto($request->validated());

        return response()->json([
            'message' => 'Producto creado con éxito.',
            'data' => $producto,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        Gate::authorize('view', $producto);

        return new ProductoResource($producto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        Gate::authorize('update', $producto);

        $this->productoService->actualizarProducto($producto, $request->validated());

        return response()->json([
            'message' => 'Producto actualizado con éxito.',
            'data' => $producto->fresh(),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        Gate::authorize('delete', $producto);

        $this->productoService->eliminarProducto($producto);

        return response()->json([
            'message' => 'Producto eliminado con éxito.'
        ], 200);
    }
}
