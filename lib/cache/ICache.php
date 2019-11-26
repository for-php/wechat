<?php
namespace wechat\lib\cache;

interface ICache
{
    public function setCache($key,$value,$type);

    public function getCache($key,$type);
}