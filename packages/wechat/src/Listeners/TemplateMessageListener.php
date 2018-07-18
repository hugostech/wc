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
        $template = <<<TEMPLETE
        {
   "touser":"%s",
   "template_id":"P8XV__s7izfjopd4sJPMLAB0g-h5nr-X3KPnLHsI8XU",
   "url":"%s",
   "data":{
       "first": {
           "value":"收到新的留言！",
           "color":"#173177"
       },
       "keyword1":{
           "value":"Subsriber",
           "color":"#173177"
       },
       "keyword2": {
           "value":"%s",
           "color":"#173177"
       },
       "keyword3": {
           "value":"%s",
           "color":"#173177"
       },
       "remark":{
           "value":"请及时回复！",
           "color":"#173177"
       }
   }
}  
TEMPLETE;

        $json = printf($template,...$event->args);
        Log::error($json);
        Log::info(Wechat::message()->sendTemplateMessage($json));
    }
}
