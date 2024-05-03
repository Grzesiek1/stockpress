<?php

namespace App\Helpers;

use Carbon\Carbon;

class TimeHelper
{
    public static function currentHour(): int
    {
        return (int)Carbon::now()->utc()->format('H');
    }
}
