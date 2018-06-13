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
}