<?php

Route::group(['module' => 'User', 'namespace' => 'Phambinh\Cms\User\Http\Controllers\Admin', 'middleware' => ['web'], 'prefix' => 'admin/user'], function () {
    Route::get('/', 'UserController@index')->name('admin.user.index')->middleware('can:admin.user.index');
    Route::get('create', 'UserController@create')->name('admin.user.create')->middleware('can:admin.user.create');
    Route::post('/', 'UserController@store')->name('admin.user.store')->middleware('can:admin.user.create');
    Route::get('{user}', 'UserController@show')->name('admin.user.show')->middleware('can:admin.user.show,user');
    Route::get('{user}/edit', 'UserController@edit')->name('admin.user.edit')->middleware('can:admin.user.edit,user');
    Route::put('{user}', 'UserController@update')->name('admin.user.update')->middleware('can:admin.user.edit,user');
    Route::put('{user}/disable', 'UserController@enable')->name('admin.user.enable')->middleware('can:admin.user.enable,user');
    Route::put('{user}/enable', 'UserController@disable')->name('admin.user.disable')->middleware('can:admin.user.disable,user');
    Route::get('{user}/popup-show', 'UserController@popupShow')->name('admin.user.popup-show')->middleware('can:admin.user.show,user');
    Route::delete('{user}', 'UserController@destroy')->name('admin.user.destroy')->middleware('can:admin.user.destroy,user');

    Route::get('{user}/login-as', 'UserController@loginAs')->name('admin.user.login-as')->middleware('can:admin.user.login-as');

    Route::get('role', 'RoleController@index')->name('admin.user.role.index')->middleware('can:admin.user.role.index');
    Route::get('role/create', 'RoleController@create')->name('admin.user.role.create')->middleware('can:admin.user.role.create');
    Route::post('role/', 'RoleController@store')->name('admin.user.role.store')->middleware('can:admin.user.role.create');
    Route::get('role/{role}', 'RoleController@show')->name('admin.user.role.show')->middleware('can:admin.user.role.show,role');
    Route::get('role/{role}/edit', 'RoleController@edit')->name('admin.user.role.edit')->middleware('can:admin.user.role.edit,role');
    Route::put('role/{role}', 'RoleController@update')->name('admin.user.role.update')->middleware('can:admin.user.role.edit,role');
    Route::delete('role/{role}', 'RoleController@destroy')->name('admin.user.role.destroy')->middleware('can:admin.user.role.destroy,role');
});

Route::group(['module' => 'User', 'namespace' => 'Phambinh\Cms\User\Http\Controllers\Api', 'middleware' => ['web'], 'prefix' => 'api/v1/user'], function () {
    Route::resource('/', 'UserController');
});
