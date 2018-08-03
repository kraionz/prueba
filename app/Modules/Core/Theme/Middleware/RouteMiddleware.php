<?php

namespace App\Modules\Core\Theme\Middleware;

use Closure;
use App\Modules\Core\Theme\Theme as ThemeModel;

class RouteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string                   $themeName
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $themeName)
    {

       \Theme::set($themeName);

        return $next($request);
    }

}
