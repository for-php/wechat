<?php
namespace wechat\lib;

use wechat\lib\cache\ICache;
use wechat\lib\cache\CacheAdapter;

class Cache implements ICache
{
    public function setCache($key, $value, $type)
    {
        // TODO: Implement setCache() method.
        $cache = new CacheAdapter();
        $cache->setCache($key,$value,$type);
    }

    public function getCache($key, $type)
    {
        // TODO: Implement getCache() method.
        $cache = new CacheAdapter();
        return $cache->getCache($key,$type);
    }

    public static function cache($key, $value=false, $type=false){
        if ($value){
            self::setCache($key, $value, $type);
        }else{
            return (new self())->getCache($key, $type);
        }
    }
}