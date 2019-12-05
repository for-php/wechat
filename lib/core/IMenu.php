<?php


namespace wechat\lib\core;


interface IMenu
{
    public function setMenu(array $data):bool;

    public function getMenuInfo():string;

    public function delMenu():bool;

    public function setMenuConditional(array $data,array $matchrule):bool;

    public function getMenuConditionalInfo():string;
}