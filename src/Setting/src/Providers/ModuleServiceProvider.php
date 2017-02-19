<?php 
/**
 * ModuleAlias: setting
 * ModuleName: setting
 * Description: This is the first file run of module. You can assign bootstrap or register module services
 * @author: noname
 * @version: 1.0
 * @package: PhambinhCMS
 */
namespace Phambinh\Cms\Setting\Providers;

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
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'Setting');

        // Load translations
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'Setting');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // Merge configs
        if (\File::exists(__DIR__ . '/../../config/config.php')) {
            $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'setting');
        }

        // Load helper
        if (\File::exists(__DIR__ . '/../../helper/helper.php')) {
            include __DIR__ . '/../../helper/helper.php';
        }

        $this->registerPolices();
    }

    private function registerPolices()
    {
        \AccessControl::define('Cài đặt - Cài đặt chung', 'admin.setting.general');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        \Module::registerFromJsonFile('setting', __DIR__ .'/../../module.json');
        $this->app->register(\Phambinh\Cms\Setting\Providers\RoutingServiceProvider::class);

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Setting', \Phambinh\Cms\Setting\Supports\Facades\Setting::class);
        $this->app->singleton(\Phambinh\Cms\Setting\Services\Setting::class);

        $loader->alias('Menu', \Phambinh\Cms\Setting\Supports\Facades\Menu::class);
        $this->app->singleton(\Phambinh\Cms\Setting\Services\Setting::class);

        add_action('admin.init', function () {
            if (\Auth::user()->can('admin')) {
                \AdminMenu::register('setting', [
                    'label'     => 'Cài đặt',
                    'url'       =>  route('admin.setting.general'),
                    'parent'    =>  '0',
                ]);
            }

            if (\Auth::user()->can('admin.setting.general')) {
                \AdminMenu::register('setting.general', [
                    'label'     => 'Cài đặt chung',
                    'parent'    =>  'setting',
                    'url'       =>  route('admin.setting.general'),
                    'icon'      =>  'icon-settings',
                ]);
            }
        });
    }
}
