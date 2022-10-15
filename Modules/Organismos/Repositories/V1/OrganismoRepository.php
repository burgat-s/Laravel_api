<?php

namespace Modules\Organismos\Repositories\V1;

use App\Exceptions\Api\Exception;
use App\Helper\HELPER\DirectoriesFormatter;
use Illuminate\Routing\Pipeline;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Municipalidades\Entities\Municipalidad;
use Modules\Organismos\Entities\Organismo;
use Modules\Organismos\QueryFilters\FechaActualizacion;
use Modules\Organismos\QueryFilters\Organismo as OrgQuery;
use Modules\Organismos\QueryFilters\OrganismoEmail;
use Modules\Zonas\Entities\Zona;

class OrganismoRepository extends \App\Repository\EloquentRepository
{

    public function __construct()
    {
        parent::__construct(new Organismo());
        $this->filters = [
            OrgQuery::class,
            FechaActualizacion::class,
            OrganismoEmail::class,
        ];
    }

    public function showFolders($id)
    {
        try {
            $organismo = $this->findOrFail($id);
            $directoriesFormatter = new DirectoriesFormatter("pdfs/{$organismo->descripcion}");
            return $directoriesFormatter->listDirectories();
        } catch (\Exception $e) {
            throw new Exception("No se pudo obtener las carpetas.");
        }
    }

    public function store(array $request): Organismo
    {
        return  DB::transaction(function() use ($request) {

            $request['slug'] = Str::slug($request['descripcion']);
            $organismo = Organismo::create($request);

            if (isset($request['zona_id'])) {
                $zona = Zona::findOrFail($request['zona_id']);
                $organismo->Zona()->associate($zona);
            }

            if (isset($request['municipalidad_id'])) {
                $municipalidad = Municipalidad::findOrFail($request['municipalidad_id']);
                $organismo->Municipalidad()->associate($municipalidad);
            }
            $organismo->save();
            return $organismo;
        });
    }
}
