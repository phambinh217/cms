<?php 

namespace Phambinh\Cms\Core\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Module extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Phambinh\Cms\Core\Services\Module::class;
    }
}
