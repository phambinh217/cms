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

        $this->registerPolices();
    }

    private function registerPolices()
    {
        \AccessControl::define('Người dùng - Xem danh sách', 'admin.user.index');
        \AccessControl::define('Người dùng - Xem chi tiết', 'admin.user.show');
        \AccessControl::define('Người dùng - Thêm người mới', 'admin.user.create');
        \AccessControl::define('Người dùng - Chỉnh sửa', 'admin.user.edit');
        \AccessControl::define('Người dùng - Cấm', 'admin.user.disable');
        \AccessControl::define('Người dùng - Khôi phục', 'admin.user.enable');
        \AccessControl::define('Người dùng - Xóa', 'admin.user.destroy');
        \AccessControl::define('Người dùng - Xem danh sách vai trò', 'admin.user.role.index');
        \AccessControl::define('Người dùng - Thêm vài trò mới', 'admin.user.role.create');
        \AccessControl::define('Người dùng - Chỉnh sửa vai trò', 'admin.user.role.edit');
        \AccessControl::define('Người dùng - Xóa vai trò', 'admin.user.role.destroy');
        \AccessControl::define('Người dùng - Đăng nhập với tư cách', 'admin.user.login-as');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        \Module::registerFromJsonFile('user', __DIR__ .'/../../module.json');
        $this->app->register(\Phambinh\Cms\User\Providers\RoutingServiceProvider::class);
        $this->registerAdminMenu();
    }

    private function registerAdminMenu()
    {
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
