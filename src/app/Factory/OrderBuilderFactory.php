<?php
/**
 * Created by PhpStorm.
 * Function: xxx
 * User: 龚国新
 * Date: 2019/10/11
 * Time: 11:50
 */

namespace App\Factory;


class OrderBuilderFactory
{
    //构建者控制器存储的路径
    private static $path ='\App\Builders\OrderBuilder\BuilderActions';

    //允许创建实例的类
    private static $orderBuilderConfig = [
        1=> 'NormalOrderBuilder'
    ];

    /**
     * 创建对象实例
     *
     * @param       $order_type
     * @param mixed ...$arguments
     *
     * @return mixed
     */
    public static function make($order_type, ...$arguments)
    {
        if(!isset(self::$orderBuilderConfig[$order_type])){
            echo "订单类型为:".$order_type.',不在允许范围内'; exit;
        }
        $name = self::$orderBuilderConfig[$order_type];
        $application = self::$path.'\\'.$name;

        return new $application($arguments);
    }

    /**
     * Dynamically pass methods to the application.
     *
     * @param string $order_type
     * @param array  $arguments
     *
     * @return mixed
     */
    public static function __callStatic($order_type, $arguments)
    {
        return self::make($order_type, ...$arguments);
    }
}