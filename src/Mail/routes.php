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

Route::group(['module' => 'mail', 'namespace' => 'Phambinh\Cms\Mail\Http\Controllers\Admin', 'middleware' => ['web'], 'prefix' => 'admin/mail'], function () {
    Route::get('/', 'MailController@index')->name('admin.mail.index')->middleware('can:admin')->middleware('can:admin');
    Route::get('create', 'MailController@create')->name('admin.mail.create')->middleware('can:admin');
    Route::get('inbox', 'MailController@inbox')->name('admin.mail.inbox')->middleware('can:admin');
    Route::get('outbox', 'MailController@outbox')->name('admin.mail.outbox')->middleware('can:admin');
    Route::get('inbox/{id}', 'MailController@inboxShow')->name('admin.mail.inbox.show')->middleware('can:admin');
    Route::get('outbox/{id}', 'MailController@outboxShow')->name('admin.mail.outbox.show')->middleware('can:admin');
    Route::get('popup-forward/{id}', 'MailController@popupForward')->name('admin.mail.popup-forward')->middleware('can:admin');
    Route::post('/', 'MailController@store')->name('admin.mail.store')->middleware('can:admin');
});
