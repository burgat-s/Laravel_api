<?php

namespace Modules\Organismos\QueryFilters;

use Carbon\Carbon;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class FechaActualizacion
{
    public function handle($request, Closure $next)
    {
        /** @var Builder $builder */
        $builder = $next($request);

        $requestFechaActualizacion = request()->get('fechaModificacion');

        if($requestFechaActualizacion)
            $builder->whereDate('updated_at', Carbon::createFromFormat('d/m/Y', $requestFechaActualizacion)->toDateString());

        return $builder;
    }
}
