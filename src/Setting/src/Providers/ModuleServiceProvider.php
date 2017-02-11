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
        \Module::registerFromJsonFile('shop', __DIR__ .'/../../module.json');
        
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Setting', \Phambinh\Cms\Setting\Supports\Facades\Setting::class);
        $this->app->singleton(\Phambinh\Cms\Setting\Services\Setting::class);

        $loader->alias('Menu', \Phambinh\Cms\Setting\Supports\Facades\Menu::class);
        $this->app->singleton(\Phambinh\Cms\Setting\Services\Setting::class);

        add_action('admin.init', function () {
            \AdminMenu::register('setting', [
                'label'     => 'Cài đặt',
                'url'       =>  route('admin.setting.general'),
                'parent'    =>  '0',
            ]);

            \AdminMenu::register('setting.appearance', [
                'label'     => 'Cài đặt giao diện',
                'parent'    =>  'setting',
                'url'       =>  route('admin.setting.appearance.menu'),
                'icon'      =>  'icon-grid',
            ]);

            \AdminMenu::register('setting.appearance.menu', [
                'label'     => 'Menu',
                'parent'    =>  'setting.appearance',
                'url'       =>  route('admin.setting.appearance.menu'),
                'icon'      =>  'icon-list',
            ]);
            
            \AdminMenu::register('setting.general', [
                'label'     => 'Cài đặt chung',
                'parent'    =>  'setting',
                'url'       =>  route('admin.setting.general'),
                'icon'      =>  'icon-settings',
            ]);

            // \AdminMenu::register('setting.check-version', [
            //     'label'     => 'Kiểm tra phiên bản',
            //     'parent'    =>  'setting',
            //     'url'       =>  route('admin.setting.check-version'),
            //     'icon'      =>  'icon-drop',
            // ]);
        });
    }
}
