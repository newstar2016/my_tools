<?php

namespace App\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
            'App\Listeners\EventListener',
        ],
        'App\Events\ExampleEvent' => [
            'App\Listeners\ExampleListener',
            'App\Listeners\TestListener',
        ],
        'App\Events\PayNotifyEvent' => [
            'App\Listeners\PayNotifyListeners\DoubleCouponListener',
            'App\Listeners\PayNotifyListeners\UpdateOrderListener',
        ],
    ];
}
