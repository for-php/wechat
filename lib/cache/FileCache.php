<?php
namespace wechat\lib\cache;

use wechat\lib\Config;

/**
 * Class FileCache
 * @package wechat\lib\cache
 * @auth: Taurus12C
 * @email: 1402410174@qq.com
 * @date: 2019-12-04 10:30:28
 */
class FileCache implements ICacheMethod
{

    /**
     * @desc
     * @param $key
     * @param bool $value
     * @param $timeout
     * @return bool|string|null
     */
    public function cache($key, $value=false, $timeout)
    {
        // TODO: Implement cache() method.
        $filename = Config::cache('path')."$key.json";
        if ($value){
            $arr = json_decode($value,true);
            $arr['timeout'] = time()+$timeout;
            $fp = fopen($filename, "w") or die("Unable to open file!");//创建/打开文件
            fwrite($fp, "" . json_encode($arr));//写入accesstoken
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