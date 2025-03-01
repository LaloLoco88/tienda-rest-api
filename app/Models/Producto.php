<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'tienda_id',
        'nombre',
        'precio',
        'stock',
    ];

    /**
     * Obtiene la tienda en donde se venden los productos
     */
    public function tienda(): BelongsTo
    {
        return $this->belongsTo(Tienda::class);
    }

    /**
     * Todos los carritos en los que aparece el producto
     */
    public function carritos(): BelongsToMany
    {
        return $this->belongsToMany(Carrito::class, 'carrito_productos')
            ->withPivot('cantidad');
    }

    /**
     * Todas las compras en las que aparece el producto
     */
    public function compras(): BelongsToMany
    {
        return $this->belongsToMany(Compra::class, 'compra_productos')
            ->withPivot('cantidad', 'precio');
    }
}
