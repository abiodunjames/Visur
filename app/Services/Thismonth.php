<?php
declare(strict_types = 1);


namespace App\Services;

 use Carbon\Carbon;

 class Thismonth extends BaseEvent
{

    public function __construct()
    {
        $date = Carbon::now()->subDay(1)->format('Y-m-d');
        $this->min_date =Carbon::now()->startOfMonth()->format('Y-m-d'). " 00:00:00";
        $this->max_date =Carbon::now()->format('Y-m-d'). " 23:59:00";
    }

 }
