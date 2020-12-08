<?php
/**
 * Created by PhpStorm.
 * Function: xxx
 * User: 龚国新
 * Date: 2019/9/24
 * Time: 12:01
 */

namespace App\Builders\OrderBuilder;


use App\Builders\OrderBuilder\BuilderActions\CommonOrderBuilder;
use App\Traits\AssemblyTools;
use Illuminate\Support\Facades\Log;

class OrderDirector
{
    use AssemblyTools;
    public $builder;
    public $request_param;

    public function __construct(CommonOrderBuilder $builder, $request_param)
    {
        $this->builder       = $builder;
        $this->request_param = $request_param;
    }

    public function buildOrder()
    {
        try {
            return $this->doOrderAssembly($this->builder, config('order_builder'), !empty($this->request_param['version']) ? $this->request_param['version'] : 'v1',$this->request_param);
        } catch (\Exception $e) {
            //待使用新的抛错封装
            Log::error("订单号：" . $this->builder->order_no . ",下单异常信息：", [
                'msg'  => $e->getMessage(),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            throw error($e->getCode(), $e->getMessage());
        }

    }
}