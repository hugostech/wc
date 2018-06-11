<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 11/06/18
 * Time: 11:48 AM
 */

namespace Hugostech\Wechat\module;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Config;

class Module
{
    protected $httpClient;
    protected $api_url;
    public function __construct(Client $client)
    {
        $this->httpClient = $client;
        $this->api_url = 0;
    }

    public function getAccessToken(){
        $url = Config::get('wechat.api_urls',['https://api.weixin.qq.com'])[$this->api_url];
        $query = [
            'grant_type'=>'client_credential',
            'appid'=>Config::get('wechat.appid',''),
            'secret'=>Config::get('wechat.secret','')
        ];
        $res = $this->httpClient->request('GET',$url,compact('query'));
    }

    public function get(){
        $request = new Request()
    }

}