<?php

namespace App\Policies;

use App\Enums\TipoUsuarioEnum;
use App\Models\Tienda;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TiendaPolicy
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
    public function view(User $user, Tienda $tienda): Response
    {
        return $tienda->vendedor_id == $user->id
            ? Response::allow()
            : Response::deny('No le pertencece esta tienda', 403);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->tipo == TipoUsuarioEnum::VENDEDOR->value
            ? Response::allow()
            : Response::deny('Solo los vendedores pueden crear tiendas', 403);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Tienda $tienda): Response
    {
        return $tienda->vendedor_id == $user->id
            ? Response::allow()
            : Response::deny('No puede editar una tienda que no le pertenece', 403);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tienda $tienda): Response
    {
        return $tienda->vendedor_id == $user->id
            ? Response::allow()
            : Response::deny('No puede eliminar una tienda que no le pertenece', 403);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Tienda $tienda): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Tienda $tienda): bool
    {
        return false;
    }
}
