<?php
namespace App\Modules\Core;

use App\Modules\Core\Module\ModuleServiceProvider;
use App\Modules\Core\Plugin\PluginServiceProvider;
use App\Modules\Core\Setting\SettingServiceProvider;
use App\Modules\Core\Support\Helper;
use App\Modules\Core\Theme\ThemeServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider as Provider;

class CoreServiceProvider extends  Provider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
        $this->commonFiles();
        $this->app->register(SettingServiceProvider::class);
        $this->app->register(ModuleServiceProvider::class);
        $this->app->register(PluginServiceProvider::class);
        $this->app->register(ThemeServiceProvider::class);

    }

    public function commonFiles()
    {
        $this->loadRoutesFrom(__DIR__ . '/Common/routes/web.php');
        Helper::autoload(realpath(__DIR__.'/Common/helpers'));
    }

}


