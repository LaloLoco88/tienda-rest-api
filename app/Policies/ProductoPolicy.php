<?php

namespace App\Policies;

use App\Enums\TipoUsuarioEnum;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->tipo == TipoUsuarioEnum::VENDEDOR->value
            ? Response::allow()
            : Response::deny('Solo los vendedores pueden acceder', 403);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Producto $producto): Response
    {
        if ($user->tipo != TipoUsuarioEnum::VENDEDOR->value) {
            return Response::deny('Solo los vendedores pueden acceder', 403);
        }

        $tiendas = $user->tiendas->pluck('id')->toArray();

        return in_array($producto->tienda_id, $tiendas)
            ? Response::allow()
            : Response::deny('No puede ver los detalles de un producto de una tienda que no le pertence', 403);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->tipo == TipoUsuarioEnum::VENDEDOR->value
            ? Response::allow()
            : Response::deny('Solo los vendedores pueden crear productos', 403);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Producto $producto): Response
    {
        if ($user->tipo != TipoUsuarioEnum::VENDEDOR->value) {
            return Response::deny('Solo los vendedores pueden actualizar los datos de un producto', 403);
        }

        $tiendas = $user->tiendas->pluck('id')->toArray();

        return in_array($producto->tienda_id, $tiendas)
            ? Response::allow()
            : Response::deny('No puede editar un producto de una tienda que no le pertenece', 403);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Producto $producto): Response
    {
        if ($user->tipo != TipoUsuarioEnum::VENDEDOR->value) {
            return Response::deny('Solo los vendedores pueden eliminar productos', 403);
        }

        $tiendas = $user->tiendas->pluck('id')->toArray();

        return in_array($producto->tienda_id, $tiendas)
            ? Response::allow()
            : Response::deny('No puede eliminar un producto de una tienda que no le pertenece', 403);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Producto $producto): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Producto $producto): bool
    {
        return false;
    }
}
