<?php
namespace wechat\lib;


use wechat\lib\http\HttpAdapter;
use wechat\lib\http\IHttp;

/**
 * Class Http
 * @package wechat\lib
 * @auth: Taurus12C
 * @email: 1402410174@qq.com
 * @date: 2019-12-04 10:27:58
 */
class Http implements IHttp
{
    /**
     * @desc 发送请求
     * @param $type
     * @param $url
     * @param $data
     * @return bool|mixed
     */
    public function http($type, $url, $data)
    {
        // TODO: Implement http() method.
        $http = new HttpAdapter();
        $url = trim($url);
        return $http->http($type, $url, $data);
    }

    /**
     * @desc 发送请求静态调用
     * @param $type
     * @param $url
     * @param bool $data
     * @return bool|mixed
     */
    public static function curl($type, $url, $data=false){
        return (new self())->http($type, $url, $data);
    }
}