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

        // Load route
        if (!$this->app->routesAreCached()) {
            if (\File::exists(__DIR__ . '/../../routes.php')) {
                include __DIR__ . '/../../routes.php';
            }
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        \Module::registerFromJsonFile('module-control', __DIR__ .'/../../module.json');
        
        add_action('admin.init', function () {
            \AdminMenu::register('module-control', [
                'parent'    =>  'main-manage',
                'icon'      =>  'icon-puzzle',
                'url'       =>  route('admin.module-control.module.index'),
                'label'     =>  'Quản lí module',
            ]);

            \AdminMenu::register('module-control.module', [
                'parent'    =>  'module-control',
                'icon'      =>  'icon-puzzle',
                'url'       =>  route('admin.module-control.module.index'),
                'label'     =>  'Module chức năng',
            ]);

            \AdminMenu::register('module-control.theme', [
                'parent'    =>  'module-control',
                'icon'      =>  'icon-grid',
                'url'       =>  route('admin.module-control.theme.index'),
                'label'     =>  'Module chủ đề',
            ]);
        });
    }
}
