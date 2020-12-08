<?php
/**
 * Created by PhpStorm.
 * Function: xxx
 * User: 龚国新
 * Date: 2019/9/24
 * Time: 12:07
 */

namespace App\Builders\OrderBuilder\BuilderActions;


class NormalOrderBuilder extends CommonOrderBuilder
{
    public function __construct()
    {
        parent::__construct();
    }

    //构建订单信息
    public function buildOrderInfo(...$arguments)
    {
        $this->order['order_info'] = [1];
    }

    //构建订单商品信息
    public function buildOrderGoods(...$arguments)
    {
        $this->order['order_goods'] = [1];
    }

    //构建订单用户信息
    public function buildUser(...$arguments)
    {
        $this->order['order_user'] = [1];
    }

    //构建订单物流信息
    public function buildLogistic(...$arguments)
    {
        $this->order['order_logistic'] = [1];
    }

    //构建订单活动信息
    public function buildActivity(...$arguments)
    {
        $this->order['order_activity'] = [1];
    }

    //构建订单支付信息
    public function buildPayInfo(...$arguments)
    {
        $this->order['order_pay_info'] = [1];
    }

    //构建订单其他信息
    public function buildOther(...$arguments)
    {
        $this->order['order_other'] = [1];
    }

    public function buildCouponInfo(...$arguments)
    {
        // TODO: Implement buildCouponInfo() method.
    }
}