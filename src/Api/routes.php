<?php 

Route::group(['module' => 'Api', 'namespace' => 'Phambinh\Cms\Api\Http\Controllers', 'middleware' => ['web'], 'prefix' => 'api/helper'], function () {
    Route::get('bcrypt', 'HelperController@bcrypt');
    Route::get('str_random', 'HelperController@str_random');
    Route::get('str_slug', 'HelperController@str_slug');
});
