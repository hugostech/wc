<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 11/06/18
 * Time: 11:45 AM
 */

namespace Hugostech\Wechat\module;


use Carbon\Carbon;
use Hugostech\Wechat\Events\TemplateMessageEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class WechatHandler extends Module
{
    public function activeAccount($request){
        if ($request->has(['signature','timestamp','nonce','echostr'])){
            $data = [$request->timestamp,$request->nonce];
            if($this->verify($data,$request->signature)){
                return $request->echostr;
            }
        }
        return '';
    }

    public function long2short($long_url){
        $url = '/cgi-bin/shorturl';
        $json = [
            "action"=>"long2short",
            "long_url"=>$long_url
        ];
        $result = $this->makeRequest($url,'POST',compact('json'),true);
        return $result['short_url'];

    }

    public function getSubscriberList($next_openid = ''){
        $url = '/cgi-bin/user/get';
        $query = compact('next_openid');
        $result = $this->makeRequest($url, 'GET', compact('query'), true);
        if ($result['count']<10000){
            return $result['data']['openid'];
        }else{
            return array_merge($result['data']['openid'],$this->getSubscriberList($result['next_openid']));
        }
    }

    public function getSubscriberInfo($openid){
        $lang= 'zh_CN';
        $url = '/cgi-bin/user/info';
        $query = compact('openid','lang');
        $result = $this->makeRequest($url, 'GET', compact('query'), true);
        return $result;
    }

    public function batchGetSubscribersInfo($openids){
        $user_list = array_map(function ($openid) {
            $lang= 'zh_CN';
            return compact('openid','lang');
        }, $openids);
        $json = compact('user_list');
        $url = '/cgi-bin/user/info/batchget';
        $result = $this->makeRequest($url, 'POST', compact('json'), true);
        return $result;
    }

    public function eventHandler($xml){
        switch ($xml->type){
            case 'subscribe':
                $to = $xml->ToUserName;
                $from = $xml->FromUserName;
                $msg = '您好，欢迎关注新西兰职业学院微信公众号！点击屏幕下方的课程名称可以获取更多详细信息，或者给我们留下您的联系方式，我们的客服会尽快给你答复。';
                return $this->msgGenerator($from, $to, $msg);
        }
        return 'success';
    }

    public function messageHandler($data){
        //notify staff
        $this->notifyStaff((string)$data->Content);
        //return transfer wechat call center
        return $this->generateTransferCustomerServiceResponse($data->FromUserName, $data->ToUserName);

    }

    private function generateTransferCustomerServiceResponse($toUser,$fromUser){
        $response = <<<RESPONSE
        <xml>
             <ToUserName><![CDATA[$toUser]]></ToUserName>
             <FromUserName><![CDATA[$fromUser]]></FromUserName>
             <CreateTime>%s</CreateTime>
             <MsgType><![CDATA[transfer_customer_service]]></MsgType>
             
         </xml>
RESPONSE;
        return printf($response,time());

    }

    private function notifyStaff($content){
        foreach (config('wechat.staffs') as $openid){
            event(new TemplateMessageEvent('t1',$openid,'https://mpkf.weixin.qq.com/',$content,Carbon::now()));
        }
    }

    private function msgGenerator($to,$from,$msg){
        $msgTemplate = <<<XMLMESSAGE
                <xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[text]]></MsgType>
                <Content><![CDATA[%s]]></Content>
                </xml>
XMLMESSAGE;
        return sprintf($msgTemplate,$to,$from,time(),$msg);
    }





}