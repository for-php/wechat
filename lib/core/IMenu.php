<?php


namespace wechat\lib\core;


interface IMenu
{
    public function setMenu(string $access_token,array $data):string ;
}