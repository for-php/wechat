<?php
namespace wechat\lib\cache;

use wechat\lib\Config;

class CacheAdapter implements ICache
{

    private $type = 'file';

    public function __construct()
    {
        $this->type = Config::cache('type');
    }

    public function setCache($key, $value, $type=false)
    {
        // TODO: Implement cache() method.
        if ($type){
            $this->type = $type;
        }

        switch ($this->type) {

            case 'file':
                $cache = new FileCache();
                $cache->cache($key,$value);
                break;

            case 'redis':
                $cache = new RedisCache();
                $cache->cache($key,$value);
                break;

            default:
                throw new \Exception('请选择有效的缓存方式');
        }

    }

    public function getCache($key,$type=false)
    {
        // TODO: Implement getCache() method.
        if ($type){
            $this->type = $type;
        }

        switch ($this->type) {

            case 'file':
                $cache = new FileCache();
                $str = $cache->cache($key);
                break;

            case 'redis':
                $cache = new RedisCache();
                $str = $cache->cache($key);
                break;

            default:
                throw new \Exception('请选择有效的缓存方式');
        }

        return $str;
    }
}