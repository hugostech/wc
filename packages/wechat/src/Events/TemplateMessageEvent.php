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
    public $template_id;
    public $args;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($template_id, ...$args)
    {
        $this->template_id = $template_id;
        $this->args = $args;
    }

}
