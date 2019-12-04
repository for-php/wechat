<?php


namespace wechat\lib\core;


/**
 * Interface IAuth
 * @package wechat\lib\core
 * @auth: Taurus12C
 * @email: 1402410174@qq.com
 * @date: Time: 2019-12-04 10:29:53
 */
interface IAuth
{

    public function getGlobalAccessToken();

    /**
     * @param $redirect_uri
     * @param $state
     */
    public function webAuth($redirect_uri, $state);

    public function getOpenId();

    public function getUserInfo();
}