<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tienda extends Model
{
    /** @use HasFactory<\Database\Factories\TiendaFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'vendedor_id',
        'nombre',
    ];

    /**
     * Obtiene el vendedor de la tienda
     */
    public function vendedor(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
