<?php
/**
 * Created by PhpStorm.
 * Function: xxx
 * User: 龚国新
 * Date: 2019/9/24
 * Time: 16:51
 */

namespace App\Http\Controllers\App\Demo;


use App\Builders\OrderBuilder\OrderDirector;
use App\Factory\OrderBuilderFactory;

class TestOrderBuilderController
{
    public function index(){
        $request_param= [];
        $orderBuilder = OrderBuilderFactory::make(1,[]);
        $orderDirector = new OrderDirector($orderBuilder,$request_param);
        $order = $orderDirector->buildOrder();
    }
}