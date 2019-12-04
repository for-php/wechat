<?php


namespace wechat\lib;


/**
 * Class Config
 * @package wechat\lib
 * @auth: Taurus12C
 * @email: 1402410174@qq.com
 * @date: 2019-12-04 10:28:16
 */
class Config
{

    /**
     * @desc 对象实例
     * @var object
     */
    private static $instance;

    /**
     * @desc 配置信息
     * @var bool
     */
    private static $config=false;

    /**
     * Config constructor.
     */
    private function __construct()
    {

    }

    /**
     * @desc 防止对象克隆
     */
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    /**
     * @desc 获取对象实例
     * @return Config
     */
    public static function getInstance()
    {

        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        // TODO: Implement __get() method.
        if(!self::$config){
            self::$config = require __DIR__.'/../config.php';
        }
        return self::$config[$name];
    }

    /**
     * @desc 静态方法获取配置文件
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        // TODO: Implement __callStatic() method.
        if(!self::$config){
            self::$config = require __DIR__.'/../config.php';
        }

        if ($arguments){
            return self::$config[$name][$arguments[0]];
        }else{
            return self::$config[$name];
        }

    }

}