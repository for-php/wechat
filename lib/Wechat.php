<?php


namespace wechat\lib;

use wechat\lib\Config;
use wechat\lib\core\Auth;
use wechat\lib\core\IAuth;

class Wechat implements IAuth
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

    public function webAuth($redirect_uri,$state='state')
    {
        $this->getCode($this->appid,$redirect_uri,$state);
    }

    public function getWebAccessToken()
    {
        if (isset($_GET['code'])){
            $code = $_GET['code'];
            $arr = $this->webAccessToken($this->appid,$this->appsecret,$code);
            return $arr['access_token'];
        }

        $arr = json_decode(Cache::cache('webaccesstoken'),true);
        $redirect_url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];

        if ($arr['timeout']&&$arr['timeout']<time()){

            $refresh_token = json_decode(Cache::cache('refreshtoken'),true);
            if ($refresh_token&&$refresh_token['timeout']>time()){
                $arr = $this->refreshToken($this->appid,$refresh_token['refresh_token']);
                return $arr['access_token'];
            }
            $this->webAuth($redirect_url);
        }

        if (!$arr||array_key_exists($arr['access_token'])){
            $this->webAuth($redirect_url);
        }

        return $arr['access_token'];
    }

}