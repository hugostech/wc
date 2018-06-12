<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 11/06/18
 * Time: 4:42 PM
 */

Route::prefix(config('wechat.prefix'))->group(function (){
    Route::post('/callback.php','Hugostech\Wechat\Controller\WechatController@entry');
    Route::get('/callback.php','Hugostech\Wechat\Controller\WechatController@run');
});