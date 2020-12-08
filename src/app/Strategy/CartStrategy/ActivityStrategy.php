<?php
/**
 * Created by PhpStorm.
 * Function: 用于计算公共部分
 * User: 龚国新
 * Date: 2019/9/23
 * Time: 17:32
 */

namespace App\Strategy\CartStrategy;


use App\Strategy\Strategy;

class ActivityStrategy implements Strategy
{

    public function handle($content):int
    {
        return 100;
    }
}