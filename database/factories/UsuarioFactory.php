<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Entities\Eloquent\Usuario;
use App\Entities\Eloquent\Organismo;

class UsuarioFactory extends Factory
{
    protected $model = Usuario::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name,
            'apellido' => $this->faker->word,
            'email' => $this->faker->safeEmail,
            'fecha_verificacion' => $this->faker->dateTime(),
            'password' => Hash::make($this->faker->password),
            'token' => Str::random(60),
            'admin' => $this->faker->boolean,
            'sexo' => $this->faker->randomElement(['M', 'F']),
            'dni' => $this->faker->numberBetween(1000000,99999999),
            'organismo_id' => Organismo::factory(),
            'telefono' => $this->faker->phoneNumber,
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
            'deleted_at' => null
        ];
    }

    public function sinOrganismo()
    {
        return $this->state([
            'id' => null
        ]);
    }

    public function inactivo()
    {
        return $this->state([
            'deleted_at' => $this->faker->dateTime,
        ]);
    }
}
