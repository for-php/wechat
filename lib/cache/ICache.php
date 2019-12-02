<?php
namespace wechat\lib\cache;

interface ICache
{
    public function setCache($key,$value,$timeout,$type);

    public function getCache($key,$type);
}