<?php


namespace wechat\lib\core;


interface IResponseMsg
{
    public function sendText(string $toUserName,string $fromUserName,string $content):void;

    public function sendImg(string $toUserName,string $fromUserName,string $mediaId):void;

    public function sendVoice(string $toUserName,string $fromUserName,string $mediaId):void;

    public function sendVideo(string $toUserName,string $fromUserName,array $content):void;

    public function sendMusic(string $toUserName,string $fromUserName,array $content):void;

    public function sendNews(string $toUserName,string $fromUserName,array $articles):void;
}