<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 11/06/18
 * Time: 11:48 AM
 */

namespace hugostech\laravel_wechat\module;


use GuzzleHttp\Client;

class Module
{
    protected $httpClient;
    public function __construct(Client $client)
    {
        $this->httpClient = $client;
    }

}