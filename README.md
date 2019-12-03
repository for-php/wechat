# 开发中


## 开发详情见 `index.php` 文件内注释

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