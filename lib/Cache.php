<?php
namespace wechat\lib;

use wechat\lib\cache\ICache;
use wechat\lib\cache\CacheAdapter;

class Cache implements ICache
{
    public function setCache($key, $value, $type=false)
    {
        // TODO: Implement setCache() method.
        $cache = new CacheAdapter();
        $cache->setCache($key,$value,$type);
    }

    public function getCache($key, $type=false)
    {
        // TODO: Implement getCache() method.
        $cache = new CacheAdapter();
        return $cache->getCache($key,$type);
    }
}