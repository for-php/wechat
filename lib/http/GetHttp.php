<?php


namespace wechat\lib\http;


/**
 * Class GetHttp
 * @package wechat\lib\http
 * @auth: Taurus12C
 * @email: 1402410174@qq.com
 * @date: 2019-12-04 10:28:40
 */
class GetHttp implements IHttpMethod
{
    /**
     * @desc
     * @param $url
     * @param $data
     * @return mixed
     */
    public function http($url, $data)
    {
        // TODO: Implement http() method.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        //curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//跳过证书验证
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}