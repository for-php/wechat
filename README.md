# 开发中


## 使用详情见 `index.php` 文件内注释

> 开发中使用本人申请的微信测试号，如需自己体验可前往  [微信测试号申请地址](https://mp.weixin.qq.com/debug/cgi-bin/sandbox?t=sandbox/login)  申请

>项目还在开发阶段，如遇问题请联系我.


## 目录结构

~~~
|—— cache                       文件缓存驱动存储空间
|—— lib                         包主文件夹
|   |—— cache                   缓存驱动
|   |—— core                    核心文件
|   |—— http                    接口请求驱动
|   |—— Cache.php               缓存类文件
|   |—— Config.php              配置获取类
|   |—— Http.php                接口请求类
|   |—— Wechat.php              主类
|—— vendor                      composer依赖
|—— config.php                  配置文件
|—— index.php                   方法示例描述
~~~

>安装方法 `composer require taurus12c/wechat 1.0.1`

## 使用方法
导入Wechat类，完成微信开发

`use wechat\lib\Wechat;`

---

实例化对象

`$wechat = new Wechat();`

---

接口配置服务器验证方法。一般只需用到一次

`$wechat->checkSignature();`

---

获取微信全局access_token，公众号给类接口调用时所用的access_token

`$global_access_token = $wechat->getGlobalAccessToken();`

---

微信网页授权获取用户信息

`$userInfo = $wechat->getUserInfo();`

---

单独获取用户openid，此获取不跳转用户授权界面，静默授权

`$openid = $wechat->getOpenId();`

---

//设置公众号菜单,方法形参$data强制数组，返回bool型。菜单设置方式请遵从微信自定义菜单规则

```
$data = [
     "button"=>[
         [
             "name"         =>"按钮一",
             "type"         =>"view",
             "url"          =>"http://www.baidu.com",
         ],
         [
             "name"         =>"按钮二",
             "sub_button"   =>[
                 [
                     "name"         =>"二级菜单1",
                     "type"         =>"view",
                     "url"          =>"http://www.baidu.com"
                 ]
             ]
         ]
     ]
];

$setMenu = $wechat->setMenu($data);
```

---

获取当前自定义菜单设置

`$getMenu = $wechat->getMenuInfo();`

---

删除自定义菜单

`$delMenu = $wechat->delMenu();`

---

设置个性化菜单，$data菜单设置样式，$matchrule个性化菜单匹配规则，返回bool型，详情微信手册

```
$data = [
    "button"=>[
        [
            "name"         =>"按钮一",
            "type"         =>"view",
            "url"          =>"http://www.baidu.com",
        ],
        [
            "name"         =>"按钮二",
            "sub_button"   =>[
                [
                    "name"         =>"二级菜单1",
                    "type"         =>"view",
                    "url"          =>"http://www.baidu.com"
                ]
            ]
        ]
    ],
];
$matchrule = [
    "matchrule"=>[
        "tag_id"=> "2",
        "sex"=> "1",
        "country"=> "中国",
        "province"=> "广东",
        "city"=> "广州",
        "client_platform_type"=> "2",
        "language"=> "zh_CN"
    ]
];

$setMenuConditional = $wechat->setMenuConditional($data,$matchrule);
```

---
获取个性化菜单设置

`$getMenuConditionalInfo = $wechat->getMenuConditionalInfo();`

## 未完待续