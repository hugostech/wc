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


}