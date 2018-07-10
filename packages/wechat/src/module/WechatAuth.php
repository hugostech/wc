<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 11/06/18
 * Time: 11:45 AM
 */

namespace Hugostech\Wechat\module;


use function GuzzleHttp\Psr7\build_query;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WechatAuth extends Module
{
    /**
     * @param $redirect_uri
     * @param string $scope ['snsapi_base', 'snsapi_userinfo']
     * @param string (option) $state mix length:128
     */
    public function scope_url($redirect_uri, $scope="snsapi_base", $state){

        $query = [
            'appid' => config('wechat.appid'),
            'redirect_uri' => $redirect_uri,
            'response_type' => 'code',
            'scope' => $scope,
            'state' => $state,
        ];
        $url = new Uri(config('wechat.open_url').'/connect/oauth2/authorize');
        $url = $url->withQuery(build_query($query));
        $url = $url->withFragment('wechat_redirect');
        return (string)$url;
    }

    public function scope_code_handler(Request $request, $hash){
        dd($request->all());
        if($request->has(['code', 'state'])){
            $state = $request->input('state');
            $code = $request->input('code');

            $row = DB::table('wechat_mapped_links')->where('hash',$hash)->first();
            if (!empty($row)){
                return $this->dstHandler($row->dst);
            }else{
                return null;
            }
        }else{
            throw new \Exception('Missing necessary params');
        }
    }

    public function getScopeAccessToken($code){
        $url = '/sns/oauth2/access_token';
        $query = [
            'appid' => config('wechat.appid'),
            'secret' => config('wechat.secret'),
            'code' => $code,
            'grant_type' => 'authorization_code'
        ];
        return $this->makeRequest($url,'GET', compact('query'));
    }

    private function dstHandler($dst){
        if (method_exists($this,$dst)){
            return $this->{$dst}();
        }else{
            return redirect($dst);
        }
    }
}