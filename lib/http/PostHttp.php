<?php


namespace wechat\lib\http;


/**
 * Class PostHttp
 * @package wechat\lib\http
 * @auth: Taurus12C
 * @email: 1402410174@qq.com
 * @date: 2019-12-04 10:29:32
 */
class PostHttp implements IHttpMethod
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
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL,$url);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $data = curl_exec($ch);//运行curl
        curl_close($ch);
        return $data;
    }
}