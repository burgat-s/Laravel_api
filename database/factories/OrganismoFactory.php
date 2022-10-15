<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Entities\Eloquent\Organismo;
use App\Entities\Eloquent\Municipalidad;
use App\Entities\Eloquent\Zona;

class OrganismoFactory extends Factory
{
    protected $model = Organismo::class;

    public function definition(): array
    {
        $orgDescripcion = $this->faker->word;
        return [
            'estado' => $this->faker->randomElement(['A', 'B']),
            'descripcion' => $orgDescripcion,
            'slug' => \Illuminate\Support\Str::slug($orgDescripcion),
            'cuit' => $this->faker->numberBetween("10000000000", "99999999999"),
            'municipalidad_id' => Municipalidad::factory(),
            'calle' => $this->faker->streetName,
            'calle_numero' => $this->faker->numberBetween(0, 99999),
            'piso' => $this->faker->numberBetween(0,127),
            'torre' => $this->faker->numberBetween(0,127),
            'codigo_postal' => $this->faker->postcode,
            'situacion_iva' => $this->faker->randomElement(['Exento', 'Responsable Inscripto']),
            'codigo_area_1' => $this->faker->numberBetween(0,9999),
            'numero_telefono_1' => $this->faker->numberBetween(100000000,999999999),
            'codigo_area_2' => $this->faker->numberBetween(0,9999),
            'numero_telefono_2' => $this->faker->numberBetween(100000000,999999999),
            'email' => $this->faker->email,
            'ciudad' => $this->faker->text,
            'zona_id' => Zona::factory(),
        ];
    }
}
