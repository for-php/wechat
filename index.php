<?php
require_once 'vendor/autoload.php';

use wechat\lib\Wechat;
$wechat = new Wechat();

//$wechat->checkSignature();

$access_token = $wechat->getWebAccessToken();
var_dump($access_token);