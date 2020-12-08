<?php
/**
 * Created by PhpStorm.
 * Function: xxx
 * User: 龚国新
 * Date: 2019/9/19
 * Time: 21:34
 */

namespace App\StateMachine\OrderMachine;

use Finite\StatefulInterface;
class OrderMachine implements StatefulInterface
{
    private $state;
    /**
     * Gets the object state.
     *
     * @return string
     */
    public function getFiniteState()
    {
        return $this->state;
    }

    /**
     * Sets the object state.
     *
     * @param string $state
     */
    public function setFiniteState($state)
    {
        $this->state = $state;
    }

    public function display()
    {
        echo 'Hello, I\'m a document and I\'m currently at the ', $this->state, ' state.', "\n";
    }
}