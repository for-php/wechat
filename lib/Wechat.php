<?php


namespace wechat\lib;

use wechat\lib\Config;
use wechat\lib\core\Auth;

class Wechat
{
    use Auth;

    protected $appid;

    protected $appsecret;

    protected $token;

    public function __construct($appid=false,$appsecret=false,$token=false)
    {
        $this->appid = $appid?$appid:Config::wechat('appid');
        $this->appsecret = $appsecret?$appsecret:Config::wechat('appsecret');
        $this->token = $token?$token:Config::wechat('token');
    }

    public function getGlobalAccessToken()
    {
        $arr = json_decode(Cache::cache('globalaccesstoken'),true);

        if ($arr['timeout']&&$arr['timeout']<time()){
            $arr = $this->globalAccessToken($this->appid,$this->appsecret);
        }

        if(!$arr||array_key_exists($arr['access_token'])){
            $arr = $this->globalAccessToken($this->appid,$this->appsecret);
        }

        return $arr['access_token'];
    }

}