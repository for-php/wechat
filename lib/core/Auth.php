<?php


namespace wechat\lib\core;


trait Auth
{
    public function checkSignature($token,$timestamp, $nonce,$signature,$echostr)
    {
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
        
    }

    public function getGlobalAccessToken()
    {

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