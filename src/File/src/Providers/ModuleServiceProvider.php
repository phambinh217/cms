<?php 

namespace Phambinh\Cms\File\Providers;

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
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'File');

        // Load translations
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'File');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // Merge configs
        if (\File::exists(__DIR__ . '/../../config/config.php')) {
            $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'file');
        }

        // Load helper
        if (\File::exists(__DIR__ . '/../../helper/helper.php')) {
            include __DIR__ . '/../../helper/helper.php';
        }

        $this->registerPolices();
    }

    private function registerPolices()
    {
        \AccessControl::define('File - Upload file', 'admin.file.upload');
        \AccessControl::define('File - File browser', 'admin.file.browser');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        \Module::registerFromJsonFile('file', __DIR__ .'/../../module.json');
        $this->app->register(\Phambinh\Cms\File\Providers\RoutingServiceProvider::class);

        add_action('admin.init', function () {
            if (\Auth::user()->can('admin')) {
                \AdminMenu::register('file', [
                    'parent'    =>  'main-manage',
                    'label'     =>  'Quản lí file',
                    'url'       =>  admin_url('file'),
                    'icon'      =>  'icon-picture',
                ]);
            }
        });
    }
}
