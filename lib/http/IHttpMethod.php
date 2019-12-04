<?php


namespace wechat\lib\http;


/**
 * Interface IHttpMethod
 * @package wechat\lib\http
 * @auth: Taurus12C
 * @email: 1402410174@qq.com
 * @date: Time: 2019-12-04 10:29:25
 */
interface IHttpMethod
{
    /**
     * @desc
     * @param $url
     * @param $data
     * @return mixed
     */
    public function http($url, $data);
}