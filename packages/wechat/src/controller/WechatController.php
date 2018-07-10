<?php

namespace Hugostech\Wechat\Controller;

use Hugostech\Wechat\Facade\Wechat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WechatController extends Controller
{
    public function entry(Request $request){
        return json_encode(['result'=>true]);
    }

    public function verify(Request $request){
        return Wechat::activeAccount($request);
    }

    public function jump(Request $request, $hash){
        dd($request->all());
        return Wechat::linkHandler($request, $hash);
    }
}
