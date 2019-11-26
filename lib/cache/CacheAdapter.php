<?php
namespace wechat\lib\cache;


class CacheAdapter implements ICache
{

    private $type;

    public function setCache($key, $value, $type=false)
    {
        // TODO: Implement cache() method.
        if (!$type){
            $config = require '../../config.php';
            $this->type = $config['cache']['type'];
        }

        switch ($type) {

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
        $config = require '../../config.php';
        if (!$type){
            $this->type = $config['cache']['type'];
        }

        switch ($type) {

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