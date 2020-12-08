<?php
/**
 * Created by PhpStorm.
 * Function: xxx
 * User: 龚国新
 * Date: 2019/9/23
 * Time: 17:31
 */

namespace App\Strategy;


interface Strategy
{
    public function handle($content): int;
}