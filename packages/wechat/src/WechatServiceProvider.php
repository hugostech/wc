<?php

namespace Hugostech\Wechat;

use Illuminate\Support\ServiceProvider;

class WechatServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/route/route.php');
        $this->loadViewsFrom(__DIR__.'/views','wechat');
        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/wechat'),
            __DIR__.'/config/wechat.php' => config_path('wechat.php'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->make('Hugostech\Wechat\Controller\WechatController');
    }

    public $singletons = [
        'wechat' => Wechat::class,
    ];
}
