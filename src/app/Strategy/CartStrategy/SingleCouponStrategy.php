<?php
/**
 * Created by PhpStorm.
 * Function: 单品券计算
 * User: 龚国新
 * Date: 2019/9/23
 * Time: 17:32
 */

namespace App\Strategy\CartStrategy;

class SingleCouponStrategy extends ActivityStrategy
{

    public function handle($content):int
    {
        return 5;
    }
}