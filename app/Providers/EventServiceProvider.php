<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\ModelRated;
use App\Events\ModelUnrated;
use App\Listeners\SendEmailModelRatedNotification;
use App\Listeners\SendEmailModelUnratedNotification;


class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ModelRated::class => [ //este es el evento
            SendEmailModelRatedNotification::class, //este es el listener
        ],
        ModelUnrated::class => [
            SendEmailModelUnratedNotification::class,
        ]
    ];

    /** Register any events for your application.*/
    public function boot()
    {
        parent::boot();

        //
    }
}
