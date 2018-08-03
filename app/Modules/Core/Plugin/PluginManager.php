<?php

namespace App\Modules\Core\Plugin;

use App\Modules\Core\Contracts\Driver;
use Illuminate\Filesystem\Filesystem;

class PluginManager extends Driver
{
    /**
     * Plugins Root Path.
     *
     * @var string
     */
    protected $path;

    /**
     * Filesystem.
     *
     * @var $files
     */
    protected $files;

    /**
     * Plugin constructor.
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;
        $this->path = config('plugin.path');
        $this->load();
    }

    /**
     * {@inheritdoc}
     */
    protected function read()
    {
        $pluginDirectories = glob($this->path.'/*', GLOB_ONLYDIR);
        $plugins = [];

        if(count($pluginDirectories)) {
            foreach ($pluginDirectories as $key => $pluginPath) {
                $pluginConfigPath = $pluginPath . '/' . config('plugin.config.name');
                $pluginChangelogPath = $pluginPath . '/' . config('plugin.config.changelog');
                if (file_exists($pluginConfigPath))
                {
                    $pluginConfig  = json_decode($this->files->get($pluginConfigPath), true);
                    $pluginChangelog = json_decode($this->files->get($pluginChangelogPath), true);

                    $pluginConfig['changelog'] = $pluginChangelog;
                    $pluginConfig['path'] = $pluginPath;

                    if (array_has($pluginConfig, 'plugin')) {
                        $plugins[data_get($pluginConfig, 'plugin')] = new Plugin($pluginConfig);
                    }
                }
            }
        }
        return $plugins;
    }

    /**
     * {@inheritdoc}
     */
    protected function write(array $data){}

}
