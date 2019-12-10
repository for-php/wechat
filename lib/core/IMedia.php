<?php


namespace wechat\lib\core;


interface IMedia
{
    public function addImgTempMedia(string $file):string;

    public function addVoiceTempMedia(string $file):string;

    public function addVideoTempMedia(string $file):string;

    public function addThumbTempMedia(string $file):string;

    public function addImgMaterial(string $file):string;

    public function addVoiceMaterial(string $file):string;

    public function addVideoMaterial(string $file,string $title,string $introduction):string;

    public function addThumbMaterial(string $file):string;

    public function getTempMedia(string $media_id);

    public function getJssdkMedia(string $media_id):string;

    public function delMaterial(string $media_id):bool;
}