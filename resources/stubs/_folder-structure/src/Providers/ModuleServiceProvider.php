<?php
/**
 * ModuleAlias: DummyAlias
 * ModuleName: DummyName
 * Description: This is the first file run of module. You can assign bootstrap or register module Services
 * @author: DummyAuthor
 * @version: DummyVersion
 * @package: PhambinhCMS
 */
namespace DummyNamespace\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application Services.
     *
     * @return void
     */
    public function boot()
    {
        // Load views
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'DummyUcfirst');

        // Load translations
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'DummyUcfirst');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // Merge configs
        if (\File::exists(__DIR__ . '/../../config/config.php')) {
            $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'DummyAlias');
        }

        // Load helper
        if (\File::exists(__DIR__ . '/../../helper/helper.php')) {
            include __DIR__ . '/../../helper/helper.php';
        }

        $this->publishes([
            __DIR__.'/../../assets' => public_path('assets'),
        ], 'public');

        $this->registerPolices();
    }

    /**
     * Register the application Services.
     *
     * @return void
     */
    public function register()
    {
        \Module::registerFromJsonFile('DummyAlias', __DIR__ .'/../../module.json');
        $this->app->register(\DummyNamespace\Providers\RoutingServiceProvider::class);
        $this->registerAdminMenu();
    }

    private function registerPolices()
    {
        //
    }

    private function registerAdminMenu()
    {
        //
    }
}
