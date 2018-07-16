<?php

namespace Hugostech\Wechat\Controller;

use Hugostech\Wechat\Facade\Wechat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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

        $this->validate($request, [
            'long_url'=>'required',
            'scope' =>'required',
        ]);
        if ($request->has('shorturl')){
            $url = $request->long_url;
        }else{
            $hash = md5(uniqid('nzci'));
            $dst = $request->long_url;
            $note = \GuzzleHttp\json_encode($request->all());
            DB::table('wechat_mapped_links')->insert(
                compact('hash','dst','note')
            );
            $url = Wechat::auth()->scope_url(route('wechat_scope_rediction',compact('hash')), $request->scope, $request->state);
        }

        return Wechat::handler('long2short',$url);
    }
    public function subscribers(){
        return view('wechat::console.subscribers');
    }

    public function syncSubscriber(Request $request){

        $openids = [];
        //to do fetch all openid
        if ($request->has('sync_subscriber')){
            $openids = Wechat::handler('getSubscriberList');
        }
        return $openids;

        //to do sync subscriber openid
    }
}
