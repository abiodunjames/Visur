<?php
declare(strict_types = 1);


namespace App\Services;

interface IEventReport
{
    public function high();

    public  function low();

    public function medium();


    public function barchart();

    public function piechart();

}
