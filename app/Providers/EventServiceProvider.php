<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        'Hugostech\Wechat\Events\TemplateMessageEvent' => [
            'Hugostech\Wechat\Listeners\TemplateMessageListener',
        ],
        'Hugostech\Wechat\Events\ScopeEvent' => [
            'Hugostech\Wechat\Listeners\ScopeEventListener',
        ],
        'Hugostech\Wechat\Events\WcSubscriberInfoEvent' => [
            'Hugostech\Wechat\Listeners\WcSubscriberInfoEventListener',
        ],


    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
