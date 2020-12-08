<?php
/**
 * Created by PhpStorm.
 * User: 龚国新
 * Date: 2020-11-20
 * Time: 10:06
 */

namespace App\Console\Commands;

use App\Common\Constant;
use App\Models\MainMat;
use App\Models\StockMat;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TestAes extends Command
{
    /**
     * @var string
     */
    protected $signature = 'test_aes';

    /**
     * @var string
     */
    protected $description = '测试aes解密';

    protected $key = "TZg48UDNGGfhbHiEcvVqNPRtTOSGzKcT";

    public function handle()
    {
        $mch_id = "1536008831";
        $mch_key = "91f2eee445919b933859f9ee76a6b3de";
        $data1 = [
            ["stock_id" => "1284420000000065", "out_request_no" => "277626686013441"]
        ];

        //dd($this->getSendSign($data1, $mch_id, $mch_key));

        $data2 = [
            ["stock_id" => "1284420000000065", "coupon_code" => "277626686013441"]
        ];

//        dd($this->getOpenSign($data2, $mch_id, $mch_key));

        $resource = "{\"nonce\": \"Jh6IFYe131Vi\", \"algorithm\": \"AEAD_AES_256_GCM\", \"ciphertext\": \"jR2rac3pBHtTmAbDxHrvq/snhgJ3I1ITVVVqpDjDubM1joAMM+sWlc/qO/YB1qMsKOdNkLpHg3VHJcE3JVuPjEhzP3l/gJKTAa5FETRxVFhpYRIkcgeVHNSVz6YJXwpn1SOQwT7gCNFrlnjIIrAt2mKgl53dLev2vXQ57mXlHaXe2CUDOxfBHSKtYn9QRDtQMPqxONYSwR0H1uo8gjNO6IAQNWc1YRD1pBomLL9C1SlFnlw6gQCgw2+HuAFIsmtWfmF+FfOvgeTuJontTkFHqjElzpRfiUZgbLHwMo8OiH2ISYkZilMq/H8FBbF7fGKUrlBHAw8hU77aDggA/pWvV1owx6w+bNmlTbh/IJxBRfeHPEGsudGdNIM74QXZwVgcZFQWpXhhD4Esa2dYLVTaqPfdXVFKUS2f9WschXud7Is=\", \"original_type\": \"coupon\", \"associated_data\": \"coupon\"}";
        $D=json_decode($resource,true);
        if($D=self::AesDeCode($D["ciphertext"],$D["nonce"],$D["associated_data"])){
            dd($D);
        }else{
            dd("解密错误");
        }
    }

    /**
     * @notes SHA256签名AEAD_AES_256_GCM解密
     * @param $ciphertext
     * @param $nonce
     * @param string $associated_data
     * @return mixed|array
     */
    public function AesDeCode($ciphertext, $nonce, $associated_data = 'certificate')
    {
        $check_sodium_mod = extension_loaded('sodium');
        if ($check_sodium_mod === false) {
            echo '没有安装sodium模块';
            die;
        }
        $check_aes256gcm = sodium_crypto_aead_aes256gcm_is_available();
        if ($check_aes256gcm === false) {
            echo '当前不支持aes256gcm';
            die;
        }
        if ($pem = sodium_crypto_aead_aes256gcm_decrypt(base64_decode($ciphertext), $associated_data, $nonce, $this->key)) {
            return json_decode($pem, 1);
        } else {
            return $pem;
        }
    }

    /**
     * 获取hmacSha256签名
     *
     * @param $dataArr
     * @param $mch_key
     * @return string
     */
    public function getSignHmacSha256($data, $mch_key)
    {
        ksort($data);
        $data = array_filter($data, function ($v, $k) {
            if ($k == "sign" && $v == '' && is_array($v)) {
                return false;
            }
            return true;
        }, ARRAY_FILTER_USE_BOTH);
        $str = http_build_query($data) . "&key=" . $mch_key;
        $str = urldecode($str);//处理中文乱码
        return strtoupper(hash_hmac("sha256", $str, $mch_key));
    }

    //获取发券的签名
    public function getSendSign($dataArr, $mch_id, $mch_key)
    {
        $data = [];
        $i = 0;
        $data['send_coupon_merchant'] = $mch_id;
        foreach ($dataArr as $item) {
            $data['stock_id' . $i] = $item['stock_id'];
            $data['out_request_no' . $i] = $item['out_request_no'];
            $i++;
        }
        $sign = $this->getSignHmacSha256($data, $mch_key);
        return $sign;
    }

    //获取打开券详情的签名
    public function getOpenSign($dataArr, $mch_id, $mch_key)
    {
        $data = [];
        foreach ($dataArr as $item) {
            $tmp = [];
            $sign = [];
            $sign['stock_id'] = $item['stock_id'];
            $sign['coupon_code'] = $item['coupon_code'];
            $sign['mch_id'] = $mch_id;

            $tmp['card_id'] = $item['stock_id'];
            $tmp['code'] = $item['coupon_code'];
            $signStr = $this->getSignHmacSha256($sign, $mch_key);
            $tmp['open_params'] = "mch_id=" . $mch_id . "&sign=" . $signStr;
            array_push($data, $tmp);
        }
        return $data;
    }
}
