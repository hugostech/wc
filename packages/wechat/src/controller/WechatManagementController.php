<?php

namespace Hugostech\Wechat\Controller;

use Hugostech\Wechat\Events\WcSubscriberInfoEvent;
use Hugostech\Wechat\Facade\Wechat;
use Hugostech\Wechat\model\WcSubscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\IsTrue;

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
        $openids = Wechat::handler('getSubscriberList');
        //to do fetch all openid
        if ($request->has('sync_subscriber')){
            foreach ($openids as $openid){
                event(new WcSubscriberInfoEvent($openid));
            }
            event(new WcSubscriberInfoEvent());
        }else{
            $subscribers = WcSubscriber::all()->pluck('openid','id')->all();
//            foreach ($openids as $openid){
//                if (in_array($openid, $subscribers)){
//
//                }
//            }
            dd($subscribers);
        }
        
        $subs = WcSubscriber::all();
        return view('wechat::console.subscribers', compact('subs'));
    }
}
