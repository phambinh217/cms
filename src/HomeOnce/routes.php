<?php 
/**
 * ModuleAlias: home
 * ModuleName: home
 * Description: Route of module home.This bellow have 3 type route: normal rotue, admin route, api route
 * to use, you have to uncommnet it
 * @author: noname
 * @version: 1.0
 * @package: PhambinhCMS
 */


Route::group(['module' => 'HomeOnce', 'namespace' => 'Phambinh\Cms\HomeOnce\Http\Controllers', 'middleware' => ['web'], 'prefix' => 'home-once'], function () {
    Route::get('/', 'HomeController@index')->name('index');
});

// Route::group(['module' => 'HomeOnce', 'namespace' => 'Phambinh\Cms\HomeOnce\Http\Controllers\Admin', 'middleware' => ['web'], 'prefix' => 'admin'], function() {

// });
