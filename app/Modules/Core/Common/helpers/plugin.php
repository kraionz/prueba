<?php

if (!function_exists('plugin')) {
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
    function plugin($key = null, $default = null)
    {
        $plugin = app('plugin');

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

