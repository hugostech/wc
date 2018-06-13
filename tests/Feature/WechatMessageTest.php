<?php

namespace Tests\Feature;

use Hugostech\Wechat\Facade\Wechat;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WechatMessageTest extends TestCase
{
    public function testLoadTemplate()
    {
        $json = Wechat::sendTemplateMessage('t1',['uMn-d1lws1TsjcnPbxJP1qRhBvHxJxxd_Xri_mQmzSU','http://weixin.qq.com/download','test',123]);
//        var_dump($json);
        $this->assertEquals('te', $json);
//        $this->assertArrayHasKey('openid', $json);
    }
}
