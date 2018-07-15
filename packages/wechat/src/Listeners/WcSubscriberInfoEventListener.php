<?php

namespace Hugostech\Wechat\Listeners;

use App\Events\WcSubscriberInfoEvent;
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
        //
    }
}
