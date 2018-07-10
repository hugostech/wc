<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 11/06/18
 * Time: 11:45 AM
 */

namespace Hugostech\Wechat\module;


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




}