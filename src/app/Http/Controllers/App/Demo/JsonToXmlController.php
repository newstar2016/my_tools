<?php

namespace App\Http\Controllers\App\Demo;

use App\Http\Controllers\App\BaseController;
use App\Traits\CommonTools;
use Illuminate\Http\Request;

class JsonToXmlController extends BaseController
{
    use CommonTools;

    /**
     * json转xml
     *
     * @param Request $request
     *
     * @return array
     */
    public function index(Request $request)
    {
        $request_param = $request->all();

        // 创建新的simpleXML实例，注入内存，确定根节点
        $xml = new \SimpleXMLElement('<o/>');

        // 回调函数
        $this->array_to_XML($xml, $request_param);
        $json_xml = $xml->asXML();
        $newstr   = str_replace(PHP_EOL, '', $json_xml);
        //$aa       = [$newstr];
//        return success($aa);
        return $newstr;
    }
}
