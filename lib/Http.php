<?php
namespace wechat\lib;


use wechat\lib\http\HttpAdapter;
use wechat\lib\http\IHttp;

class Http implements IHttp
{
    public function http($type, $url, $data)
    {
        // TODO: Implement http() method.
        $http = new HttpAdapter();
        return $http->http($type, $url, $data);
    }

    public static function curl($type, $url, $data=false){
        return (new self())->http($type, $url, $data);
    }
}