<?php
namespace wechat\lib\cache;

use wechat\lib\Config;


/**
 * Class RedisCache
 * @package wechat\lib\cache
 * @auth: Taurus12C
 * @email: 1402410174@qq.com
 * @date: 2019-12-04 10:30:51
 */
class RedisCache implements ICacheMethod
{

    /**
     * @desc
     * @param $key
     * @param bool $value
     * @param $timeout
     * @return bool|mixed|string
     */
    public function cache($key, $value=false, $timeout)
    {
        // TODO: Implement cache() method.

        if ($value){
            $redis = $this->redis();
            $redis -> set($key,$value);
            $redis -> expire($key,$timeout);
            $redis = null;
            return true;
        }else{
            $redis = $this->redis();
            $str = $redis -> get($key);
            $redis = null;
            return $str;
        }
    }

    /**
     * @desc
     * @return \Redis
     */
    private function redis(){
        $config = Config::redis();
        $redis = new \Redis();
        $redis->connect($config['host'],$config['port']);
        $redis->auth($config['auth']);
        $redis->select($config['dbIndex']);
        return $redis;
    }

}