<?php

namespace App\Modules\Core\Theme;

use App\Modules\Core\Contracts\Driver;
use App\Modules\Core\Support\Arr;
use Illuminate\Container\Container;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\ViewFinderInterface;

class ThemeManager
{
    /**
     * The settings data.
     *
     * @var array
     */
    protected $data = array();

    /**
     * Whether the store has changed since it was last loaded.
     *
     * @var boolean
     */
    protected $unsaved = false;

    /**
     * Whether the settings data are loaded.
     *
     * @var boolean
     */
    protected $loaded = false;

    /**
     * Themes Root Path.
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
     * Blade View Finder.
     *
     * @var ViewFinderInterface
     */
    protected $finder;

    /**
     * Application Container.
     *
     * @var Container
     */
    protected $app;

    /**
     * Translator.
     *
     * @var Translator
     */
    protected $lang;

    /**
     * Current Active Theme.
     *
     * @var string|$activeTheme
     */
    private $activeTheme = null;


    /**
     * Theme constructor.
     * @param Container $app
     * @param Filesystem $files
     * @param ViewFinderInterface $finder
     * @param Translator $lang
     */
    public function __construct(Container $app, Filesystem $files, ViewFinderInterface $finder, Translator $lang)
    {
        $this->app = $app;
        $this->files = $files;
        $this->finder = $finder;
        $this->lang = $lang;
        $this->path = config('theme.path');
        $this->load();
    }


    /**
     * Get a specific key from the themes data.
     *
     * @param  string|array $key
     * @param  mixed        $default Optional default value.
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        $this->load();

        return Arr::get($this->data, $key, $default);
    }

    /**
     * Get current active theme name only or collection.
     *
     * @param bool $collection
     *
     * @return null|string
     */
    public function current($collection = false)
    {
        return !$collection ? $this->activeTheme : $this->get($this->activeTheme);
    }

    /**
     * Set current theme.
     *
     * @param string $theme
     *
     * @return void
     */
    public function set($theme)
    {
        $this->loadTheme($theme);
        $this->activeTheme = $theme;
    }

    /**
     * Determine if a key exists in the themes data.
     *
     * @param  string  $key
     *
     * @return boolean
     */
    public function has($key)
    {
        $this->load();

        return Arr::has($this->data, $key);
    }

    /**
     * Get all themes data.
     *
     * @return array
     */
    public function all()
    {
        $this->load();

        return $this->data;
    }


    /**
     * Make sure data is loaded.
     *
     * @param bool $force Force a reload of data. Default false.
     */
    public function load($force = false)
    {
        if (!$this->loaded || $force) {
            $this->data = $this->read();
            $this->loaded = true;
        }
    }

    /**
     * Find asset file for theme asset.
     *
     * @param string    $path
     * @param null|bool $secure
     *
     * @return string
     */
    public function assets($path, $secure = null)
    {
        $splitThemeAndPath = explode(':', $path);

        if (count($splitThemeAndPath) > 1) {
            if (is_null($splitThemeAndPath[0])) {
                return;
            }
            $themeName = $splitThemeAndPath[0];
            $path = $splitThemeAndPath[1];
        } else {
            $themeName = $this->activeTheme;
            $path = $splitThemeAndPath[0];
        }

        $themeInfo = collect($this->get($themeName));

        if ( config('theme.symlink') ) {
            $themePath = 'themes/' . $themeName . '/';
        } else {
            $themePath = str_replace(public_path() . '/', '', $themeInfo->get('path')) . '/';
        }

        $assetPath = config('theme.folders.assets').'/';
        $fullPath = $themePath.$assetPath.$path;

        if (!file_exists($fullPath) && $themeInfo->has('parent') && !empty($themeInfo->get('parent'))) {
            $themePath = str_replace(public_path().'/', '', collect($this->get($themeInfo->get('parent')))->get('path')).'/';
            $fullPath = $themePath.$assetPath.$path;

            return $this->app['url']->asset($fullPath, $secure);
        }

        return $this->app['url']->asset($fullPath, $secure);
    }

    /**
     * Get lang content from current theme.
     *
     * @param string $fallback
     *
     * @return \Illuminate\Contracts\Translation\Translator|string
     */
    public function lang($fallback)
    {
        $splitLang = explode('::', $fallback);

        if (count($splitLang) > 1) {
            if (is_null($splitLang[0])) {
                $fallback = $splitLang[1];
            } else {
                $fallback = $splitLang[0].'::'.$splitLang[1];
            }
        } else {

            $fallback = $this->current().'::'.$splitLang[0];

            ;
            if (!$this->lang->has($fallback)) {
                $fallback = collect($this->get($this->current()))->get('parent').'::'.$splitLang[0];

                if (!$this->lang->has($fallback)) {
                    $fallback = $splitLang[0];
                }
            }
        }

        return trans($fallback);
    }

    /**
     * Map view map for particular theme.
     *
     * @param string $theme
     *
     * @return void
     */
    private function loadTheme($theme)
    {
        if (is_null($theme)) {
            return;
        }

        $themeInfo = $this->get($theme);

        if (is_null($themeInfo)) {
            return;
        }

        $this->loadTheme($themeInfo->get('parent'));

        $viewPath = $themeInfo->get('path').'/'.config('theme.folders.views');
        $langPath = $themeInfo->get('path').'/'.config('theme.folders.lang');

        $this->finder->prependLocation($themeInfo->get('path'));
        $this->finder->prependLocation($viewPath);
        $this->finder->prependNamespace($themeInfo->get('theme'), $viewPath);
        if ($themeInfo->has('type') && !empty($themeInfo->get('type'))) {
            $this->finder->prependNamespace($themeInfo->get('type'), $viewPath);
        }
        $this->lang->addNamespace($themeInfo->get('theme'), $langPath);
    }

    /**
     * {@inheritdoc}
     */
    public function read()
    {
        $themeDirectories = glob($this->path.'/*', GLOB_ONLYDIR);
        $themes = [];

        if(count($themeDirectories)) {


            foreach ($themeDirectories as $key => $themePath) {
                $themeConfigPath = $themePath . '/' . config('theme.config.name');
                $themeChangelogPath = $themePath . '/' . config('theme.config.changelog');
                if (file_exists($themeConfigPath))
                {
                    $themeConfig  = json_decode($this->files->get($themeConfigPath), true);
                    $themeChangelog = json_decode($this->files->get($themeChangelogPath), true);

                    $themeConfig['changelog'] = $themeChangelog;
                    $themeConfig['path'] = $themePath;

                    if (array_has($themeConfig, 'theme')) {
                        $themes[data_get($themeConfig, 'theme')] = new Theme($themeConfig);
                    }
                }
            }
        }

        return $themes;
    }
}
