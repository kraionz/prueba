<?php

namespace App\Modules\Setting\Providers;


use App\Modules\Core\Setting\SettingFacade;
use App\Modules\Core\Support\Helper;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;


class SettingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        AliasLoader::getInstance()->alias('Setting', SettingFacade::class);
        $router = $this->app['router'];
        $this->app->register(RouteServiceProvider::class);
    }

}
