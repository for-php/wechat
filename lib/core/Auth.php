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
        return $str;
    }

    private function getCode()
    {

    }

    private function webAccessToken()
    {

    }

    public function getWebAccessToken()
    {

    }
}