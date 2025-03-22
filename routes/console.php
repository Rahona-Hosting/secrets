<?php

use Illuminate\Support\Facades\Schedule;
use Rahona\Jobs\CheckExpiredSecret;
use Rahona\Jobs\CheckExpiringApiTokens;

Schedule::job(new CheckExpiringApiTokens)
    ->everyMinute()
    ->name('check-api-tokens');

Schedule::job(new CheckExpiredSecret)
    ->everyMinute()
    ->name('check-expired-secret');
