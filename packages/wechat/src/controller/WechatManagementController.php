<?php

namespace Hugostech\Wechat\Controller;

use Hugostech\Wechat\Events\WcSubscriberInfoEvent;
use Hugostech\Wechat\Facade\Wechat;
use Hugostech\Wechat\model\WcSubscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        $openids = Wechat::handler('getSubscriberList');
        //to do fetch all openid
        if ($request->has('sync_subscriber')){
//            Log::info($openids);
//            foreach ($openids as $openid){
//                event(new WcSubscriberInfoEvent($openid));
//            }
            $result = Wechat::handler('batchGetSubscribersInfo',$openids);
            Log::info($result);
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

    public function datas(){
        return $accesstoken = Wechat::getAccessToken();

    }

    public function activeMenu(){
        $menu = <<<MENU
{

	"button": [{
			"type": "View",
			"name": "实习计划",
			"url": "http://mp.weixin.qq.com/s?__biz=MzU3OTU0MjYxOQ==&mid=2247483676&idx=1&sn=f7172485c62e3b651e7d636aaba21fb4&chksm=fd65ca28ca12433e0c380b0634a611923eb36bf080a1a5b1b9f36771d43106629c578accd3ef&scene=18#wechat_redirect",
			"sub_button": []
		},
		{
			"type": "View",
			"name": "雅思保分",
			"url": "http://mp.weixin.qq.com/s?__biz=MzU3OTU0MjYxOQ==&mid=2247483668&idx=1&sn=189d0d49c2896f0832b6da106b0083ec&chksm=fd65ca20ca124336e4c54d9ff66c3196d8a71d60c563ed0b1699b111ca72d72cb9d8924adcea&scene=18#wechat_redirect",
			"sub_button": []
		},
		{
			"type": "View",
			"name": "申请课程",
			"url": "https://w.url.cn/s/AtqfU4u",
			"sub_button": []
		}

	]

}
MENU;

    }
}
