<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dni' =>fake()->randomNumber(8,true),
            'nombre' =>fake()->name(),
            'apellido' =>fake()->lastName(),
            'telefono' =>fake()->randomNumber(6,true),
            'direccion_calle' =>fake()->name(),
            'direccion_numero' =>fake()->randomNumber(6,true),
            ];
    }
}
