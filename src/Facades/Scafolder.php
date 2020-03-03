<?php

namespace OmeneJoseph\Scafolder\Facades;

use Illuminate\Support\Facades\Facade;

class Scafolder extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'scafolder';
    }
}
