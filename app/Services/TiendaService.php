<?php

namespace App\Services;

use App\Models\Tienda;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class TiendaService
{
    /**
     * Se obtienen todas la tiendas de un usuario vendedor
     */
    public function obtenerTiendas(User $user): Collection
    {
        return Tienda::where('vendedor_id', $user->id)->get();
    }

    /**
     * Se crea una tienda para el usuario vendedor
     */
    public function crearTienda(array $datos): Tienda
    {
        return Tienda::create([
            'nombre' => $datos['nombre'],
            'vendedor_id' => request()->user()->id,
        ]);
    }

    /**
     * Se actualizan los datos de una tienda de un usuario vendedor
     */
    public function actualizarTienda(Tienda $tienda, array $datos): void
    {
        $tienda->update([
            'nombre' => $datos['nombre']
        ]);
    }

    /**
     * Se elimina una tienda de un usuario vendedor
     */
    public function eliminarTienda(Tienda $tienda): void
    {
        $tienda->delete();
    }
}
