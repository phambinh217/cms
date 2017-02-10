<?php 

namespace Phambinh\Cms\Admin\Providers;

use Illuminate\Filesystem\Filesystem;
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
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'Admin');

        // Load translations
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'Admin');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // Merge configs
        if (\File::exists(__DIR__ . '/../../config/config.php')) {
            $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'admin');
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
        \Module::registerFromJsonFile('admin', __DIR__ .'/../../module.json');
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        // $loader->alias('AdminMenu', \Phambinh\Cms\Admin\Supports\AdminMenu::class);
        $loader->alias('AdminController', \Phambinh\Cms\Admin\Http\Controllers\Admin\AdminController::class);
        $loader->alias('AdminMenu', \Phambinh\Cms\Admin\Supports\Facades\AdminMenu::class);
        $this->app->singleton('admin-menu', \Phambinh\Cms\Admin\Services\AdminMenu::class);

        $this->registerPermission();
        $this->registerAdminMenu();
        $this->registerContact();
    }

    private function registerContact()
    {
        add_action('app.init', function () {
            \Contact::register('contact', [
                'mailTo'    =>  'phambinh217@gmail.com',
                'name'      =>  'Phạm Bình',
                'subject'   =>  'Test Email',
                'validate'  =>  [
                    'contact.name'      =>  'required',
                    'contact.email'     =>  'required',
                    'contact.content'   =>  'required',
                ],
                'template'  =>  'Admin::contact.template.contact-email',
                'message'   =>  'Nội dung của bạn đã được gửi đến chúng tôi thành công',
                'redirect'  =>  'back',
            ]);
        });
    }

    private function registerPermission()
    {
        add_action('app.init', function () {
            \AccessControl::register('admin.base', [
                'admin.profile.{*}',
                'admin.mail.{*}',
                'admin.file.stand-alone',
                'admin.file.connector',
                'admin.user.popup-show',
            ], ['label' => 'Quản trị cơ bản']);

            \AccessControl::register('admin.dashboard', [
                'admin.dashboard',
            ], ['label' => 'Bảng tin quản trị']);
        });
    }

    private function registerAdminMenu()
    {
        add_action('admin.init', function () {
            \AdminMenu::register('admin-menu-top', [
                'parent'    =>    '0',
                'url'        =>    admin_url('profile'),
            ], '0');

            \AdminMenu::register('dashboard', [
                'parent'    =>    'admin-menu-top',
                'label'        =>    'Bảng quản trị',
                'url'        =>    admin_url('dashboard'),
                'icon'        =>    'icon-bar-chart',
            ]);

            \AdminMenu::register('overview', [
                'parent'    =>    'dashboard',
                'label'        =>    'Tổng quan',
                'url'        =>    admin_url('dashboard'),
                'icon'        =>    'icon-graph',
            ]);
            
            \AdminMenu::register('main-manage', [
                'parent'    =>    '0',
                'label'        =>    'Quản lý chính',
            ]);
        });
    }
}
