<?php


namespace wechat\lib\http;


/**
 * Class HttpAdapter
 * @package wechat\lib\http
 * @auth: Taurus12C
 * @email: 1402410174@qq.com
 * @date: 2019-12-04 10:29:00
 */
class HttpAdapter implements IHttp
{
    /**
     * @desc
     * @param $type
     * @param $url
     * @param $data
     * @return bool|mixed
     */
    public function http($type, $url, $data)
     {
         // TODO: Implement http() method.
         switch ($type) {
             case 'get':
                 $get = new GetHttp();
                 $str = $get -> http($url, '');
                 break;

             case 'post':
                 $post = new PostHttp();
                 $str = $post -> http($url, $data);
                 break;

             default:
                 $str = false;
                 break;
         }
         return $str;
     }
}