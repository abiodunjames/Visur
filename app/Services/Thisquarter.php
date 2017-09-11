<?php
declare(strict_types = 1);


namespace App\Services;

 use Carbon\Carbon;

 class Thisquarter extends BaseEvent
{
     public  function __construct()
     {
         $this->min_date =Carbon::now()->startOfQuarter()->format('Y-m-d'). " 00:00:00";
         $this->max_date =Carbon::now()->format('Y-m-d'). " 23:59:00";
     }

}
