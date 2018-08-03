<?php

namespace App\Modules\Core\Module;

use App\Modules\Core\Contracts\Driver;
use Illuminate\Filesystem\Filesystem;

class ModuleManager extends Driver
{
    /**
     * Modules Root Path.
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
     * Module constructor.
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;
        $this->path = config('module.path');
        $this->load();
    }

    /**
     * {@inheritdoc}
     */
    protected function read()
    {
        $moduleDirectories = glob($this->path.'/*', GLOB_ONLYDIR);
        $modules = [];

        if(count($moduleDirectories)) {
            foreach ($moduleDirectories as $key => $modulePath) {
                $moduleConfigPath = $modulePath . '/' . config('module.config.name');
                $moduleChangelogPath = $modulePath . '/' . config('module.config.changelog');
                if (file_exists($moduleConfigPath))
                {
                    $moduleConfig  = json_decode($this->files->get($moduleConfigPath), true);
                    $moduleChangelog = json_decode($this->files->get($moduleChangelogPath), true);

                    $moduleConfig['changelog'] = $moduleChangelog;
                    $moduleConfig['path'] = $modulePath;

                    if (array_has($moduleConfig, 'module')) {
                        $modules[data_get($moduleConfig, 'module')] = new Module($moduleConfig);
                    }
                }
            }
        }

        return $modules;
    }

    /**
     * {@inheritdoc}
     */
    protected function write(array $data){}
}
