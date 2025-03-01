<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Carrito extends Model
{
    /** @use HasFactory<\Database\Factories\CarritoFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'cliente_id',
    ];

    /**
     * Obtiene al cliente al que le pertenece el carrito
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtiene los productos dentro de un carrito
     */
    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class, 'carrito_productos')
            ->withPivot('cantidad');
    }
}
