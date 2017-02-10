<?php 

namespace Phambinh\Cms\User\Providers;

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
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'User');

        // Load translations
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'User');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // Merge configs
        if (\File::exists(__DIR__ . '/../../config/config.php')) {
            $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'user');
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

        add_action('app.init', function () {
            \AccessControl::register('user.create', [
                
                'admin.user.index',
                'admin.user.create',
                'admin.user.edit',

                'admin.user.store',
                'admin.user.update',
                'admin.user.disable',
                'admin.user.enable',

            ], ['extend' => 'admin.base', 'label' => 'Quản lí người dùng']);

            \AccessControl::register('user.destroy', [
                
                'admin.user.index',
                'admin.user.destroy',

            ], ['extend' => 'admin.base', 'label' => 'Xóa người dùng']);

            \AccessControl::register('user.role', [
                
                'admin.user.role',
                'admin.user.role.{*}',

            ], ['extend' => 'admin.base', 'label' => 'Quản lí vai trò người dùng']);
        });

        add_action('admin.init', function () {
            \AdminMenu::register('user', [
                'parent'    =>  'main-manage',
                'label'     =>  'Người dùng',
                'url'       =>  admin_url('user'),
                'icon'      =>  'icon-users',
                ]);

            \AdminMenu::register('user.create', [
                'parent'    =>  'user',
                'label'     =>  'Thêm người dùng mới',
                'url'       =>  admin_url('user/create'),
                'icon'      =>  'icon-user-follow',
                ]);

            \AdminMenu::register('user.all', [
                'parent'    =>  'user',
                'label'     =>  'Tất cả người dùng',
                'url'       =>  admin_url('user'),
                'icon'      =>  'icon-list',
                ]);

            \AdminMenu::register('user.role', [
                'parent'    =>  'user',
                'label'     =>  'Vai trò người dùng',
                'url'       =>  admin_url('user/role'),
                'icon'      =>  'icon-fire',
                ]);
        });
    }
}
