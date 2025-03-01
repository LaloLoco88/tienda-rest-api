<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Compra extends Model
{
    /** @use HasFactory<\Database\Factories\CompraFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'cliente_id',
        'total',
    ];

    /**
     * Obtiene al cliente al que le pertenece el carrito
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Los productos que se compraron
     */
    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class, 'compra_productos')
            ->withPivot('cantidad', 'precio');
    }
}
