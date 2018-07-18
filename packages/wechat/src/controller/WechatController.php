<?php

namespace Hugostech\Wechat\Controller;

use Hugostech\Wechat\Facade\Wechat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class WechatController extends Controller
{
    public function entry(Request $request){
        Log::info($request->getContent());
        $xml = simplexml_load_string($request->getContent(),'SimpleXMLElement', LIBXML_NOCDATA);
        if($xml->MsgType=='event'){
            return Wechat::handler('eventHandler',$xml);
        }else{
            return Wechat::handler('messageHandler',$xml);
        }
    }

    public function verify(Request $request){
        return Wechat::activeAccount($request);
    }

    public function jump(Request $request, $hash){
        return Wechat::auth()->scope_code_handler($request, $hash);
    }
}
