<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $usuarios = [
            [
                "nombre" => "admin name",
                "email" => "admin@admin.com",
                "fecha_verificacion" => "2020-02-20 12:02:53.0",
                "password" => Hash::make(12345),
                "admin" => 1,
                "sexo" => "M",
            ]
        ];

        foreach ($usuarios as $usuario) {
            User::updateOrCreate($usuario);
        }
    }
}
