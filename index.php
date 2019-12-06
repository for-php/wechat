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
# $wechat->checkSignature();

//获取微信全局access_token，公众号给类接口调用时所用的access_token
# $global_access_token = $wechat->getGlobalAccessToken();

//微信网页授权获取用户信息
# $userInfo = $wechat->getUserInfo();

//单独获取用户openid，此获取不跳转用户授权界面，静默授权
# $openid = $wechat->getOpenId();

//设置公众号菜单,方法形参$data强制数组，返回bool型。菜单设置方式请遵从微信自定义菜单规则
/*
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
*/
# $setMenu = $wechat->setMenu($data);

//获取当前自定义菜单设置
# $getMenu = $wechat->getMenuInfo();

//删除自定义菜单
# $delMenu = $wechat->delMenu();

//设置个性化菜单，$data菜单设置样式，$matchrule个性化菜单匹配规则，返回bool型，详情微信手册
/*
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
*/
# $setMenuConditional = $wechat->setMenuConditional($data,$matchrule);

//获取个性化菜单设置
# $getMenuConditionalInfo = $wechat->getMenuConditionalInfo();

//接收用户发来的消息，返回数组类型数据,数据内容间微信开发文档
# $msg = $wechat->getMsg();

//被动回复文本消息,参数1:接收方openid  参数2:开发者openid  参数3:发送内容,以下使用接收来的数据
# $sendText = $wechat->sendText($msg['FromUserName'],$msg['ToUserName'],'您发送的内容是:'.$msg['Content']);

//被动回复图片消息,参数1:接收方openid  参数2:开发者openid  参数3:上传的图片素材id
# $sendImg = $wechat->sendImg($toUserName,$fromUserName,$mediaId);

//被动回复语音消息,参数1:接收方openid  参数2:开发者openid  参数3:上传的语音素材id
# $sendVoice = $wechat->sendVoice($toUserName,$fromUserName,$mediaId);

//被动回复视频消息,参数1:接收方openid  参数2:开发者openid  参数3:数组(格式见下方参考)
/*

    $content = [
        'title'     => '', //标题
        'desc'      => '', //描述
        'mediaId'   => '', //上传的素材ID
    ];
*/
# $sendVideo = $wechat->sendVoice($toUserName,$fromUserName,$content);

//被动回复音乐消息,参数1:接收方openid  参数2:开发者openid  参数3:数组(格式见下方参考)
/*

    $content = [
        'title'         => '', //标题
        'desc'          => '', //描述
        'url'           => '', //音乐链接
        'Hurl'          => '', //高品质音乐链接,WIFI状态下默认播放这个
        'thumbMediaId'  => '', //消息缩略图,上传的图片素材ID
    ];
*/
# $sendMusic = $wechat->sendVoice($toUserName,$fromUserName,$content);

//被动回复图文消息,参数1:接收方openid  参数2:开发者openid  参数3:数组(格式见下方参考)
# $sendNews = $wechat->sendNews($toUserName,$fromUserName,$articles);