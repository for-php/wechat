<?php
    return [

        'wechat' => [
            'appid'         => '',
            'appsecret'     => '',
            'token'         => '',
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