<?php

namespace Database\Seeders;

use App\Entities\Eloquent\EmailTipo;
use Illuminate\Database\Seeder;

class EmailTiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuarios = [
            [
                'nombre' => 'forgot password',
                'subject' => 'Reseteo de Contraseña',
                'template' => 'emails.forgot.forgotPassword',
                'descripcion' => 'Email con link para resetear',
                'estado' => 'A',
            ],
            [
                'nombre' => 'reset password seccess',
                'subject' => 'Reseteo de contraseña',
                'template' => 'emails.forgot.resetPasswordSuccess',
                'descripcion' => 'Email de confirmación de reseteo.',
                'estado' => 'A',
            ]
        ];

        foreach ($usuarios as $usuario) {
            EmailTipo::updateOrCreate($usuario);
        }
    }
}
