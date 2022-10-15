<?php

namespace Modules\Organismos\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Organismos\Entities\Organismo;

class OrganismosDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        $organismos = [];
        for ($i=1; $i <= 10; $i++) {
            $organismos[] = [
                "descripcion" => "Organismo {$i}",
                "slug" => "organismo-{$i}",
                "cuit" => "12121212121",
                "calle" => "Avenida Siempre Viva {$i}",
                "calle_numero" => $i,
                "piso" => null,
                "torre" => null,
                "codigo_postal" => "{$i}",
                "situacion_iva" => "Responsable Inscripto",
                "codigo_area_1" => null,
                "numero_telefono_1" => null,
                "codigo_area_2" => null,
                "numero_telefono_2" => null,
                "email" => "organismo-{$i}@sugit.com",
                "ciudad" => null,
                "municipalidad_id" => 1,
                "zona_id" => 1
            ];
        }

        foreach ($organismos as $organismo) {
            Organismo::updateOrCreate($organismo);
        }
    }
}
