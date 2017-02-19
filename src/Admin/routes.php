<?php 
Route::group(['module' => 'Admin', 'namespace' => 'Phambinh\Cms\Admin\Http\Controllers\Admin', 'middleware' => ['web'], 'prefix' => 'admin'], function () {
    Route::get('/', function () {
        return redirect(admin_url('dashboard'));
    })->name('admin');
    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard')->middleware('can:admin');
});

Route::group(['module' => 'Admin', 'namespace' => 'Phambinh\Cms\Admin\Http\Controllers', 'middleware' => ['web']], function () {
    Route::get('contact', 'ContactController@create')->name('contact.create');
});
