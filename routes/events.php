<?php

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Support\Facades\Event;

/*
|--------------------------------------------------------------------------
| Authentication Events
|--------------------------------------------------------------------------
*/
Event::listen(Registered::class, SendEmailVerificationNotification::class);
