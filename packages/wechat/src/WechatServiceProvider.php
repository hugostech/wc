<?php

namespace Hugostech\Wechat;

use Illuminate\Support\ServiceProvider;

class WechatServiceProvider extends ServiceProvider
{
//    protected $listen = [
//        'Hugostech\Wechat\Events\TemplateMessageEvent' => [
//            'Hugostech\Wechat\Listeners\TemplateMessageListener',
//        ],
//        'Hugostech\Wechat\Events\ScopeEvent' => [
//            'Hugostech\Wechat\Listeners\ScopeEventListener',
//        ],
//        'Hugostech\Wechat\Events\WcSubscriberInfoEvent' => [
//            'Hugostech\Wechat\Listeners\WcSubscriberInfoEventListener',
//        ],
//    ];
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/route/route.php');
        $this->loadViewsFrom(__DIR__.'/views','wechat');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/wechat'),
            __DIR__.'/config/wechat.php' => config_path('wechat.php'),
            __DIR__.'/templates' => storage_path('app/wechat_templates'),
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
