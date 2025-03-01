<?php

namespace Database\Factories;

use App\Models\Tienda;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tienda_id' => Tienda::inRandomOrder()->first()->id,
            'nombre' => $this->faker->word(),
            'precio' => $this->faker->randomFloat(2, 20, 1000),
            'stock' => $this->faker->randomDigit(),
        ];
    }
}
