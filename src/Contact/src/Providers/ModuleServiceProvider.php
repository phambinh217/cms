<?php 
/**
 * ModuleAlias: contact
 * ModuleName: contact
 * Description: This is the first file run of module. You can assign bootstrap or register module services
 * @author: noname
 * @version: 1.0
 * @package: PhambinhCMS
 */
namespace Phambinh\Cms\Contact\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Load views
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'Contact');

        // Load translations
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'Contact');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // Merge configs
        if (\File::exists(__DIR__ . '/../../config/config.php')) {
            $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'contact');
        }

        // Load helper
        if (\File::exists(__DIR__ . '/../../helper/helper.php')) {
            include __DIR__ . '/../../helper/helper.php';
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        \Module::registerFromJsonFile('contact', __DIR__ .'/../../module.json');
        $this->registerAdminMenu();
        $this->registerLoader();
    }

    private function registerLoader()
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Contact', \Phambinh\Cms\Contact\Supports\Facades\Contact::class);
        $this->app->singleton('contact', \Phambinh\Cms\Contact\Services\Contact::class);
        $this->app->register(\Phambinh\Cms\Contact\Providers\RoutingServiceProvider::class);
    }

    private function registerAdminMenu()
    {
    }
}
