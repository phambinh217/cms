<?php 
/**
 * ModuleAlias: contact
 * ModuleName: contact
 * Description: Route of module contact.This bellow have 3 type route: normal rotue, admin route, api route
 * to use, you have to uncommnet it
 * @author: noname
 * @version: 1.0
 * @package: PhambinhCMS
 */

Route::group(['module' => 'contact', 'namespace' => 'Phambinh\Cms\Contact\Http\Controllers', 'middleware' => ['web'], 'prefix' => 'contact'], function () {
    Route::post('contact/{alias}', 'ContactController@store')->name('contact.store');
});

// Route::group(['module' => 'contact', 'namespace' => 'Phambinh\Cms\Contact\Http\Controllers\Admin', 'middleware' => ['web'], 'prefix' => 'admin/contact'], function() {

// });

// Route::group(['module' => 'contact', 'namespace' => 'Phambinh\Cms\Contact\Http\Controllers\Admin', 'middleware' => ['web'], 'prefix' => 'api/v1/contact'], function() {

// });
