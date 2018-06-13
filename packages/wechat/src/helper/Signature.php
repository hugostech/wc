<?php
/**
 * Created by PhpStorm.
 * User: hankunwang
 * Date: 11/06/18
 * Time: 10:51 PM
 */

namespace Hugostech\Wechat\helper;


trait Signature
{
    public function sign($data){
        $data[] = config('wechat.token');
        sort($data,SORT_STRING);
        return sha1(implode($data));
    }

    public function verify($data, $signature){
        return $this->sign($data) === $signature;
    }
}