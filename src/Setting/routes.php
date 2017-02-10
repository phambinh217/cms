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
    Route::get('general', 'SettingController@general')->name('admin.setting.general');
    Route::put('general', 'SettingController@generalUpdate')->name('admin.setting.general.update');

    Route::get('appearance/menu', 'appearanceController@menu')->name('admin.setting.appearance.menu');
    Route::post('appearance/menu', 'appearanceController@menuStore')->name('admin.setting.appearance.menu.store');
    Route::post('appearance/menu/{id}', 'appearanceController@menuAdd')->name('admin.setting.appearance.menu.add');

    Route::get('check-version', 'SettingController@checkVersion')->name('admin.setting.check-version');
});
