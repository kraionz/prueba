<?php namespace App\Modules\Core\Theme;

use App\Modules\Core\Contracts\Driver;
use Illuminate\Filesystem\Filesystem;

class Theme extends Driver
{
    /**
     * Theme Root Path.
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
     * @param null $theme
     */
    public function __construct($theme = null)
    {
        $this->data = $theme;
        $this->files = new Filesystem;
        $this->path = $theme['path']. '/' .config('theme.config.name');
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
