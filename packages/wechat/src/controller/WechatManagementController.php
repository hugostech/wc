<?php

namespace Hugostech\Wechat\Controller;

use Hugostech\Wechat\Facade\Wechat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WechatManagementController extends Controller
{
    public function links(){
        return view('wechat::console.links');
    }

    /**
     * @param Request $request
     * create rediction link for wechat
     */
    public function createLink(Request $request){
        return Wechat::handler('long2short',$request->long_url);
    }
    public function users(){
        return view('wechat::console.index');
    }
}
