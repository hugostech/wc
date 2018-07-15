<?php

namespace Hugostech\Wechat\model;

use Illuminate\Database\Eloquent\Model;

class WcSubscriber extends Model
{
    protected $table = 'wechat_subscribers';
    protected $fillable = [
        'openid', 'nickname', 'scope_info', 'status', 'remark', 'type', 'headimgeurl'
    ];
}
