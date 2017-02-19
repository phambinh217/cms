<?php 
/**
 * ModuleAlias: profile
 * ModuleName: profile
 * Description: This is the first file run of module. You can assign bootstrap or register module services
 * @author: noname
 * @version: 1.0
 * @package: PhambinhCMS
 */
namespace Phambinh\Cms\Profile\Providers;

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
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'Profile');

        // Load translations
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'Profile');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // Merge configs
        if (\File::exists(__DIR__ . '/../../config/config.php')) {
            $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'profile');
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
        \Module::registerFromJsonFile('profile', __DIR__ .'/../../module.json');
        $this->app->register(\Phambinh\Cms\Profile\Providers\RoutingServiceProvider::class);
        
        add_action('admin.init', function () {
            if (\Auth::user()->can('admin')) {
                \AdminMenu::register('profile', [
                    'parent'    =>  'admin-menu-top',
                    'label'     =>  'Cá nhân',
                    'url'       =>  admin_url('profile'),
                    'icon'      =>  'icon-user',
                ]);
            }
            
            if (\Auth::user()->can('admin')) {
                \AdminMenu::register('profile.info', [
                    'parent'    =>  'profile',
                    'label'     =>  'Thông tin cá nhân',
                    'url'       =>  admin_url('profile'),
                    'icon'      =>  'icon-info',
                ]);
            }

            if (\Auth::user()->can('admin')) {
                \AdminMenu::register('profile.change-password', [
                    'parent'    =>  'profile',
                    'label'     =>  'Đổi mật khẩu',
                    'url'       =>  admin_url('profile/change-password'),
                    'icon'      =>  'icon-key',
                ]);
            }
            if (\Auth::user()->can('admin')) {
                \AdminMenu::register('profile.logout', [
                    'parent'    =>  'admin-menu-top',
                    'label'     =>  '<span class="text-danger">Đăng xuất</span>',
                    'url'       =>  url('logout'),
                    'attributes' => "onclick=\"event.preventDefault(); document.getElementById('logout-form').submit();\"",
                    'icon'      =>  'icon-logout',
                ]);
            }
        });
    }
}
