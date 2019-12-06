<?php


namespace wechat\lib\core;


trait RequestMsg
{
    private function Msg():array
    {
        $xml_data = isset($GLOBALS["HTTP_RAW_POST_DATA"])?$GLOBALS["HTTP_RAW_POST_DATA"]:'<xml></xml>';
        $xml_obj = simplexml_load_string($xml_data);
        $xml_arr = json_decode(json_encode($xml_obj),true);
        return $xml_arr;
    }
}