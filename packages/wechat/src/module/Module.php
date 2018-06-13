<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 11/06/18
 * Time: 11:48 AM
 */

namespace Hugostech\Wechat\module;


use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Hugostech\Wechat\helper\Signature;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Psr7;

class Module
{
    use Signature;
    protected $httpClient;
    protected $api_url;
    public function __construct(Client $client)
    {
        $this->httpClient = $client;
        $this->api_url = 0;
    }

    public function getAccessToken(){
        return Cache::remember('wc_access_token',Carbon::now()->addSeconds(7000),function (){
            $this->getAccessTokenFromWC();
        });
    }

    public function getAccessTokenFromWC(){
        $url = Config::get('wechat.api_urls',['https://api.weixin.qq.com'])[$this->api_url];
        $query = [
            'grant_type'=>'client_credential',
            'appid'=>Config::get('wechat.appid',''),
            'secret'=>Config::get('wechat.secret','')
        ];
        $res = $this->httpClient->request('GET',$url,compact('query'));
    }

    private function makeRequest($url,$method='GET',$options=[]){
        try{
            $request = new Request($method, $url);
            return $this->httpClient->send($request,$options);
        }catch (RequestException $e){
            if (Config::get('wechat.mode')==='dev'){
                Log::error(Psr7\str($e->getResponse()));
            }
            if ($this->selectServer()){
                $this->{__FUNCTION__}();
            }
        }


    }

    private function selectServer(){
        $server = $this->api_url + 1;
        if ($server >= count(Config::get('wechat.api_urls'))){
            $server = 0;
        }
        $this->api_url = $server;
        return true;
    }


}