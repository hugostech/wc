<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 11/06/18
 * Time: 4:42 PM
 */

Route::prefix(config('wechat.prefix'))->group(function (){
    Route::post('/cb','Hugostech\Wechat\Controller\WechatController@entry');
    Route::get('/cb','Hugostech\Wechat\Controller\WechatController@verify');
    Route::get('/accessToken','Hugostech\Wechat\Controller\WechatController@verify');
    Route::get('/jump/{hash}','Hugostech\Wechat\Controller\WechatController@jump')->name('wechat_scope_rediction');

});
Route::prefix(config('wechat.prefix').'/console')->name(config('wechat.prefix').'.')->middleware(['web','auth'])->group(function (){
    Route::get('/links','Hugostech\Wechat\Controller\WechatManagementController@links')->name('console_links');
    Route::post('/link','Hugostech\Wechat\Controller\WechatManagementController@createLink')->name('console_links_create');
    Route::get('/users','Hugostech\Wechat\Controller\WechatManagementController@subscribers')->name('console_subscribers');
    Route::post('/subscribers/sync','Hugostech\Wechat\Controller\WechatManagementController@syncSubscriber')->name('console_subscribers_sync');

});