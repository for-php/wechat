<?php


namespace wechat\lib\core;


interface IMedia
{
    public function addTempMedia(string $type,string $file):string;

    public function getTempMedia(string $media_id);
}