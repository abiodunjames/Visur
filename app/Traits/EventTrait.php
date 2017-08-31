<?php
declare(strict_types = 1);


namespace App\Traits;

trait  EventTrait
{
    public function all()
    {
        return Event::all();
    }


    public function high()
    {
        return Event::where('priority', config('event.priority.high'))->get();
    }

    public function medium()
    {
        return Event::where('priority', config('event.priority.medium'))->get();
    }

    public function low()
    {
        return Event::where('priority', config('event.priority.low'))->get();
    }

    public function group_all()
    {
        return Event::orderBy('timestamp', 'desc')->groupBy('signature')->get();

    }


    public function group_high()
    {
        return Event::where('priority', config('event.priority.high'))->orderBy('timestamp', 'desc')->groupBy('signature')->get();

    }

    public function group_medium()
    {
        return Event::where('priority', config('event.priority.medium'))->orderBy('timestamp', 'desc')->groupBy('signature')->get();

    }

    public function group_low()
    {

        return Event::where('priority', config('event.priority.low'))->orderBy('timestamp', 'desc')->groupBy('signature')->get();

    }

}
