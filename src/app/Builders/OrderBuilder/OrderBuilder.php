<?php
/**
 * Created by PhpStorm.
 * Function: 下单接口规范类
 * User: 龚国新
 * Date: 2019/9/24
 * Time: 11:19
 */

namespace App\Builders\OrderBuilder;


interface OrderBuilder
{
    //设置订单号
    public function setOrderNo(...$arguments);

    //设置初始的请求参数
    public function setRequestParam(...$arguments);

    //获取最后的订单对象
    public function getOrderObject():Order;

    //构建订单信息
    public function buildOrderInfo(...$arguments);

    //构建订单商品信息
    public function buildOrderGoods(...$arguments);

    //构建订单用户信息
    public function buildUser(...$arguments);

    //构建订单物流信息
    public function buildLogistic(...$arguments);

    //构建订单活动信息
    public function buildActivity(...$arguments);

    //构建订单优惠券信息
    public function buildCouponInfo(...$arguments);

    //构建订单支付信息
    public function buildPayInfo(...$arguments);

    //构建订单其他信息
    public function buildOther(...$arguments);
}