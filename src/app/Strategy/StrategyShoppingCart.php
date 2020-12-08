<?php
/**
 * Created by PhpStorm.
 * Function: xxx
 * User: 龚国新
 * Date: 2019/9/23
 * Time: 17:00
 */

namespace App\Strategy;

use App\Strategy\CartStrategy\ActivityStrategy;

class StrategyShoppingCart
{
    /**
     * 商品列表
     */
    private $goods_list = [];

    /**
     * 活动列表
     */
    private $activity_list = [];

    /**
     * 购物车总价
     */
    private $total_price = 0;

    /**
     * 添加商品
     *
     * @param $goods_list
     *
     * @return string
     */
    public function addGoods($goods_list)
    {
        if (!empty($goods_info)) {
            foreach ($goods_list as $goods) {
                array_push($this->goods_list, $goods);
            }
        } else {
            return "购物车列表不能为空";
        }

    }

    /**
     * 添加活动
     *
     * @param ActivityStrategy $activityStrategy
     */
    public function addActivity(ActivityStrategy $activityStrategy)
    {
        array_push($this->activity_list, $activityStrategy);
    }

    /**
     * 计算总价
     */
    public function totalCost()
    {
        if (!empty($this->activity_list)) {
            foreach ($this->activity_list as $activityStrategy) {
                $this->total_price += $activityStrategy->handle($this->goods_list);
            }
        }

        if ($this->total_price < 0) {
            $this->total_price = 0;
        }

        return $this->total_price;
    }
}