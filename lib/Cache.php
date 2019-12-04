<?php
namespace wechat\lib;

use wechat\lib\cache\ICache;
use wechat\lib\cache\CacheAdapter;

/**
 * Class Cache
 * @package wechat\lib
 * @auth: Taurus12C
 * @email: 1402410174@qq.com
 * @date: 2019-12-04 10:28:26
 */
class Cache implements ICache
{
    /**
     * @desc 设置缓存
     * @param $key
     * @param $value
     * @param int $timeout
     * @param $type
     * @throws \Exception
     */
    public function setCache($key, $value, $timeout=7000, $type)
    {
        // TODO: Implement setCache() method.
        $cache = new CacheAdapter();
        $cache->setCache($key,$value,$timeout,$type);
    }

    /**
     * @desc 获取缓存
     * @param $key
     * @param $type
     * @return bool|string|null
     * @throws \Exception
     */
    public function getCache($key, $type)
    {
        // TODO: Implement getCache() method.
        $cache = new CacheAdapter();
        return $cache->getCache($key,$type);
    }

    /**
     * @desc 静态方法 设置|获取 缓存
     * @param $key
     * @param bool $value
     * @param int $timeout
     * @param bool $type
     * @return bool|string|null
     * @throws \Exception
     */
    public static function cache($key, $value=false, $timeout=7000, $type=false){
        if ($value){
            self::setCache($key, $value, $timeout, $type);
        }else{
            return (new self())->getCache($key, $type);
        }
    }
}