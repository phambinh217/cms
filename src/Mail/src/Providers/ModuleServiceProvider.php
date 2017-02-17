<?php 
/**
 * ModuleAlias: mail
 * ModuleName: mail
 * Description: This is the first file run of module. You can assign bootstrap or register module services
 * @author: noname
 * @version: 1.0
 * @package: PhambinhCMS
 */
namespace Phambinh\Cms\Mail\Providers;

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
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'Mail');

        // Load translations
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'Mail');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // Merge configs
        if (\File::exists(__DIR__ . '/../../config/config.php')) {
            $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'mail');
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
        \Module::registerFromJsonFile('mail', __DIR__ .'/../../module.json');
        
        add_action('admin.init', function () {
            \AdminMenu::register('mail', [
                'order'     =>  '3',
                'parent'    =>  '0',
                'label'     =>  'Tin nhắn',
                'icon'      =>  'icon-bubbles',
                ]);

            \AdminMenu::register('mail.create', [
                'parent'    =>  'mail',
                'label'     =>  'Soạn tin mới',
                'url'       =>  admin_url('mail/create'),
                'icon'      =>  'icon-paper-plane',
                ]);

            \AdminMenu::register('mail.inbox', [
                'parent'    =>  'mail',
                'label'     =>  'Hộp thư đến',
                'url'       =>  admin_url('mail/inbox'),
                'icon'      =>  'icon-envelope-letter',
                ]);

            \AdminMenu::register('mail.outbox', [
                'parent'    =>  'mail',
                'label'     =>  'Hộp thư đi',
                'url'       =>  admin_url('mail/outbox'),
                'icon'      =>  'icon-envelope-open',
                ]);
        });
    }
}
