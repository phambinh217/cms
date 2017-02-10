<?php 

// Route::group(['module' => 'File', 'namespace' => 'Phambinh\Cms\File\Http\Controllers', 'middleware' => ['web'], 'prefix' => 'file'], function() {
//     Route::resource('/', 'FileController');
// });

Route::group(['module' => 'File', 'namespace' => 'Phambinh\Cms\File\Http\Controllers\Admin', 'middleware' => ['web'], 'prefix' => 'admin/file'], function () {
    Route::get('/', 'ElfinderController@index')->name('admin.file.index');
    Route::get('elfinder/stand-alone', 'ElfinderController@standAlone')->name('admin.file.stand-alone');
    Route::any('elfinder/connector', 'ElfinderController@connector')->name('admin.file.connector');
});

// Route::group(['module' => 'File', 'namespace' => 'Phambinh\Cms\File\Http\Controllers\Admin', 'middleware' => ['web'], 'prefix' => 'api/v1/file'], function() {

// });
