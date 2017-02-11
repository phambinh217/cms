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

// Route::group(['module' => 'module-control', 'namespace' => 'Phambinh\Cms\ModuleControl\Http\Controllers', 'middleware' => ['web'], 'prefix' => 'module-control'], function() {

// });

Route::group(['module' => 'module-control', 'namespace' => 'Phambinh\Cms\ModuleControl\Http\Controllers\Admin', 'middleware' => ['web'], 'prefix' => 'admin/module-control'], function () {
    Route::get('module/', 'ModuleController@index')->name('admin.module-control.module.index');
    Route::get('module/create', 'ModuleController@create')->name('admin.module-control.module.create');
    Route::post('module/', 'ModuleController@store')->name('admin.module-control.module.store');
    Route::get('module/{alias}', 'ModuleController@show')->name('admin.module-control.module.show');
    Route::get('module/{alias}/edit', 'ModuleController@edit')->name('admin.module-control.module.edit');
    Route::put('module/{alias}', 'ModuleController@update')->name('admin.module-control.module.update');
    Route::delete('module/{alias}', 'ModuleController@destroy')->name('admin.module-control.module.destroy');

    Route::get('theme/', 'ThemeController@index')->name('admin.module-control.theme.index');
    Route::get('theme/create', 'ThemeController@create')->name('admin.module-control.theme.create');
    Route::post('theme/', 'ThemeController@store')->name('admin.module-control.theme.store');
    Route::get('theme/{alias}', 'ThemeController@show')->name('admin.module-control.theme.show');
    Route::get('theme/{alias}/edit', 'ThemeController@edit')->name('admin.module-control.theme.edit');
    Route::put('theme/{alias}', 'ThemeController@update')->name('admin.module-control.theme.update');
    Route::delete('theme/{alias}', 'ThemeController@destroy')->name('admin.module-control.theme.destroy');
});

// Route::group(['module' => 'module-control', 'namespace' => 'Phambinh\Cms\ModuleControl\Http\Controllers\Admin', 'middleware' => ['web'], 'prefix' => 'api/v1/module-control'], function() {

// });
