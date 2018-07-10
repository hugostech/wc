<?php

namespace App\Listeners;

use App\Events\ScopeEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ScopeEventListener
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
     * @param  ScopeEvent  $event
     * @return void
     */
    public function handle(ScopeEvent $event)
    {
        //
    }
}
