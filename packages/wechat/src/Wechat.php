<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 11/06/18
 * Time: 11:38 AM
 */

namespace hugostech\laravel_wechat;


use hugostech\laravel_wechat\module\WechatAuth;
use hugostech\laravel_wechat\module\WechatHandler;
use hugostech\laravel_wechat\module\WechatMessage;
use hugostech\laravel_wechat\module\WechatPayment;

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
}