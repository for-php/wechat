<?php
namespace wechat\lib\cache;


interface ICacheMethod
{
    public function cache($key, $value, $timeout);

}