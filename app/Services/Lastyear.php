<?php
declare(strict_types = 1);


namespace App\Services;

use Carbon\Carbon;

final class Lastyear extends BaseEvent
{
    public  function __construct()
    {
        $last_year=Carbon::now()->subYear(1);
        $this->min_date =$last_year->startOfYear()->format('Y-m-d'). " 00:00:00";
        $this->max_date =$last_year->endOfYear()->format('Y-m-d'). " 23:59:00";
    }

}
