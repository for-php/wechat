<?php
namespace wechat\lib\cache;


/**
 * Interface ICacheMethod
 * @package wechat\lib\cache
 * @auth: Taurus12C
 * @email: 1402410174@qq.com
 * @date: Time: 2019-12-04 10:30:44
 */
interface ICacheMethod
{
    /**
     * @desc
     * @param $key
     * @param $value
     * @param $timeout
     * @return mixed
     */
    public function cache($key, $value, $timeout);

}