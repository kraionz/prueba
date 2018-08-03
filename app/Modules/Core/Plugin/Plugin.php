<?php namespace App\Modules\Core\Plugin;

use App\Modules\Core\Contracts\Driver;
use Illuminate\Filesystem\Filesystem;

class Plugin extends Driver
{
    /**
     * Plugin Root Path.
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
     * @param null $plugin
     */
    public function __construct($plugin = null)
    {
        $this->data = $plugin;
        $this->files = new Filesystem;
        $this->path = $plugin['path']. '/' .config('plugin.config.name');
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
