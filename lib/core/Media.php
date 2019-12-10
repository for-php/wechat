<?php


namespace wechat\lib\core;


use wechat\lib\Http;

trait Media
{
    private function tempMedia(string $access_token,string $type,string $file):string
    {
        $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=$access_token&type=$type";
        $data = array('media'=> new \CURLFile($file));
        $str = Http::curl('post',$url,$data);
        return $str;
    }

    private function material(string $access_token,string $type,string $file,string $title="",string $introduction=""):string
    {
        $url = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=$access_token&type=$type";
        $data = array('media'=>new \CURLFile($file));
        if($type=='video'){
            $data = array('media'=>new \CURLFile($file),'description'=>json_encode(['title'=>$title,'introduction'=>$introduction]));
        }
        $str = Http::curl('post',$url,$data);
        return $str;
    }

    private function downloadTempMedia(string $access_token,string $media_id):string
    {
        $url = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=$access_token&media_id=$media_id";
        $str = Http::curl('get',$url);
        return $str;
    }

    private function downloadJssdkMedia(string $access_token,string $media_id)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/media/get/jssdk?access_token=$access_token&media_id=$media_id";
        $str = Http::curl('get',$url);
        return $str;
    }

    private function materialDel(string $access_token,string $media_id):string
    {
        $url = "https://api.weixin.qq.com/cgi-bin/material/del_material?access_token=$access_token";
        $data = json_encode(['media_id'=>$media_id]);
        $str = Http::curl('post',$url,$data);
        return $str;
    }

    private function extension(string $path,array $arr):bool
    {
        $extension = pathinfo($path,PATHINFO_EXTENSION );
        if (!is_file($path)){
            return false;
        }
        foreach ($arr as $v){
            if($extension==$v){
                return true;
            }
        }
        return false;
    }
}