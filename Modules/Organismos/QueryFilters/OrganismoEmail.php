<?php

namespace Modules\Organismos\QueryFilters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class OrganismoEmail
{
    public function handle($request, Closure $next)
    {
        /** @var Builder $builder */
        $builder = $next($request);

        $requestedEmail = strtolower(request()->get('email'));

        if($requestedEmail)
            $builder->where('email', "LIKE", "%{$requestedEmail}%");

        return $builder;
    }
}
