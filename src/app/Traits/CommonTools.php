<?php

namespace App\Traits;

/**
 * 公共的操作方法工具类
 *
 * @package App\Traits
 */
trait CommonTools
{
    /**
     * 数组转XML
     *
     * @param $obj
     * @param $array
     */

    public function array_to_XML($obj, $array)
    {
        foreach ($array as $k => $v) {
            if (is_numeric($k))
                $k = 'item' . $k;
            if (is_array($v)) {
                $node = $obj->addChild($k);
                $this->array_to_XML($node, $v);
            } else {
                $obj->addChild($k, trim($v));
            }
        }
    }

    /**
     * XML转数组
     *
     * @param $xml string XML
     * @return bool|array
     */
    public function xmlToArray($xml)
    {
        $parser = xml_parser_create();
        if (!xml_parse($parser, $xml, true)) {
            xml_parser_free($parser);

            return false;
        }
        libxml_disable_entity_loader(true);
        $xmlString = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        $arr = json_decode(json_encode($xmlString), true);

        return $arr;
    }
}
