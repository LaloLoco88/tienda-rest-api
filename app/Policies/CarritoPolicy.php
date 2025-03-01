<?php

namespace App\Policies;

use App\Enums\TipoUsuarioEnum;
use App\Models\Carrito;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CarritoPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): Response
    {
        return $user->tipo == TipoUsuarioEnum::CLIENTE->value
            ? Response::allow()
            : Response::deny('Solo los clientes pueden ver su carrito.', 403);
    }

    public function agregarProducto(User $user): Response
    {
        return $user->tipo == TipoUsuarioEnum::CLIENTE->value
            ? Response::allow()
            : Response::deny('Solo los clientes pueden agregar productos a su carro.', 403);
    }

    public function eliminarProducto(User $user): Response
    {
        return $user->tipo == TipoUsuarioEnum::CLIENTE->value
            ? Response::allow()
            : Response::deny('Solo los clientes pueden quitar productos de su carro.', 403);
    }

    public function comprar(User $user): Response
    {
        return $user->tipo == TipoUsuarioEnum::CLIENTE->value
            ? Response::allow()
            : Response::deny('Solo los clientes pueden quitar productos de su carro.', 403);
    }
}
