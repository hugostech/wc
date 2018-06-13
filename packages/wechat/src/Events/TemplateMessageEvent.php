<?php

namespace Hugostech\Wechat\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TemplateMessageEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $json;
    public $url;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($json, $url)
    {
        $this->json = $json;
        $this->url = $url;
    }

}
