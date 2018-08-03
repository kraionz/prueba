<?php

namespace App\Modules\Core\Theme\Middleware;

use Closure;
use Theme;

class WebMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     * @throws \Illuminate\Container\EntryNotFoundException
     */
    public function handle($request, Closure $next)
    {
        $setting = function_exists('setting')? setting('detect_admin_middleware') : false;

        //dd($setting);
        if ( $setting & request()->is( env('BACKEND_PATH')?? 'admin'.'/*') || $setting & request()->is( env('BACKEND_PATH').'/*')){

           $this->setThemeAdmin();

        }else {

            $this->setTheme();
        }

        return $next($request);
    }

    public function setTheme(){

        $themes = collect(Theme::all());

        $active = $themes->where('admin', 0);
        $active = $active->firstWhere('active', 1);

        $theme = $active ? $active['theme'] : config('theme.default.site');

        if(\Theme::has($theme)){
            \Theme::set($theme);
        }
    }

    public function setThemeAdmin(){

         $themes =  collect(Theme::all());
        $active = $themes->where('admin', 1);
        $active = $active->firstWhere('active', 1);

        $theme = $active ? $active['theme'] : config('theme.default.admin');

        if(\Theme::has($theme)){
            \Theme::set($theme);
        }
    }
}
