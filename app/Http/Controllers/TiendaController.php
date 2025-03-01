<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tienda\StoreTiendaRequest;
use App\Http\Requests\Tienda\UpdateTiendaRequest;
use App\Http\Resources\TiendaResource;
use App\Models\Tienda;
use App\Services\TiendaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class TiendaController extends Controller
{
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct(
        protected TiendaService $tiendaService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Tienda::class);

        $tiendas = $this->tiendaService->obtenerTiendas(request()->user());

        return TiendaResource::collection($tiendas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTiendaRequest $request): JsonResponse
    {
        Gate::authorize('create', Tienda::class);

        $tienda = $this->tiendaService->crearTienda($request->validated());

        return response()->json([
            'message' => 'Tienda creada con éxito.',
            'data' => $tienda,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tienda $tienda)
    {
        Gate::authorize('view', $tienda);

        return new TiendaResource($tienda);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTiendaRequest $request, Tienda $tienda): JsonResponse
    {
        Gate::authorize('update', $tienda);

        $this->tiendaService->actualizarTienda($tienda, $request->validated());

        return response()->json([
            'message' => 'Tienda actualizada con éxito.',
            'data' => $tienda->fresh(),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tienda $tienda): JsonResponse
    {
        Gate::authorize('delete', $tienda);

        $this->tiendaService->eliminarTienda($tienda);

        return response()->json([
            'message' => 'Tienda eliminada con éxito.'
        ], 200);
    }
}
