<?php


namespace wechat\lib\core;


use wechat\lib\Cache;
use wechat\lib\Config;
use wechat\lib\Http;

trait Auth
{
    public function checkSignature()
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

    private function globalAccessToken($appid,$appsecret)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
        $str = Http::curl('get',$url);
        Cache::cache('globalaccesstoken',$str);
        return json_decode($str,true);
    }

    private function getCode($appid,$redirect_uri,$state)
    {
        $redirect_url = urlencode($redirect_uri);
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_url&response_type=code&scope=snsapi_userinfo&state=$state#wechat_redirect";
        Header("Location: $url");
    }

    private function webAccessToken($appid,$appsecret,$code)
    {
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
        $str = Http::curl('get',$url);
        Cache::cache('webaccesstoken',$str);
        $refresh_token['refresh_token'] = json_decode($str,true)['refresh_token'];
        Cache::cache('refreshtoken',json_encode($refresh_token),2505600);
        return json_decode($str,true);
    }

    private function refreshToken($appid,$refresh_token){
        $url = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=$appid&grant_type=refresh_token&refresh_token=$refresh_token";
        $str = Http::curl('get',$url);
        Cache::cache('webaccesstoken',$str);
        return json_decode($str,true);
    }

}