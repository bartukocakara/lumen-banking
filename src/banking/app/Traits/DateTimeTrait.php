<?php

namespace App\Traits;

use Carbon\Carbon;

trait DateTimeTrait
{

    public function getDateTime()
    {
        $date = Carbon::now(); // 2020-07-02 16:54:14
        $date->toISO8601String(); // 2020-07-02T16:54:14+00:00
        $date = $date->tz('Europe/Istanbul')->toDateTimeString(); // 2020-07-02 19:54:14
        return $date;
    }

    public function getDateTimeTokenExpireDate()
    {
        $date = Carbon::now()->addDays(30);
        $date->toISO8601String();
        $date = $date->tz('Europe/Istanbul')->toDateTimeString();
        return $date;
    }
}
