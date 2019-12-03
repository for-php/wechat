<?php


namespace wechat\lib;

use wechat\lib\Config;
use wechat\lib\core\Auth;
use wechat\lib\core\IAuth;

/**
 * Class Wechat
 * @package wechat\lib
 */
class Wechat implements IAuth
{
    use Auth;

    /**
     * @var bool|string
     */
    protected $appid = '';

    /**
     * @var bool|string
     */
    protected $appsecret = '';

    /**
     * @var bool|string
     */
    protected $token = '';

    /**
     * Wechat constructor.
     * @param bool $appid
     * @param bool $appsecret
     * @param bool $token
     */
    public function __construct($appid=false, $appsecret=false, $token=false)
    {
        $this->appid = $appid?$appid:Config::wechat('appid');
        $this->appsecret = $appsecret?$appsecret:Config::wechat('appsecret');
        $this->token = $token?$token:Config::wechat('token');
    }

    /**
     * @return mixed
     */
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

    /**
     * @param $redirect_uri
     * @param string $state
     */
    public function webAuth($redirect_uri, $scope, $state='state')
    {
        $this->getCode($this->appid,$redirect_uri,$scope,$state);
    }

    public function getUserInfo(){

        if (isset($_GET['code'])){
            $code = $_GET['code'];
            $str = $this->userInfo($this->appid,$this->appsecret,$code);
            return $str;
        }

        $redirect_url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
        $this->webAuth($redirect_url,'snsapi_userinfo');

    }

    public function getOpenId(){

        if (isset($_GET['code'])){
            $code = $_GET['code'];
            $str = $this->openId($this->appid,$this->appsecret,$code);
            return $str;
        }

        $redirect_url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
        $this->webAuth($redirect_url,'snsapi_base ');
    }

}