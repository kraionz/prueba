<?php namespace App\Modules\Core\Module;

use App\Modules\Core\Contracts\Driver;
use Illuminate\Filesystem\Filesystem;

class Module extends Driver
{
    /**
     * Module Root Path.
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
     * @param null $module
     */
    public function __construct($module = null)
    {
        $this->data = $module;
        $this->files = new Filesystem;
        $this->path = $module['path']. '/' .config('module.config.name');
        $this->load();
    }

    /**
     * {@inheritdoc}
     */
    protected function read()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    protected function write(array $data)
    {
        if ($data) {
            $contents = json_encode($data,JSON_PRETTY_PRINT);
        } else {
            $contents = '{}';
        }

        $this->files->put($this->path, $contents);
    }
}
