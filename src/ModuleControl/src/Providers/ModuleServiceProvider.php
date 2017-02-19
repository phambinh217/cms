<?php 
/**
 * ModuleAlias: module-control
 * ModuleName: module-control
 * Description: This is the first file run of module. You can assign bootstrap or register module services
 * @author: noname
 * @version: 1.0
 * @package: PhambinhCMS
 */
namespace Phambinh\Cms\ModuleControl\Providers;

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
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'ModuleControl');

        // Load translations
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'ModuleControl');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // Merge configs
        if (\File::exists(__DIR__ . '/../../config/config.php')) {
            $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'module-control');
        }

        // Load helper
        if (\File::exists(__DIR__ . '/../../helper/helper.php')) {
            include __DIR__ . '/../../helper/helper.php';
        }

        $this->registerPolices();
    }

    private function registerPolices()
    {
        \AccessControl::define('Module Control - Xem module', 'admin.module-control.module.index');
        \AccessControl::define('Module Control - Xem theme', 'admin.module-control.theme.index');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        \Module::registerFromJsonFile('module-control', __DIR__ .'/../../module.json');
        $this->app->register(\Phambinh\Cms\ModuleControl\Providers\RoutingServiceProvider::class);

        add_action('admin.init', function () {
            if (\Auth::user()->can('admin.module-control.module.index')) {
                \AdminMenu::register('module-control', [
                    'parent'    =>  'main-manage',
                    'icon'      =>  'icon-puzzle',
                    'url'       =>  route('admin.module-control.module.index'),
                    'label'     =>  'Quản lí module',
                ]);
            }

            if (\Auth::user()->can('admin.module-control.module.index')) {
                \AdminMenu::register('module-control.module', [
                    'parent'    =>  'module-control',
                    'icon'      =>  'icon-puzzle',
                    'url'       =>  route('admin.module-control.module.index'),
                    'label'     =>  'Module chức năng',
                ]);
            }

            if (\Auth::user()->can('admin.module-control.theme.index')) {
                \AdminMenu::register('module-control.theme', [
                    'parent'    =>  'module-control',
                    'icon'      =>  'icon-grid',
                    'url'       =>  route('admin.module-control.theme.index'),
                    'label'     =>  'Module chủ đề',
                ]);
            }
        });
    }
}
