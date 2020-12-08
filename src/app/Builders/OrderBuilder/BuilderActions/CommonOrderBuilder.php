<?php
/**
 * Created by PhpStorm.
 * Function: 所有类型下单类的父类
 * User: 龚国新
 * Date: 2019/9/24
 * Time: 12:08
 */

namespace App\Builders\OrderBuilder\BuilderActions;


use App\Builders\OrderBuilder\Order;
use App\Builders\OrderBuilder\OrderBuilder;
use App\Filters\Order\UserLoginCheck;
use App\Filters\Order\ValidateRequestParam;
use Illuminate\Pipeline\Pipeline;

class CommonOrderBuilder implements OrderBuilder
{
    public $order_no;               //订单号
    public $request_param;          //请求参数
    public $order = [
        'order_info'     => [],     //订单基本信息
        'order_goods'    => [],     //订单商品信息
        'order_user'     => [],     //订单用户信息
        'order_logistic' => [],     //订单物流信息
        'order_activity' => [],     //订单活动信息
        'order_coupon_info' => [],  //订单优惠券信息
        'order_pay_info' => [],     //订单支付信息
        'order_other'    => [],     //订单其他信息
    ];

    public function __construct()
    {

    }

    /**
     * 设置订单号
     *
     * @param mixed ...$arguments
     */
    public function setOrderNo(...$arguments)
    {
        $this->order_no = $arguments[0]->handle();
    }

    //设置初始的请求参数
    public function setRequestParam(...$arguments)
    {
        $this->request_param = $arguments[1]->handle($arguments[0]);
    }

    //获取最后的订单对象
    public function getOrderObject(): Order
    {
        $order              = new Order();
        $order->order  = $this->order;
        return $order;
    }

    //公共校验
    public function CommonCheck(...$arguments)
    {
        $pipes = [
            UserLoginCheck::class,    //用户是否登录检查
            ValidateRequestParam::class,    //公共参数检查
        ];
        $result = app(Pipeline::class)
            ->send($this->request_param)
            ->through($pipes)
            ->then(function ($content) {
                return $content;
            });
        return $result;
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
        $this->order['order_coupon_info'] = [1];
    }
}