<?php 

namespace Packages\Cms\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Action extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Packages\Cms\Services\Action::class;
    }
}
