<?php

namespace System\Middlewares;

use Closure;

class SystemWidgetBuilderMiddleware
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
        define("WIDGET_PATH",base_path().DS.'packages');
        $request->path();     
        return $next($request);
    }
}
