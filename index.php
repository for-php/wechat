<?php
require_once 'vendor/autoload.php';

/*
 * 注意事项
 * 请先将必要文件夹cache权限修改为777
 * 请先将配置文件./config.php按照自己的实际情况调整(此开发包使用本人申请的微信公众平台测试号的appid)
 * 项目还在开发阶段，如遇问题请联系我
 **/

//导入Wechat类，完成微信开发
use wechat\lib\Wechat;

//实例化对象
$wechat = new Wechat();

//接口配置服务器验证方法。一般只需用到一次
$wechat->checkSignature();

//获取微信全局access_token，公众号给类接口调用时所用的access_token
$global_access_token = $wechat->getGlobalAccessToken();

//获取微信网页授权access_token。
$access_token = $wechat->getWebAccessToken();
