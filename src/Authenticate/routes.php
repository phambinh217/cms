<?php 
/**
 * ModuleAlias: authenticate
 * ModuleName: authenticate
 * Description: Route of module authenticate.This bellow have 3 type route: normal rotue, admin route, api route
 * to use, you have to uncommnet it
 * @author: noname
 * @version: 1.0
 * @package: PhambinhCMS
 */

Route::group(['module' => 'authenticate', 'namespace' => 'Phambinh\Cms\Authenticate\Http\Controllers\Api', 'middleware' => ['web'], 'prefix' => 'api/v1/authenticate'], function () {
    Route::resource('/', 'AuthenticateController', ['only' => ['index']]);
    Route::post('/', 'AuthenticateController@authenticate');
    Route::get('user', 'AuthenticateController@getAuthenticatedUser');
    Route::get('check', 'AuthenticateController@check');
});
