<?php


namespace wechat\lib\cache;


class FileCache implements ICacheMethod
{

    public function cache($key, $timeout=7000, $value=false)
    {
        // TODO: Implement cache() method.
        $config = $config = require '../../config.php';
        if ($value){
            $filename = $config['cache']['path']."$key.php";//文件路径
            $fp = fopen($filename, "w") or die("Unable to open file!");//创建/打开文件
            fwrite($fp, "" . $value);//写入accesstoken
            fclose($fp);
            return true;
        }else{
            $filename = $config['cache']['path']."$key.php";
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