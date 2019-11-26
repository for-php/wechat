<?php


namespace wechat\lib\cache;


class RedisCache implements ICacheMethod
{

    public function cache($key, $timeout=7000, $value=false)
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

    private function redis(){
        $config = $config = require '../../config.php';
        $redis = new \Redis();
        $redis->connect($config['redis']['host'],$config['redis']['port']);
        $redis->auth($config['redis']['auth']);
        $redis->select($config['redis']['dbIndex']);
        return $redis;
    }

}