<?php


if (!function_exists('theme')) {
    /**
     * Get / set the specified plugin value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param  array|string $key
     * @param  mixed $default
     * @return mixed
     * @throws \Illuminate\Container\EntryNotFoundException
     */
    function theme($key = null, $default = null)
    {
        $plugin = app('theme');

        if (is_null($key)) {
            return $plugin;
        }

        if (is_array($key)) {
            $plugin->set($key);

            return $plugin;
        }

        return $plugin->get($key, $default);
    }
}


if (!function_exists('themes')) {
    /**
     * Generate an asset path for the theme.
     *
     * @param string $path
     * @param bool   $secure
     *
     * @return string
     */
    function themes($path, $secure = null)
    {
       if(Theme::current()){
           return Theme::assets($path, $secure);
       }

       return $path;
    }
}

if (!function_exists('lang')) {
    /**
     * Get lang content from current theme.
     *
     * @param $fallback
     *
     * @return \Illuminate\Contracts\Translation\Translator|string
     */
    function lang($fallback)
    {
        return Theme::lang($fallback);
    }
}

if (!function_exists('view_exists')) {
    /**
     * Check if there is a theme table in database.
     *
     * @param array $views
     * @return boolean
     */
    function view_exists($views = [])
    {
        foreach ($views as $view){
            if(view()->exists($view)){
                return $view;
            }
        }
    }
}
