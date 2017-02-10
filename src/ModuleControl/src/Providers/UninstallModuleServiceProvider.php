<?php 
/**
 * ModuleAlias: module-control
 * ModuleName: module-control
 * Description: The script will run when you uninstall module. Suggest are drop database, remove files, etc...
 * @author: noname
 * @version: 1.0
 * @package: PhambinhCMS
 */
namespace Phambinh\Cms\ModuleControl\Providers;

use Illuminate\Support\ServiceProvider;

class UninstallModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        app()->booted(function () {
            $this->booted();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }

    private function booted()
    {
        $this->dropSchema();
    }

    private function dropSchema()
    {
        // code here...
    }
}
