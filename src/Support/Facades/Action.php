<?php 

namespace Phambinh\Cms\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Action extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Phambinh\Cms\Services\Action::class;
    }
}
