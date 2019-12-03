<?php


namespace wechat\lib\core;


interface IAuth
{
    public function getGlobalAccessToken();

    public function webAuth($redirect_uri,$state);

    public function getOpenId();

    public function getUserInfo();
}