<?php


namespace wechat\lib\core;


use wechat\lib\Cache;
use wechat\lib\Config;
use wechat\lib\Http;

/**
 * Trait Auth
 * @package wechat\lib\core
 * @auth: Taurus12C
 * @email: 1402410174@qq.com
 * @date: Time: 2019-12-04 10:29:44
 */
trait Auth
{
    /**
     * @desc 微信服务器接入验证
     * @return bool
     */
    public function checkSignature():bool
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $echostr = $_GET['echostr'];
        $token = Config::wechat('token');
        //排序验证
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        if( $tmpStr == $signature ){
            echo $echostr;
            return true;
        }else{
            return false;
        }
    }

    /**
     * @desc 全局access_token
     * @param $appid
     * @param $appsecret
     * @return mixed
     * @throws \Exception
     */
    private function globalAccessToken(string $appid, string $appsecret):array
    {
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
        $str = Http::curl('get',$url);
        Cache::cache('globalaccesstoken',$str);
        return json_decode($str,true);
    }

    /**
     * @desc 微信网页授权
     * @param $appid
     * @param $redirect_uri
     * @param $scope
     * @param $state
     */
    private function getCode(string $appid, string $redirect_uri, string $scope, $state):void
    {
        $redirect_url = urlencode($redirect_uri);
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_url&response_type=code&scope=$scope&state=$state#wechat_redirect";
        Header("Location: $url");die();
    }

    /**
     * @desc 微信用户基本信息
     * @param $appid
     * @param $appsecret
     * @param $code
     * @param string $lang
     * @return bool|mixed
     */
    private function userInfo(string $appid, string $appsecret, string $code, string $lang='zh_CN'):string
    {
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
        $str = Http::curl('get',$url);
        $arr = json_decode($str,true);
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$arr['access_token']."&openid=".$arr['openid']."&lang=$lang";
        $str = Http::curl('get',$url);
        return $str;
    }

    /**
     * @desc 用户openid
     * @param $appid
     * @param $appsecret
     * @param $code
     * @return mixed
     */
    private function openId(string $appid, string $appsecret, string $code):string
    {
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
        $str = Http::curl('get',$url);
        return json_decode($str,true)['openid'];
    }

}