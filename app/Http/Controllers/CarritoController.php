<?php

namespace App\Http\Controllers;

use App\Http\Requests\Carrito\AgregarProductoRequest;
use App\Http\Requests\Carrito\EliminarProductoRequest;
use App\Models\Carrito;
use App\Services\CarritoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Carrito $carrito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carrito $carrito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carrito $carrito)
    {
        //
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
}
