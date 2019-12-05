<?php


namespace wechat\lib\core;


use wechat\lib\Http;

trait Menu
{
    private function menu(string $access_token,array $data):string
    {
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$access_token";
        $data = json_encode($data,JSON_UNESCAPED_UNICODE);
        $str = Http::curl('post',$url,$data);
        return $str;
    }

    private function menuInfo(string $access_token):string
    {
        $url = "https://api.weixin.qq.com/cgi-bin/get_current_selfmenu_info?access_token=$access_token";
        $str = Http::curl('get',$url);
        return $str;
    }

    private function menuDel(string $access_token):string
    {
        $url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=$access_token";
        $str = Http::curl('get',$url);
        return $str;
    }

    private function menuConditional(string $access_token,array $data,array $matchrule):string
    {
        $url = "https://api.weixin.qq.com/cgi-bin/menu/addconditional?access_token=ACCESS_TOKEN";
        $arr = array();
        $arr = array_merge($data,$matchrule);
        $str = Http::curl('post',$url,json_encode($arr));
        return $str;
    }

    private function menuConditionalInfo(string $access_token):string
    {
        $url = "https://api.weixin.qq.com/cgi-bin/menu/get?access_token=$access_token";
        $str = Http::curl('get',$url);
        return $str;
    }
}