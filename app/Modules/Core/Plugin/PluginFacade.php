<?php

namespace App\Modules\Core\Plugin;

use Illuminate\Support\Facades\Facade;

class PluginFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'plugin';
    }
}
