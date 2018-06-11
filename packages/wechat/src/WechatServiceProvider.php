<?php

namespace hugostech\laravel_wechat;

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
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Wechat::class, function($app){
            return new Wechat();
        });
    }
}
