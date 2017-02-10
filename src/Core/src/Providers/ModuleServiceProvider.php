<?php

namespace Phambinh\Cms\Core\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    protected $version = '1.0';

    protected $moduleProviders;
    
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../../../publishes/assets' => public_path('assets'),
            __DIR__.'/../../../../publishes/config' => base_path('config'),
            __DIR__.'/../../../../publishes/resources' => base_path('resources'),
        ], 'public');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Module', \Phambinh\Cms\Core\Support\Facades\Module::class);
        $loader->alias('HomeController', \Phambinh\Cms\Core\Http\Controllers\HomeController::class);
        $loader->alias('AppController', \Phambinh\Cms\Core\Http\Controllers\AppController::class);
        $loader->alias('ApiController', \Phambinh\Cms\Core\Http\Controllers\ApiController::class);
        $this->app->singleton(\Phambinh\Cms\Core\Services\Module::class, \Phambinh\Cms\Core\Services\Module::class);

        if (config('cms.providers')) {
            $this->moduleProviders = config('cms.providers');
            foreach ($this->moduleProviders as $provider) {
                $this->app->register($provider);
            }
        }
    }
}
