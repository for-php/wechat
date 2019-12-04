<?php
namespace wechat\lib\cache;

/**
 * Interface ICache
 * @package wechat\lib\cache
 * @auth: Taurus12C
 * @email: 1402410174@qq.com
 * @date: Time: 2019-12-04 10:30:37
 */
interface ICache
{
    /**
     * @desc
     * @param $key
     * @param $value
     * @param $timeout
     * @param $type
     * @return mixed
     */
    public function setCache($key, $value, $timeout, $type);

    /**
     * @desc
     * @param $key
     * @param $type
     * @return mixed
     */
    public function getCache($key, $type);
}