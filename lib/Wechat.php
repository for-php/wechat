<?php


namespace wechat\lib;

use wechat\lib\Config;
use wechat\lib\core\Auth;
use wechat\lib\core\IAuth;

/**
 * Class Wechat
 * @package wechat\lib
 * @auth: Taurus12C
 * @email: 1402410174@qq.com
 * @date: 2019-12-04 10:27:35
 */
class Wechat implements IAuth
{
    use Auth;

    /**
     * @desc 微信 服务号|订阅号 appid
     * @var bool|string
     */
    protected $appid = '';

    /**
     * @desc 微信 服务号|订阅号 appsecret
     * @var bool|string
     */
    protected $appsecret = '';

    /**
     * @desc 微信 服务号|订阅号 token
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
     * @desc 获取全局access_token
     * @return string
     */
    public function getGlobalAccessToken():string
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
     * @desc 引导用户前往微信授权页面
     * @param $redirect_uri 授权后重定向地址
     * @param $scope 应用授权作用域
     * @param string $state 授权回调参数
     */
    public function webAuth(string $redirect_uri, string $scope, string $state='state'):void
    {
        $this->getCode($this->appid,$redirect_uri,$scope,$state);
    }

    /**
     * @desc 获取用户基本信息
     * @return string|mixed
     */
    public function getUserInfo()
    {

        if (isset($_GET['code'])){
            $code = $_GET['code'];
            $str = $this->userInfo($this->appid,$this->appsecret,$code);
            return $str;
        }

        $redirect_url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
        $this->webAuth($redirect_url,'snsapi_userinfo');

    }

    /**
     * @desc 获取用户openid
     * @return mixed
     */
    public function getOpenId()
    {

        if (isset($_GET['code'])){
            $code = $_GET['code'];
            $str = $this->openId($this->appid,$this->appsecret,$code);
            return $str;
        }

        $redirect_url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
        $this->webAuth($redirect_url,'snsapi_base ');
    }

}