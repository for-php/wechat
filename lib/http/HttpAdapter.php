<?php


namespace wechat\lib\http;


class HttpAdapter implements IHttp
{
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