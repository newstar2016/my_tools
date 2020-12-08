<?php

/**
 * 容器类的使用方法
 * 1.有两个属性 两个方法
 * 2.
 */
class Container
{
    //$binds用于保存我们 不同绑定类传来的匿名函数(function(){} 并没有执行)
     //如下面：保存为这样$binds['flight']=function(){};
     public $binds;
     public $instances;

     /**
      * @Author   shyn
      * @DateTime 2017-12-20
      * @param    [type]     $abstract  ['初始对象实例名 用于保存在']
      * @param    [type]     $concreate [匿名函数]
      * @return   [type]                [description]
      */
     public function bind($abstract, $concreate)
     {
         if($concreate instanceof Closure){
             $this->binds[$abstract] = $concreate;
         }else{
             $this->instances[$abstract] = $concreate;
         }

     }

     //执行绑定到$binds 中的function(){}
     public function make($abstract, $parameters = [])
     {
         if(isset($this->instances[$abstract])){
             return $this->instances[$abstract];
         }

         array_unshift($parameters, $this);//将this 添加到数组 $parameters 用于call_user_func_array() 这点看@@清楚
         // 将数组 $parameters 作为参数传递给回调函数$this->binds[$abstract]  $abstract 是类名
         return call_user_func_array($this->binds[$abstract], $parameters);
     }
}