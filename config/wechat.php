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
        't1' => 'P8XV__s7izfjopd4sJPMLAB0g-h5nr-X3KPnLHsI8XU', //notify staff
    ],
    'open_url' => 'https://open.weixin.qq.com',
    'staffs' => [
        'oW3xb1eazDn2EP0MxLLaRsupb_nw',
    ],

];
