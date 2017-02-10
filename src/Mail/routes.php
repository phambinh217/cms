<?php 
/**
 * ModuleAlias: mail
 * ModuleName: mail
 * Description: Route of module mail.This bellow have 3 type route: normal rotue, admin route, api route
 * to use, you have to uncommnet it
 * @author: noname
 * @version: 1.0
 * @package: PhambinhCMS
 */

// Route::group(['module' => 'mail', 'namespace' => 'Phambinh\Cms\Mail\Http\Controllers', 'middleware' => ['web'], 'prefix' => 'mail'], function() {

// });

Route::group(['module' => 'mail', 'namespace' => 'Phambinh\Cms\Mail\Http\Controllers\Admin', 'middleware' => ['web'], 'prefix' => 'admin/mail'], function () {
    Route::get('/', 'MailController@index')->name('admin.mail.index');
    Route::get('create', 'MailController@create')->name('admin.mail.create');
    Route::get('inbox', 'MailController@inbox')->name('admin.mail.inbox');
    Route::get('outbox', 'MailController@outbox')->name('admin.mail.outbox');
    Route::get('inbox/{id}', 'MailController@inboxShow')->name('admin.mail.inbox.show');
    Route::get('outbox/{id}', 'MailController@outboxShow')->name('admin.mail.outbox.show');
    Route::get('popup-forward/{id}', 'MailController@popupForward')->name('admin.mail.popup-forward');
    Route::post('/', 'MailController@store')->name('admin.mail.store');
});

// Route::group(['module' => 'mail', 'namespace' => 'Phambinh\Cms\Mail\Http\Controllers\Admin', 'middleware' => ['web'], 'prefix' => 'api/v1/mail'], function() {

// });
