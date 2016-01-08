<?php

namespace Chxj1992\DataCenter\App\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Chxj1992\DataCenter\App\Events\SomeEvent' => [
            'Chxj1992\DataCenter\App\Listeners\EventListener',
        ],
    ];
}
