<?php


namespace wechat\lib;

use wechat\lib\Config;

abstract class Wechat
{

    protected $appid;

    protected $appsecret;

    protected $token;

    public function __construct($appid=false,$appsecret=false,$token=false)
    {
        $this->appid = $appid?$appid:Config::wechat('appid');
        $this->appsecret = $appsecret?$appsecret:Config::wechat('appsecret');
        $this->token = $token?$token:Config::wechat('token');
    }

    abstract public function auth();
}