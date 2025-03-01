<?php

namespace App\Enums;

enum TipoUsuarioEnum: string
{
    case ADMIN = 'Admin';
    case CLIENTE = 'Cliente';
    case VENDEDOR = 'Vendedor';

    public static function values()
    {
        return array_column(self::cases(), 'value');
    }
}
