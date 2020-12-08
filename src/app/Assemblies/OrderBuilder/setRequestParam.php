<?php
/**
 * Created by PhpStorm.
 * Function: xxx
 * User: 龚国新
 * Date: 2019/10/12
 * Time: 15:00
 */

namespace App\Assemblies\OrderBuilder;


use App\Assemblies\assemblyInterface;

class setRequestParam implements assemblyInterface
{

    public function handle(...$arguments)
    {
        return $arguments;
    }
}