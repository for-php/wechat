<?php


namespace wechat\lib\http;


interface IHttp
{
    public function http($type,$url,$data);
}