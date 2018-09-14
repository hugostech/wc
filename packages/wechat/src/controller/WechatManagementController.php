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

    public function updateMenu(){
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
			"url": "https://mp.weixin.qq.com/s?__biz=MzU3OTU0MjYxOQ==&mid=2247483708&idx=1&sn=aa30eaf31249fe76c91702873ee9bf72&chksm=fd65ca08ca12431e70bb3d3d473631a116c500563404bb4b5d6a6c83378ccf8b8cf651cbaabe#wechat_redirect",
			"sub_button": []
		},
		{
			"type": "View",
			"name": "我要报名",
			"url": "https://w.url.cn/s/Az290xD",
			"sub_button": []
		}

	]

}
MENU;
        return Wechat::handler('createMenu',$menu);
    }
}
