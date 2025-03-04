<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TiendaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'vendedor_id' => $this->vendedor_id,
            'productos' => ProductoResource::collection($this->productos),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
