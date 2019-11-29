<?php
namespace wechat\lib\cache;

use wechat\lib\Config;

class FileCache implements ICacheMethod
{

    public function cache($key, $timeout=7000, $value=false)
    {
        // TODO: Implement cache() method.
        $filename = Config::cache('path')."$key.json";
        if ($value){
            $fp = fopen($filename, "w") or die("Unable to open file!");//创建/打开文件
            fwrite($fp, "" . $value);//写入accesstoken
            fclose($fp);
            return true;
        }else{
            $str = null;
            if(file_exists($filename)){
                $fp = fopen($filename,"r");
                $str = fread($fp,filesize($filename));//指定读取大小，这里把整个文件内容读取出来
                fclose($fp);
            }
            return $str;
        }

    }
}