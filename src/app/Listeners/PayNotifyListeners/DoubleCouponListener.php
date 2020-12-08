<?php

namespace App\Listeners\PayNotifyListeners;

use App\Events\PayNotifyEvent;
use App\Models\Test;
use Illuminate\Support\Facades\Log;

class DoubleCouponListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PayNotifyEvent  $event
     * @return void
     */
    public function handle(PayNotifyEvent $event)
    {
        Test::query()->insert(['name'=>$event->data['id']]);
        Log::info('我是翻倍处理监听器');
    }
}
