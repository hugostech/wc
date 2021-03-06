<?php

namespace Hugostech\Wechat\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Log;

class WcSubscriberInfoEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $override;
    public $openid;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($openid, $override=false)
    {
        $this->openid = $openid;
        $this->override = $override;
    }

}
