<?php

namespace App\Modules\Core\Plugin;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\AliasLoader;
use App\Modules\Core\Support\Helper;
use Illuminate\Support\ServiceProvider;


class PluginServiceProvider extends ServiceProvider
{
    protected $files;
    protected $path;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->files = new Filesystem;
        $plugins = PluginFacade::all();

        foreach ($plugins as $plugin) {
            $plugin = (object)$plugin->all();
            $this->path = config('plugin.path').'/'.$plugin->name;
            if($plugin->core || $plugin->active)
                $this->app->register($plugin->provider);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishConfig();
        $this->registerPlugin();
        AliasLoader::getInstance()->alias('Plugin', PluginFacade::class);
    }

    /**
     * Register Plugin.
     *
     * @return void
     */
    public function registerPlugin()
    {
        $this->app->singleton('plugin', function ($app) {
            return new PluginManager($app['files']);
        });
    }

    /**
     * Publish config file.
     *
     * @return void
     */
    public function publishConfig()
    {
        $configPath = realpath(__DIR__.'../../Common/config/plugin.php');
        $this->mergeConfigFrom($configPath, 'plugin');
    }


}
