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

});