<?php
/**
 * Created by PhpStorm.
 * Function: xxx
 * User: 龚国新
 * Date: 2019/9/19
 * Time: 21:34
 */

namespace App\Http\Controllers\App\Demo;


use App\StateMachine\OrderMachine\OrderMachineInitialize;

class OrderController
{
    private $orderStateMachine = '';

    public function __construct(OrderMachineInitialize $initialize)
    {
        $this->orderStateMachine = $initialize->getMachineObject();
    }

    public function index()
    {
//        $this->orderStateMachine->apply('propose');
//        $this->orderStateMachine->apply('reject');
//        $this->orderStateMachine->apply('propose');
        $this->orderStateMachine->apply('accept');

    }
}