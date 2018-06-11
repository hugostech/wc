<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 11/06/18
 * Time: 1:48 PM
 */

namespace Hugostech\Wechat\Facade;
use Illuminate\Support\Facades\Facade;

class Wechat extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'wechat';
    }
}