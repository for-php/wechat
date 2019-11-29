<?php


namespace wechat\lib;


class Config
{

    private static $instance;

    private static $config=false;

    private function __construct()
    {

    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public static function getInstance()
    {

        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __get($name)
    {
        // TODO: Implement __get() method.
        if(!self::$config){
            self::$config = require '../config.php';
        }
        return self::$config[$name];
    }

    public static function __callStatic($name, $arguments)
    {
        // TODO: Implement __callStatic() method.
        if(!self::$config){
            self::$config = require '../config.php';
        }

        if ($arguments){
            return self::$config[$name][$arguments];
        }else{
            return self::$config[$name];
        }

    }

}