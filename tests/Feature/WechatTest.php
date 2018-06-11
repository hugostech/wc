<?php

namespace Tests\Feature;

use Hugostech\Wechat\Facade\Wechat;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WechatTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testWechatFacade(){
        $status = Wechat::get();
        $this->assertEquals("wechat worked",$status);
    }
}
