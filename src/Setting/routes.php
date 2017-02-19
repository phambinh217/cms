<?php 
/**
 * ModuleAlias: setting
 * ModuleName: setting
 * Description: Route of module setting.This bellow have 3 type route: normal rotue, admin route, api route
 * to use, you have to uncommnet it
 * @author: noname
 * @version: 1.0
 * @package: PhambinhCMS
 */

Route::group(['module' => 'setting', 'namespace' => 'Phambinh\Cms\Setting\Http\Controllers\Admin', 'middleware' => ['web'], 'prefix' => 'admin/setting'], function () {
    Route::get('general', 'SettingController@general')->name('admin.setting.general')->middleware('can:admin.setting.general');;
    Route::put('general', 'SettingController@generalUpdate')->name('admin.setting.general.update')->middleware('can:admin.setting.general');
});
