<?php
namespace wechat\lib\cache;

interface ICache
{
    public function cache($key,$value,$type);
}