<?php
declare(strict_types = 1);


namespace App\Services;

 use Carbon\Carbon;

 class Yesterday extends BaseEvent
{
    public function __construct()
    {
        $yesterday = Carbon::now()->subDay(1)->format('Y-m-d');
        $this->min_date =$yesterday. " 00:00:00";
        $this->max_date =$yesterday. " 23:59:00";

    }

 }
