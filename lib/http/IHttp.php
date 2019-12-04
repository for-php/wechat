<?php


namespace wechat\lib\http;


/**
 * Interface IHttp
 * @package wechat\lib\http
 * @auth: Taurus12C
 * @email: 1402410174@qq.com
 * @date: Time: 2019-12-04 10:29:12
 */
interface IHttp
{
    /**
     * @desc
     * @param $type
     * @param $url
     * @param $data
     * @return mixed
     */
    public function http($type, $url, $data);
}