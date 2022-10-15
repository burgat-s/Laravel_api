<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Entities\Eloquent\Zona;
use Modules\Municipalidades\Entities\Municipalidad;

class ZonaFactory extends Factory
{
    protected $model = Zona::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->numberBetween(1, 24),
            'codigo' => $this->faker->unique()->randomLetter,
            'municipalidad_id' => Municipalidad::factory(),
            'estado' => $this->faker->randomElement(['A', 'B']),
            'descripcion' => $this->faker->word,
            'created_at' => $this->faker->dateTime(),
        ];
    }
}
