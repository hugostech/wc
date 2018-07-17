<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 11/06/18
 * Time: 11:45 AM
 */

namespace Hugostech\Wechat\module;


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





}