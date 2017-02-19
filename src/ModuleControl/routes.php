<?php 
/**
 * ModuleAlias: module-control
 * ModuleName: module-control
 * Description: Route of module admin.module-control.This bellow have 3 type route: normal rotue, admin route, api route
 * to use, you have to uncommnet it
 * @author: noname
 * @version: 1.0
 * @package: PhambinhCMS
 */
Route::group(['module' => 'module-control', 'namespace' => 'Phambinh\Cms\ModuleControl\Http\Controllers\Admin', 'middleware' => ['web'], 'prefix' => 'admin/module-control'], function () {
    Route::get('module/', 'ModuleController@index')->name('admin.module-control.module.index')->middleware('can:admin.module-control.module.index');
    Route::get('theme/', 'ThemeController@index')->name('admin.module-control.theme.index')->middleware('can:admin.module-control.theme.index');
});
