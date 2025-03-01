<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompraResource;
use App\Models\Compra;
use Illuminate\Support\Facades\Gate;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Compra::class);

        $compras = Compra::where('cliente_id', request()->user()->id)
            ->orderBy('created_at', 'desc')->get();

        return CompraResource::collection($compras);
    }
}
