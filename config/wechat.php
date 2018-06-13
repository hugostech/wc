<?php

return [

    /*
    |--------------------------------------------------------------------------
    | mode
    |--------------------------------------------------------------------------
    |
    | Avaiable value: dev and production
    |
    */

    'mode' => 'dev',

    /*
    |--------------------------------------------------------------------------
    | prefix
    |--------------------------------------------------------------------------
    |
    | This option determines where all the compiled Blade templates will be
    | stored for your application. Typically, this is within the storage
    | directory. However, as usual, you are free to change this value.
    |
    */

    'prefix' => 'wechat',
    'appid' => env('WC_APPID',''),
    'secret' => env('WC_SECRET',''),
    'token'=>env('WC_TOKEN',''),
    'api_urls' => [
        'https://api.weixin.qq.com',
        'https://hk.api.weixin.qq.com',
        'https://sh.api.weixin.qq.com',
        'https://sz.api.weixin.qq.com',
    ],
    'timeout'=>2,
    'template_messages' => [
        't1' => 'uMn-d1lws1TsjcnPbxJP1qRhBvHxJxxd_Xri_mQmzSU', //消息模版
    ],


];
