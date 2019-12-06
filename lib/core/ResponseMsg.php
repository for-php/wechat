<?php


namespace wechat\lib\core;


trait ResponseMsg
{
    private function text(string $toUserName,string $fromUserName,string $content):void
    {
        $data = "
            <xml>
              <ToUserName><![CDATA[$toUserName]]></ToUserName>
              <FromUserName><![CDATA[$fromUserName]]></FromUserName>
              <CreateTime>".time()."</CreateTime>
              <MsgType><![CDATA[text]]></MsgType>
              <Content><![CDATA[$content]]></Content>
            </xml>
        ";
        echo $data;
    }

    private function img(string $toUserName,string $fromUserName,string $mediaId):void
    {
        $data = "
            <xml>
              <ToUserName><![CDATA[$toUserName]]></ToUserName>
              <FromUserName><![CDATA[$fromUserName]]></FromUserName>
              <CreateTime>".time()."</CreateTime>
              <MsgType><![CDATA[image]]></MsgType>
              <Image>
                <MediaId><![CDATA[$mediaId]]></MediaId>
              </Image>
            </xml>
        ";
        echo $data;
    }

    private function voice(string $toUserName,string $fromUserName,string $mediaId):void
    {
        $data = "
            <xml>
              <ToUserName><![CDATA[$toUserName]]></ToUserName>
              <FromUserName><![CDATA[$fromUserName]]></FromUserName>
              <CreateTime>".time()."</CreateTime>
              <MsgType><![CDATA[voice]]></MsgType>
              <Voice>
                <MediaId><![CDATA[$mediaId]]></MediaId>
              </Voice>
            </xml>
        ";
        echo $data;
    }

    private function video(string $toUserName,string $fromUserName,array $content):void
    {
        $mediaId = $content['mediaId'];
        $title = $content['title'];
        $desc = $content['desc'];

        $data = "
            <xml>
              <ToUserName><![CDATA[$toUserName]]></ToUserName>
              <FromUserName><![CDATA[$fromUserName]]></FromUserName>
              <CreateTime>".time()."</CreateTime>
              <MsgType><![CDATA[video]]></MsgType>
              <Video>
                <MediaId><![CDATA[$mediaId]]></MediaId>
                <Title><![CDATA[$title]]></Title>
                <Description><![CDATA[$desc]]></Description>
              </Video>
            </xml>
        ";
        echo $data;
    }

    private function music(string $toUserName,string $fromUserName,array $content):void
    {
        $title = $content['title'];
        $desc = $content['desc'];
        $url = $content['url'];
        $Hurl = $content['Hurl'];
        $mediaId = $content['thumbMediaId'];

        $data = "
            <xml>
              <ToUserName><![CDATA[$toUserName]]></ToUserName>
              <FromUserName><![CDATA[$fromUserName]]></FromUserName>
              <CreateTime>".time()."</CreateTime>
              <MsgType><![CDATA[music]]></MsgType>
              <Music>
                <Title><![CDATA[$title]]></Title>
                <Description><![CDATA[$desc]]></Description>
                <MusicUrl><![CDATA[$url]]></MusicUrl>
                <HQMusicUrl><![CDATA[$Hurl]]></HQMusicUrl>
                <ThumbMediaId><![CDATA[$mediaId]]></ThumbMediaId>
              </Music>
            </xml>
        ";
        echo $data;
    }

    private function news(string $toUserName,string $fromUserName,array $articles):void
    {
        $content = '';
        foreach ($articles as $k=>$v){
            $content .= "
                <item>
                  <Title><![CDATA[".$v['title']."]]></Title>
                  <Description><![CDATA[".$v['desc']."]]></Description>
                  <PicUrl><![CDATA[".$v['picurl']."]]></PicUrl>
                  <Url><![CDATA[".$v['url']."]]></Url>
                </item>
            ";
        }
        $data = "
            <xml>
              <ToUserName><![CDATA[$toUserName]]></ToUserName>
              <FromUserName><![CDATA[$fromUserName]]></FromUserName>
              <CreateTime>".time()."</CreateTime>
              <MsgType><![CDATA[news]]></MsgType>
              <ArticleCount>".count($articles)."</ArticleCount>
              <Articles>
                $content
              </Articles>
            </xml>
        ";
        echo $data;
    }
}