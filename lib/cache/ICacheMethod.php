<?php
namespace wechat\lib\cache;


interface ICacheMethod
{
    public function fileCache($key,$value);

    public function redisCache($key,$value);
}