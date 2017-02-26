<?php
/**
 * ModuleAlias: setting
 * ModuleName: setting
 * Description: This is the first file run of module. You can assign bootstrap or register module Services
 * @author: noname
 * @version: 1.0
 * @package: PhambinhCMS
 */
namespace Phambinh\Cms\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Phambinh\Cms\Validator\HashRule;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application Services.
     *
     * @return void
     */
    public function boot()
    {
        // Load views
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'Cms');

        // Load translations
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'Cms');

        // Load helper
        if (\File::exists(__DIR__ . '/../../helper/helper.php')) {
            include __DIR__ . '/../../helper/helper.php';
        }

        $this->publishes([
            __DIR__.'/../../publishes/database/migrations' => database_path('migrations'),
        ], 'migration');

        $this->publishes([
            __DIR__.'/../../publishes/config' => config_path(),
        ], 'config');
            
        $this->publishes([
            __DIR__.'/../../publishes/resources' => resource_path(),
        ], 'resource');

        $this->registerBalde();
        $this->registerPolices();
        $this->registerRule();
    }

    /**
     * Register the application Services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/../../helper/helper.php';

        if (config('cms.aliases')) {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();

            foreach (config('cms.aliases') as $alias => $class) {
                $loader->alias($alias, $class);
            }
        }

        if (config('cms.providers')) {
            foreach (config('cms.providers') as $provider) {
                $this->app->register($provider);
            }
        }

        if (config('cms.generators')) {
            foreach (config('cms.generators') as $slug => $class) {
                $this->commands($class);
            }
        }
        
        \Module::registerFromJsonFile('cms', __DIR__ .'/../../module.json');
        
        $this->registerAdminMenu();
        $this->registerWidget();
    }

    private function registerBalde()
    {
        Blade::directive('widget', function ($expression) {
            return "<?php echo \Widget::run($expression) ?>";
        });
    }

    private function registerPolices()
    {
        \AccessControl::define('Quản trị cơ bản', 'admin');
        \AccessControl::define('Cài đặt - Cài đặt chung', 'admin.setting.general');
        \AccessControl::define('File - Upload file', 'admin.file.upload');
        \AccessControl::define('File - File browser', 'admin.file.browser');
        \AccessControl::define('Module Control - Xem module', 'admin.module-control.module.index');
        \AccessControl::define('Module Control - Xem theme', 'admin.module-control.theme.index');
        \AccessControl::define('Cài đặt - Cài đặt chung', 'admin.setting.general');

        \AccessControl::define('Người dùng - Xem danh sách', 'admin.user.index');
        \AccessControl::define('Người dùng - Xem chi tiết', 'admin.user.show');
        \AccessControl::define('Người dùng - Thêm người mới', 'admin.user.create');
        \AccessControl::define('Người dùng - Chỉnh sửa', 'admin.user.edit');
        \AccessControl::define('Người dùng - Cấm', 'admin.user.disable');
        \AccessControl::define('Người dùng - Khôi phục', 'admin.user.enable');
        \AccessControl::define('Người dùng - Xóa', 'admin.user.destroy');
        \AccessControl::define('Người dùng - Đăng nhập với tư cách', 'admin.user.login-as');

        \AccessControl::define('Người dùng - Xem danh sách vai trò', 'admin.role.index');
        \AccessControl::define('Người dùng - Thêm vài trò mới', 'admin.role.create');
        \AccessControl::define('Người dùng - Chỉnh sửa vai trò', 'admin.role.edit');
        \AccessControl::define('Người dùng - Xóa vai trò', 'admin.role.destroy');
    }

    private function registerRule()
    {
        \Validator::resolver(function ($translator, $data, $rules, $messages) {
            return new HashRule($translator, $data, $rules, $messages);
        });
    }

    private function registerAdminMenu()
    {
        add_action('admin.init', function () {
            if (\Auth::user()->can('admin')) {
                \AdminMenu::register('admin-menu-top', [
                    'parent'    =>    '0',
                    'order'     => '0',
                    'url'        =>    route('admin.profile.show'),
                ]);
            }
            
            if (\Auth::user()->can('admin')) {
                \AdminMenu::register('dashboard', [
                    'parent'    =>    'admin-menu-top',
                    'label'        =>    'Bảng quản trị',
                    'url'        =>    route('admin.dashboard'),
                    'icon'        =>    'icon-bar-chart',
                ]);
            }

            if (\Auth::user()->can('admin')) {
                \AdminMenu::register('overview', [
                    'parent'    =>    'dashboard',
                    'label'        =>    'Tổng quan',
                    'url'        =>    route('admin.dashboard'),
                    'icon'        =>    'icon-graph',
                ]);
            }

            if (\Auth::user()->can('admin')) {
                \AdminMenu::register('main-manage', [
                    'parent'    =>    '0',
                    'label'        =>    'Quản lý chính',
                ]);
            }

            if (\Auth::user()->can('admin.user.index')) {
                \AdminMenu::register('user', [
                    'parent'    =>  'main-manage',
                    'label'     =>  'Người dùng',
                    'url'       =>  route('admin.user.index'),
                    'icon'      =>  'icon-users',
                ]);
            }

            if (\Auth::user()->can('admin.user.create')) {
                \AdminMenu::register('user.create', [
                    'parent'    =>  'user',
                    'label'     =>  'Thêm người dùng mới',
                    'url'       =>  route('admin.user.create'),
                    'icon'      =>  'icon-user-follow',
                ]);
            }
            if (\Auth::user()->can('admin.user.index')) {
                \AdminMenu::register('user.all', [
                    'parent'    =>  'user',
                    'label'     =>  'Tất cả người dùng',
                    'url'       =>  route('admin.user.index'),
                    'icon'      =>  'icon-list',
                ]);
            }

            if (\Auth::user()->can('admin.role.index')) {
                \AdminMenu::register('user.role', [
                    'parent'    =>  'user',
                    'label'     =>  'Vai trò người dùng',
                    'url'       =>  route('admin.role.index'),
                    'icon'      =>  'icon-fire',
                ]);
            }

            if (\Auth::user()->can('admin')) {
                \AdminMenu::register('file', [
                    'parent'    =>  'main-manage',
                    'label'     =>  'Quản lí file',
                    'url'       =>  route('admin.file.index'),
                    'icon'      =>  'icon-picture',
                ]);
            }

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

            if (\Auth::user()->can('admin')) {
                \AdminMenu::register('profile', [
                    'parent'    =>  'admin-menu-top',
                    'label'     =>  'Cá nhân',
                    'url'       =>  route('admin.profile.show'),
                    'icon'      =>  'icon-user',
                ]);
            }
            
            if (\Auth::user()->can('admin')) {
                \AdminMenu::register('profile.info', [
                    'parent'    =>  'profile',
                    'label'     =>  'Thông tin cá nhân',
                    'url'       =>  route('admin.profile.show'),
                    'icon'      =>  'icon-info',
                ]);
            }

            if (\Auth::user()->can('admin')) {
                \AdminMenu::register('profile.change-password', [
                    'parent'    =>  'profile',
                    'label'     =>  'Đổi mật khẩu',
                    'url'       =>  route('admin.profile.change-password'),
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

    private function registerWidget()
    {
        
    }
}
