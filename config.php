<?php
    return [

        'wechat' => [
            'appid'         => 'wxeb77d07b6e6c812e',
            'appsecret'     => '32b7eef0942b35e0ca69a7c09ffe5740',
            'token'         => 'taurus',
        ],

        'cache' => [
            'type'          => 'file',
            'path'          => __DIR__.'/cache/'
        ],

        'redis' => [
            'host'          => '127.0.0.1',
            'port'          => '6379',
            'auth'          => '',
            'dbIndex'      => 0,
        ]

    ];