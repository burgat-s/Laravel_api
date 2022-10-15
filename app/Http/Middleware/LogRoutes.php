<?php

namespace App\Http\Middleware;

use Closure;
use App\Entities\LogRoute;

class LogRoutes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        $string = $request->route()->getActionName();
        $action = explode("@",$string)[1];
        $stringExplode = explode('\\',explode('@',$string)[0]);
        $controller = end($stringExplode);

        $Log = new LogRoute();
        $Log->method = $request->getMethod();
        $Log->url = $request->getUri();
        $Log->payload = json_encode( $request->query());
        $Log->body =  $request->getContent();
        $Log->controller = $controller ;
        $Log->action = $action ;
        $Log->ip = $request->ip() ;
        $Log->save();

        $request->request->add(['time_start' => $this->microtime_float(),'log_id'=>$Log->id]);

        return $next($request);
    }

    public function terminate($request, $response)
    {
        $now = $this->microtime_float();
        $requestBody = $request->get('time_start');
        $log = LogRoute::find($request->get('log_id'));
        $log->response = $response->content();
        $log->code = $response->getStatusCode();
        $log->duration = round($now-$requestBody,4) ;
        $log->save();
    }

    private function microtime_float(): float
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }
}
