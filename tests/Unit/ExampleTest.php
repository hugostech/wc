<?php

namespace Tests\Unit;

use GuzzleHttp\Client;
use Hugostech\Wechat\module\WechatAuth;
use Hugostech\Wechat\Wechat;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    public function testGetScopeUri(){
        $wcauth = new WechatAuth(new Client());
        $url = $wcauth->scope_url('http://test','snsapi_base','testState');
        $this->assertEquals('https://open.weixin.qq.com?appid=wx8b446f2cc2ffa931&redirect_uri=http%3A%2F%2Ftest&response_type=code&scope=snsapi_base&state=testState#wechat_redirect',$url);
    }
}
