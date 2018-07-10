<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 11/06/18
 * Time: 11:38 AM
 */

namespace Hugostech\Wechat;
use Hugostech\Wechat\module\WechatAuth;
use Hugostech\Wechat\module\WechatHandler;
use Hugostech\Wechat\module\WechatMessage;
use Hugostech\Wechat\module\WechatPayment;
use Illuminate\Http\Request;

class Wechat
{
    protected $auth, $handler, $payment, $message;
    public function __construct(WechatAuth $auth, WechatHandler $handler, WechatPayment $payment, WechatMessage $message)
    {
        $this->auth = $auth;
        $this->handler = $handler;
        $this->payment = $payment;
        $this->message = $message;
    }

    public function get(){
        return 'wechat worked';
    }

    public function activeAccount($request){
        return $this->handler->activeAccount($request);
    }

    public function getAccessToken(){
        return $this->handler->getAccessToken();
    }

    public function sendTemplateMessage($tn, $data){
        $file = file_get_contents(storage_path('app/wechat_templates/'.config('wechat.template_messages')[$tn]));
        $json = printf($file, ...$data);
        $this->message->sendTemplateMessage($json);
    }

    public function handler($method, ...$args){
        return $this->handler->{$method}(...$args);
    }


    public function auth(){
        return $this->auth;
    }




}