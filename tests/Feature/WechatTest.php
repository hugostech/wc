<?php

namespace Tests\Feature;

use Hugostech\Wechat\Facade\Wechat;
use Hugostech\Wechat\helper\Signature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WechatTest extends TestCase
{
    use Signature;
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

    public function testController(){
        $response = $this->json('POST','/wechat/cb');
        $response->assertStatus(200);
    }

    public function testActiveAccount(){
        $timestamp  = time();
        $nonce = uniqid('test');
        $echostr = 'testSignature';
        $signature = $this->sign(compact('timestamp','nonce'));
        $response = $this->call('GET','/wechat/cb',compact('timestamp','nonce','echostr','signature'));
        $response->assertStatus(200)->assertSee($echostr);
    }

    public function testGetAccessToken(){
        $token = Wechat::getAccessToken();
        $this->assertEquals(cache('wc_access_token'), $token);
    }
}
