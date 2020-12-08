<?php

$prefix = "\App\Assemblies\OrderBuilder\\";

return [
    'desc' => [
        'setOrderNo'      => '设置订单号',
        'setRequestParam' => '设置参数',
        'CommonCheck'     => '公共参数检查',
        'buildOrderInfo'  => '构建订单信息',
        'buildOrderGoods' => '构建订单商品信息',
        'buildUser'       => '构建订单用户信息',
        'buildLogistic'   => '构建订单物流信息',
        'buildActivity'   => '构建订单活动信息',
        'buildCouponInfo' => '构建订单优惠券信息',
        'buildPayInfo'    => '构建订单支付信息',
        'buildOther'      => '构建订单其他信息',
        'getOrderObject'  => '返回最后的订单对象',
    ],
    /*
    |--------------------------------------------------------------------------
    | v1下单接口版本配置
    |--------------------------------------------------------------------------
    | 为空时默认直接直接下单接口的方法
    |
    | 默认所有类型的下单接口都使用同样的组件,如有不同接口的组件有不同需要单独定义
    |
    */
    'v1'   => [
        'default' => [
            'setOrderNo'      => $prefix . 'setOrderNo',
            'setRequestParam' => $prefix . 'setRequestParam',
            'CommonCheck'     => $prefix . '',
            'buildOrderInfo'  => $prefix . '',
            'buildOrderGoods' => $prefix . '',
            'buildUser'       => $prefix . '',
            'buildLogistic'   => $prefix . '',
            'buildActivity'   => $prefix . '',
            'buildCouponInfo' => $prefix . '',
            'buildPayInfo'    => $prefix . '',
            'buildOther'      => $prefix . '',
            'getOrderObject'  => $prefix . '',
        ],

        /**
         * 如普通下单接口有特殊配置,单独定义组件即可
         * key 不同类型的类名，如 NormalOrderBuilder
         * 子key 组件的英文名称，如 setOrderNo
         * 组件类所在路径命名空间，如 $prefix . 'NormalSetOrderNo'
         */
        //        'NormalOrderBuilder' => [
        //            'setOrderNo'      => $prefix . 'NormalSetOrderNo',
        //        ]
    ],
];
