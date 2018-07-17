<?php

namespace Hugostech\Wechat\Listeners;

use Hugostech\Wechat\Events\TemplateMessageEvent;
use Hugostech\Wechat\Facade\Wechat;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class TemplateMessageListener implements ShouldQueue
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
     * @param  TemplateMessageEvent  $event
     * @return void
     */
    public function handle(TemplateMessageEvent $event)
    {
        Wechat::sendTemplateMessage($event->url, $event->json);
    }
}
