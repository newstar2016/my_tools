<?php

namespace App\Http\Controllers\App\Demo;

use App\Http\Controllers\App\BaseController;
use Illuminate\Http\Request;

class AppendOrderController extends BaseController
{
    /**
     * 补单专用
     *
     * @return array
     */
    public function index(Request $request)
    {
        $arr = [3,2,4];
        $t = 6;
        $res = $this->twoSum($arr,$t);
        print_r($res);exit;
//        $all = $request->input();
//        dd($all);
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><o><appid type=\"string\">wx33bdf57dacbb5242</appid><attach class=\"array\"/><bank_type type=\"string\">OTHERS</bank_type><cash_fee type=\"string\">5490</cash_fee><cash_fee_type type=\"string\">CNY</cash_fee_type><coupon_count type=\"string\">1</coupon_count><coupon_fee type=\"string\">5500</coupon_fee><coupon_fee_0 type=\"string\">5500</coupon_fee_0><coupon_id_0 type=\"string\">16327833444</coupon_id_0><coupon_type_0 type=\"string\">NO_CASH</coupon_type_0><fee_type type=\"string\">CNY</fee_type><is_subscribe type=\"string\">N</is_subscribe><mch_id type=\"string\">1530183331</mch_id><nonce_str type=\"string\">vWUmrmW972ihhIRb</nonce_str><openid type=\"string\">oZdh7wUK4S2Uy-3jj8tPBiEnTmls</openid><out_trade_no type=\"string\">416010111437458</out_trade_no><result_code type=\"string\">SUCCESS</result_code><return_code type=\"string\">SUCCESS</return_code><return_msg type=\"string\">OK</return_msg><settlement_total_fee type=\"string\">5490</settlement_total_fee><sign type=\"string\">BD2A1551157A73E18380E5973A7526C8</sign><sub_appid type=\"string\">wx7f6bf1836bd694ac</sub_appid><sub_is_subscribe type=\"string\">N</sub_is_subscribe><sub_mch_id type=\"string\">1556070121</sub_mch_id><sub_openid type=\"string\">oJnCX5GPGfk3da-3FvcLZen9A678</sub_openid><time_end type=\"string\">20200925131909</time_end><total_fee type=\"string\">10990</total_fee><trade_state type=\"string\">REFUND</trade_state><trade_state_desc type=\"string\">订单发生过退款，退款详情请查询退款单</trade_state_desc><trade_type type=\"string\">JSAPI</trade_type><transaction_id type=\"string\">4200000683202009251358368557</transaction_id></o>";
        $aa = [$xml];
        return success($aa);
    }

    public function twoSum($nums, $target) {
        // $keys=[];
       
        // foreach($nums as $key=>$num){
        //     $v=$target-$num;
        //     if (array_key_exists($v, $keys)) {
        //     	return [$keys[$v], $key];
        //     }
        //     $keys[$num] = $key;
        // }
        $hello = 1534236469;
        $a = 0;
        if($hello>0){
			$a = abs(strrev($hello));
        }
        if($hello<0){
			$a = -(strrev(abs($hello)));
        }
        if ($a<-2147483648 || $a>2147483647){
			$a=0;
        }
        return $a;
    }
}
