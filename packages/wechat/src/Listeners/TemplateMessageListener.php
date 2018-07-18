<?php

namespace Hugostech\Wechat\Listeners;

use Hugostech\Wechat\Events\TemplateMessageEvent;
use Hugostech\Wechat\Facade\Wechat;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class TemplateMessageListener
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
        $template_name = config('wechat.template_messages')[$event->template_id];
        $template = file_get_contents(storage_path('app/wechat_templates/'.$template_name));
        $json = printf($template,...$event->args);
        $json = \GuzzleHttp\json_decode($json,true);
        Log::info(Wechat::sendTemplateMessage($json));
    }
}
