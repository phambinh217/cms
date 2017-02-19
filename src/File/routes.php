<?php 

Route::group(['module' => 'File', 'namespace' => 'Phambinh\Cms\File\Http\Controllers\Admin', 'middleware' => ['web'], 'prefix' => 'admin/file'], function () {
    Route::get('/', 'ElfinderController@index')->name('admin.file.index')->middleware('can:admin');
    Route::get('elfinder/stand-alone', 'ElfinderController@standAlone')->name('admin.file.stand-alone')->middleware('can:admin');
    Route::any('elfinder/connector', 'ElfinderController@connector')->name('admin.file.connector');
});
