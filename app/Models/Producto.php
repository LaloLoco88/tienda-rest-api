<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
