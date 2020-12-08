<?php
/**
 * Created by PhpStorm.
 * Function: xxx
 * User: 龚国新
 * Date: 2019/10/10
 * Time: 14:17
 */

namespace App\Http\Controllers\App\Demo;

use App\Http\Controllers\App\BaseController;
use App\Service\RedLock;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Cache\RedisStore;
use Lock\Lock;
//use App\Services\RedLock;

class TestController extends BaseController
{
    public function index(){
        $resource = "{\"nonce\": \"Os6mnta84BWe\", \"algorithm\": \"AEAD_AES_256_GCM\", \"ciphertext\": \"8DFO95cp/z8P69e1Ak+6DPFUzucklNXs5Oea3ICc5C+HH7YVDtlj1GF+X6Mv2RIPXP20SFW2+kHm664MewVy+xXQIFZ9LAwwuFLZY+iCztC99nmbpjkQQwkTk/JU00+kffXBr/kgQBaTcsU4SRpt+URdV76mTJlFlJcPoWdyVQTgk1ez861YoCEQhizoAnY4ujnPYo4eaZAsxZ6p0iptzZ9NCGxNDE4J4HNwvyydvsMOFDsp8zPrwFkatop+8zqD4s40r3+HP6759C8yMjBCUsRiw3VtoZltPprc3yHlXhQmTQs4+Z+IaJjLMMQ9rW8EKiydLUXZ2aG2nv6NDEnDIqkZUzAcI/LpLsxU2AXmlHXwYjL0hxSSvtivLx0FxjVRnsl/2tpRtNVG0DivCQ/wz6mKj2BoqUaH19bLsn3Eyw==\", \"original_type\": \"coupon\", \"associated_data\": \"coupon\"}";
        $aa = json_decode($resource,true);
        dd($aa);
    }
}