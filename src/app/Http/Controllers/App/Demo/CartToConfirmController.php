<?php
/**
 * Created by PhpStorm.
 * Function: xxx
 * User: 龚国新
 * Date: 2019/9/23
 * Time: 18:02
 */

namespace App\Http\Controllers\App\Demo;


use App\Strategy\CartStrategy\ActivityStrategy;
use App\Strategy\CartStrategy\FullReductionStrategy;
use App\Strategy\CartStrategy\SingleCouponStrategy;
use App\Strategy\StrategyShoppingCart;

class CartToConfirmController
{
    public function index(){
        $stateMange = new StrategyShoppingCart();
        $stateMange->addGoods([['number'=>1,'id'=>1]]);
        $stateMange->addActivity(new ActivityStrategy());
        $stateMange->addActivity(new FullReductionStrategy());
        $stateMange->addActivity(new SingleCouponStrategy());
        echo $stateMange->totalCost();
    }
}