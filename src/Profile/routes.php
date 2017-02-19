<?php 
/**
 * ModuleAlias: profile
 * ModuleName: profile
 * Description: Route of module profile.This bellow have 3 type route: normal rotue, admin route, api route
 * to use, you have to uncommnet it
 * @author: noname
 * @version: 1.0
 * @package: PhambinhCMS
 */

Route::group(['module' => 'profile', 'namespace' => 'Phambinh\Cms\Profile\Http\Controllers\Admin', 'middleware' => ['web'], 'prefix' => 'admin/profile'], function () {
    Route::get('/', 'ProfileController@show')->name('admin.profile.show')->middleware('can:admin');
    Route::get('change-password', 'ProfileController@changePassword')->name('admin.profile.change-password')->middleware('can:admin');
    Route::get('sales', 'ProfileController@sales')->name('admin.profile.sales')->middleware('can:admin');
    Route::put('/', 'ProfileController@update')->name('admin.profile.update')->middleware('can:admin');
    Route::put('change-password', 'ProfileController@updatePassword')->name('admin.profile.update-passowrd')->middleware('can:admin');
});
