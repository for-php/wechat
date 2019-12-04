<?php
namespace wechat\lib\cache;

use wechat\lib\Config;

/**
 * Class CacheAdapter
 * @package wechat\lib\cache
 * @auth: Taurus12C
 * @email: 1402410174@qq.com
 * @date: 2019-12-04 10:30:06
 */
class CacheAdapter implements ICache
{

    /**
     * @desc
     * @var string
     */
    private $type = 'file';

    /**
     * CacheAdapter constructor.
     */
    public function __construct()
    {
        $this->type = Config::cache('type');
    }

    /**
     * @desc
     * @param $key
     * @param $value
     * @param $timeout
     * @param bool $type
     * @throws \Exception
     */
    public function setCache($key, $value, $timeout, $type=false)
    {
        // TODO: Implement cache() method.
        if ($type){
            $this->type = $type;
        }

        switch ($this->type) {

            case 'file':
                $cache = new FileCache();
                $cache->cache($key,$value,$timeout);
                break;

            case 'redis':
                $cache = new RedisCache();
                $cache->cache($key,$value,$timeout);
                break;

            default:
                throw new \Exception('请选择有效的缓存方式');
        }

    }

    /**
     * @desc
     * @param $key
     * @param bool $type
     * @return bool|string|null
     * @throws \Exception
     */
    public function getCache($key, $type=false)
    {
        // TODO: Implement getCache() method.
        if ($type){
            $this->type = $type;
        }

        switch ($this->type) {

            case 'file':
                $cache = new FileCache();
                $str = $cache->cache($key,$value=false,$timeout=7000);
                break;

            case 'redis':
                $cache = new RedisCache();
                $str = $cache->cache($key,$value=false,$timeout=7000);
                break;

            default:
                throw new \Exception('请选择有效的缓存方式');
        }

        return $str;
    }
}