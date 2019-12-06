<?php


namespace wechat\lib\core;


trait RequestMsg
{
    private function Msg():array
    {
        $xml_data = isset($GLOBALS["HTTP_RAW_POST_DATA"])?$GLOBALS["HTTP_RAW_POST_DATA"]:
            file_get_contents("php://input");
        libxml_disable_entity_loader(true);
        $xml_obj = simplexml_load_string($xml_data,'SimpleXMLElement',LIBXML_NOCDATA);
        $xml_arr = json_decode(json_encode($xml_obj),true);
        return $xml_arr;
    }
}