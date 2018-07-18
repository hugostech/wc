<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 11/06/18
 * Time: 11:44 AM
 */

namespace Hugostech\Wechat\module;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class WechatMessage extends Module
{
    public function sendTemplateMessage($json){
        $result = $this->makeRequest('/cgi-bin/message/template/send','POST',compact('json'),true);
        if ($result['errcode']==0){
            Cache::put($result['msgid'],$json,10);
        }
        return $result;

    }
}