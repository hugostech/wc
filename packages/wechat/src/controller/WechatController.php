<?php

namespace Hugostech\Wechat\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WechatController extends Controller
{
    public function entry(Request $request){
        return json_encode(['result'=>true]);
    }
}
