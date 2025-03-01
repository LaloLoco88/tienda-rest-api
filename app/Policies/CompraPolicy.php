<?php

namespace App\Policies;

use App\Enums\TipoUsuarioEnum;
use App\Models\Compra;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CompraPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->tipo == TipoUsuarioEnum::CLIENTE->value
            ? Response::allow()
            : Response::deny('Solo los clientes pueden ver el historial de compras', 403);
    }
}
