<?php

namespace Modules\Organismos\QueryFilters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class Organismo
{
    public function handle($request, Closure $next)
    {
        /** @var Builder $builder */
        $builder = $next($request);

        $requestedOrgDescripcion = request()->get('descripcion');

        if($requestedOrgDescripcion)
            $builder->where('descripcion', "LIKE", "%{$requestedOrgDescripcion}%");

        return $builder;
    }
}
