<?php 

namespace Phambinh\Cms\Setting\Supports\Facades;

use Illuminate\Support\Facades\Facade;

class Setting extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Phambinh\Cms\Setting\Services\Setting::class;
    }
}
