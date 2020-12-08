<?php
/**
 * Created by PhpStorm.
 * Function: xxx
 * User: 龚国新
 * Date: 2019/9/19
 * Time: 21:48
 */

namespace App\StateMachine\OrderMachine;


use App\StateMachine\OrderMachine\Actions\testDo;
use Finite\Exception\ObjectException;
use Finite\Loader\ArrayLoader;
use Finite\State\State;
use Finite\State\StateInterface;
use Finite\StatefulInterface;
use Finite\StateMachine\StateMachine;
use Illuminate\Support\Facades\Log;

class OrderMachineInitialize
{
    public $object = '';

    public $orderMachine = '';

    public function __construct(OrderMachine $orderMachine)
    {
        $this->orderMachine = $orderMachine;
    }

    public function getMachineObject(){
        $document = $this->orderMachine;

        $sm = new StateMachine($document);

//        // Define states
//        $sm->addState(new State('s1', StateInterface::TYPE_INITIAL));
//        $sm->addState('s2');
//        $sm->addState('s3');
//        $sm->addState(new State('s4', StateInterface::TYPE_FINAL));
//
//        // Define transitions
//        $sm->addTransition('t12', 's1', 's2');
//        $sm->addTransition('t23', 's2', 's3');
//        $sm->addTransition('t34', 's3', 's4');
//        $sm->addTransition('t42', 's4', 's2');

        // Initialize
//        $sm->setObject($document);
        try {
            $loader       = new ArrayLoader(array(
                'class'       => 'Document',
                'states'      => array(
                    'draft'    => array(
                        'type'       => StateInterface::TYPE_INITIAL,
                        'properties' => array('deletable' => true, 'editable' => true),
                    ),
                    'proposed' => array(
                        'type'       => StateInterface::TYPE_NORMAL,
                        'properties' => array(),
                    ),
                    'accepted' => array(
                        'type'       => StateInterface::TYPE_FINAL,
                        'properties' => array('printable' => true),
                    )
                ),
                'transitions' => array(
                    'propose' => array('from' => array('draft'), 'to' => 'proposed'),
                    'accept'  => array('from' => array('proposed'), 'to' => 'accepted'),
                    'reject'  => array('from' => array('proposed'), 'to' => 'draft'),
                ),
                'callbacks' => array(
                    'before' => array(
                        array(
                            'from' => '-proposed',
                            'do' => function(StatefulInterface $document, \Finite\Event\TransitionEvent $e) {
                                echo 'Applying transition '.$e->getTransition()->getName(), "\n";
                            }
                        ),
                        array(
                            'from' => 'proposed',
                            'do' => function() {
                                echo 'Applying transition from proposed state', "\n";
                            }
                        )
                    ),
                    'after' => array(
                        array(
                            'to' => array('accepted'), 'do' => array(new testDo(), 'display')
                        )
                    )
                )
            ));

            $loader->load($sm);
            $sm->initialize();
            $this->object = $sm;
        } catch (ObjectException $e) {
            Log::info("初始化状态机出错:".$e->getFile().':'.$e->getLine());
            throw error($e->getCode(),$e->getMessage());
        }
        return $this->object;
    }
}