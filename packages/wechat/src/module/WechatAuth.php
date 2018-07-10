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
        $url = new Uri(config('wechat.open_url'));
        $url = $url->withQuery(build_query($query));
        $url = $url->withFragment('wechat_redirect');
        return (string)$url;
    }

    public function scope_code_handler(Request $request){
        if($request->has(['code', 'state'])){

        }else{
            throw new \Exception('Missing necessary params');
        }
    }
}