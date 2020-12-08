<?php
/**
 * Created by PhpStorm.
 * Function: xxx
 * User: 龚国新
 * Date: 2019/9/23
 * Time: 17:32
 */

namespace App\Strategy\CartStrategy;

class FullReductionStrategy extends ActivityStrategy
{

    public function handle($content):int
    {
        return -10;
    }
}