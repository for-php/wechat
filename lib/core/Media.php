<?php


namespace wechat\lib\core;


use wechat\lib\Http;

trait Media
{
    private function tempMedia(string $access_token,string $type,string $file):string
    {
        $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=$access_token&type=$type";
        $data = array('media'=> new \CURLFile($file));
        $str = Http::curl('post',$url,$data);
        return $str;
    }

    private function downloadTempMedia(string $access_token,string $media_id):string
    {
        $url = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=$access_token&media_id=$media_id";
        $str = Http::curl('get',$url);
        return $str;
    }
}