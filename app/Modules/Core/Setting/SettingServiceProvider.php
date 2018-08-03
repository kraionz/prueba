<?php

namespace App\Modules\Core\Setting;

use App\Modules\Core\Setting\Middleware\AutoSaveSetting;
use Blade;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     * @throws \Illuminate\Container\EntryNotFoundException
     */
    public function boot()
    {

        $this->app->singleton('setting.manager', function ($app) {
            return new SettingManager($app, 'module');
        });

        $this->app->singleton('setting', function ($app) {
            return $app['setting.manager']->driver();
        });

        // Auto save setting
        if (config('setting.auto_save')) {
            $kernel = $this->app['Illuminate\Contracts\Http\Kernel'];
            //$kernel->pushMiddleware(AutoSaveSetting::class);
        }

        // Override config
        if (config('setting.override')) {
            foreach (config('setting.override') as $config_key => $setting_key) {
                // handle non associative override declaration
                $config_key = $config_key ?: $setting_key;

                $value = setting($setting_key);
                if (is_null($value)) {
                    continue;
                }
                config([$config_key => $value]);
            }
            unset($value);
        }

        // Register blade directive
        Blade::directive('setting', function ($expression) {
            return "<?php echo setting($expression); ?>";
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
      $this->publishConfig();
    }

    /**
     * Publish config file.
     *
     * @return void
     */
    public function publishConfig()
    {
        $configPath = realpath(__DIR__.'../../Common/config/setting.php');
        $this->mergeConfigFrom($configPath, 'setting');
    }

}
