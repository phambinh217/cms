<?php 

Route::group(['module' => 'User', 'namespace' => 'Phambinh\Cms\User\Http\Controllers\Admin', 'middleware' => ['web'], 'prefix' => 'admin/user'], function () {
    Route::get('/', 'UserController@index')->name('admin.user.index');
    Route::get('create', 'UserController@create')->name('admin.user.create');
    Route::post('/', 'UserController@store')->name('admin.user.store');
    Route::get('{id}', 'UserController@show')->name('admin.user.show');
    Route::get('{id}/edit', 'UserController@edit')->name('admin.user.edit');
    Route::put('{id}', 'UserController@update')->name('admin.user.update');
    Route::put('{id}/disable', 'UserController@enable')->name('admin.user.enable');
    Route::put('{id}/enable', 'UserController@disable')->name('admin.user.disable');
    Route::get('{id}/popup-show', 'UserController@popupShow')->name('admin.user.popup-show');
    Route::delete('{id}', 'UserController@destroy')->name('admin.user.destroy');

    Route::get('role', 'RoleController@index')->name('admin.user.role.index');
    Route::get('role/create', 'RoleController@create')->name('admin.user.role.create');
    Route::post('role/', 'RoleController@store')->name('admin.user.role.store');
    Route::get('role/{id}', 'RoleController@show')->name('admin.user.role.show');
    Route::get('role/{id}/edit', 'RoleController@edit')->name('admin.user.role.edit');
    Route::put('role/{id}', 'RoleController@update')->name('admin.user.role.update');
    Route::delete('role/{id}', 'RoleController@destroy')->name('admin.user.role.destroy');
});

Route::group(['module' => 'User', 'namespace' => 'Phambinh\Cms\User\Http\Controllers\Api', 'middleware' => ['web'], 'prefix' => 'api/v1/user'], function () {
    Route::resource('/', 'UserController');
});
