<?php 

namespace Phambinh\Cms\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Menu extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Phambinh\Cms\Services\Menu::class;
    }
}
