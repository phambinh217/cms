<?php 

namespace Packages\Cms\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Menu extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Packages\Cms\Services\Menu::class;
    }
}
