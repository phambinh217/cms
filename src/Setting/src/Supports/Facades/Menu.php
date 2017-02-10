<?php 

namespace Phambinh\Cms\Setting\Supports\Facades;

use Illuminate\Support\Facades\Facade;

class Menu extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Phambinh\Cms\Setting\Services\Menu::class;
    }
}
