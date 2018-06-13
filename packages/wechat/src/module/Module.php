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
use GuzzleHttp\Exception\ClientException;
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
//        return Config::get('wechat.api_urls')[$this->api_url];

        return Cache::remember('wc_access_token',Carbon::now()->addSeconds(7000),function (){
            $this->getAccessTokenFromWC();
        });
    }

    public function getAccessTokenFromWC(){

        $query = [
            'grant_type'=>'client_credential',
            'appid'=>Config::get('wechat.appid',''),
            'secret'=>Config::get('wechat.secret','')
        ];
        $res = $this->makeRequest('/cgi-bin/token','GET',compact('query'));
        return $res;
    }

    private function makeRequest($url,$method='GET',$options=[]){
        try{
            $realurl = Config::get('wechat.api_urls')[$this->api_url].$url;
            $request = new Request($method, $realurl);

            $res = $this->httpClient->send($request,$options);
            $result = json_decode($res->getBody(),true);
            if (isset($result['errcode'])){
                $this->logError(print_r($result,true));
            }else{
                return $result['access_token'];
            }
        }catch (RequestException $e){
            $this->logError('re');
            $this->logError(Psr7\str($e->getRequest()));
            if ($e->hasResponse()){
                $this->logError(Psr7\str($e->getResponse()));
            }
            if ($this->selectServer()){
                $this->{__FUNCTION__}($url,$method,$options);
            }
        }catch (ClientException $e){
            $this->logError(Psr7\str($e->getRequest()));
            $this->logError(Psr7\str($e->getResponse()));
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

    private function logError($e){
        if (Config::get('wechat.mode')==='dev'){
            Log::error($e);
        }
    }


}