<?php

namespace Hugostech\Wechat\Listeners;


use Hugostech\Wechat\Events\WcSubscriberInfoEvent;
use Hugostech\Wechat\Facade\Wechat;
use Hugostech\Wechat\model\WcSubscriber;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WcSubscriberInfoEventListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  WcSubscriberInfoEvent  $event
     * @return void
     */
    public function handle(WcSubscriberInfoEvent $event)
    {
        $subscriber = WcSubscriber::where('openid',$event->openid)->first();
        if (is_null($subscriber)){
            WcSubscriber::create(Wechat::handler('getSubscriberInfo', $event->openid));
        }
    }
}
