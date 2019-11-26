<?php
namespace wechat\lib\cache;


interface ICacheMethod
{
    public function cache($key, $timeout, $value);
}