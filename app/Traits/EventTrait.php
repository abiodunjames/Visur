<?php
declare(strict_types = 1);


namespace App\Traits;

use App\Event;
use Illuminate\Support\Facades\DB;

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

    public function group_all($paginate=false)

    {
        if ($paginate) {
            return Event::orderBy('timestamp', 'desc')->groupBy('signature')->paginate(100);
        }
        return Event::orderBy('timestamp', 'desc')->groupBy('signature')->get();

    }

    public function group_high($paginate=false)
    {
        if ($paginate) {
            return Event::where('priority', config('event.priority.high'))->orderBy('timestamp', 'desc')->groupBy('signature')->select('*', DB::raw('count(*) as total'))->paginate(100);
        }
        return Event::where('priority', config('event.priority.high'))->orderBy('timestamp', 'desc')->groupBy('signature')->select('*', DB::raw('count(*) as total'))->get();

    }

    public function group_medium($paginate=false)
    {
        if ($paginate) {
            return Event::where('priority', config('event.priority.medium'))->orderBy('timestamp', 'desc')->groupBy('signature')->select('*', DB::raw('count(*) as total'))->paginate(100);
        }
        return Event::where('priority', config('event.priority.medium'))->orderBy('timestamp', 'desc')->groupBy('signature')->select('*', DB::raw('count(*) as total'))->get();

    }

    public function group_low($paginate=false)
    {
        if ($paginate) {
            return Event::where('priority', config('event.priority.low'))->orderBy('timestamp', 'desc')->groupBy('signature')->select('*', DB::raw('count(*) as total'))->paginate(100);
        }
        return Event::where('priority', config('event.priority.low'))->orderBy('timestamp', 'desc')->groupBy('signature')->select('*', DB::raw('count(*) as total'))->get();

    }

}
